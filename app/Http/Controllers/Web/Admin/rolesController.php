<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseJson;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    use ResponseJson;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all roles from the database
        $roles = Role::all();

        // Return view with roles data
        return view('admins.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create role form view
        return view('admins.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|unique:roles',
        ]);

        // Create the new role
        $role = Role::create($validatedData);

        // Redirect with success message
        return redirect()->route('dashboard.roles.index')->with('success', 'تم أضافه الصلاحيه بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): \Illuminate\Http\JsonResponse
    {
        // Find the role by id
        $role = Role::findOrFail($id);

        // Return the edit role form view with role data
        return $this->responseJson(['data' => $role], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|unique:roles,name,'.$id,
        ]);

        // Find the role by id and update it
        $role = Role::findOrFail($id);
        $role->update($validatedData);

        // Redirect with success message
        return redirect()->route('dashboard.roles.index')->with('success', 'تم تعديل الصلاحيه  بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the role by id and delete it
        $role = Role::findOrFail($id);
        $role->delete();

        // Redirect with success message
        return redirect()->route('dashboard.roles.index')->with('success', 'تم حذف الصلاحيه  بنجاح');
    }
    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status','Permissions added to role');
    }
}
