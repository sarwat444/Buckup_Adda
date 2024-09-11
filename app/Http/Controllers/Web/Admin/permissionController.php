<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Permission;

class permissionController extends Controller
{
    use ResponseJson;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all Permissions from the database
        $Permissions = Permission::all();

        // Return view with Permissions data
        return view('admins.Permissions.index', compact('Permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create Permission form view
        return view('admins.Permissions.create');
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
            'name' => 'required|string|unique:Permissions',
        ]);

        // Create the new Permission
        $Permission = Permission::create($validatedData);

        // Redirect with success message
        return redirect()->route('dashboard.Permissions.index')->with('success', 'تم أضافه الصلاحيه بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): \Illuminate\Http\JsonResponse
    {
        // Find the Permission by id
        $Permission = Permission::findOrFail($id);

        // Return the edit Permission form view with Permission data
        return $this->responseJson(['data' => $Permission], Response::HTTP_OK);
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
            'name' => 'required|string|unique:Permissions,name,'.$id,
        ]);

        // Find the Permission by id and update it
        $Permission = Permission::findOrFail($id);
        $Permission->update($validatedData);

        // Redirect with success message
        return redirect()->route('dashboard.Permissions.index')->with('success', 'تم تعديل الصلاحيه  بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the Permission by id and delete it
        $Permission = Permission::findOrFail($id);
        $Permission->delete();

        // Redirect with success message
        return redirect()->route('dashboard.Permissions.index')->with('success', 'تم حذف الصلاحيه  بنجاح');
    }
}
