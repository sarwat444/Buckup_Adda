<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\users\StoreAdminRequest;
use App\Http\Requests\Web\Admin\users\UpdateStaffRequest;
use App\Models\Execution_year;
use App\Models\Kheta;
use App\Models\Mangement;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use  App\Http\Requests\Web\Admin\users\StoreUserRequest ;
use  App\Http\Requests\Web\Admin\users\UpdateUserRequest ;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ResponseJson ;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\DemoMail;
use DB ;

class UsersController extends Controller
{
    use  ResponseJson ;
    public  function __construct(private  User $user)
    {}
    public  function show($kheta_id)
    {
        $users  =  $this->user->where('kehta_id' , $kheta_id )->with('mangemnet')->get() ;
        $kheta = Kheta::find($kheta_id) ;
        $execution_years  = Execution_year::where('kheta_id' , $kheta_id )->get() ;
        return  view('admins.users.geaht.index')->with(compact('users' ,'execution_years' , 'kheta')) ;
    }
    /** Gehat  Functions */
    public function createuser($kehta_id)
    {
           $mangements =  Mangement::get();
           return  view('admins.users.geaht.create')->with(compact('mangements', 'kehta_id')) ;
    }
    public function store(StoreUserRequest $storeUserRequest): \Illuminate\Http\RedirectResponse
    {

        $user = new User() ;
        $user->job_number = $storeUserRequest->job_number ;
        $user->password = Hash::make($storeUserRequest->password) ;
        $user->geha = $storeUserRequest->geha ;
        $user->email = $storeUserRequest->email ;
        $user->is_manger =  1  ;
        $user->kehta_id   = $storeUserRequest->kehta_id ;
        $mailData = [
            'job_number' => $storeUserRequest->job_number,
            'password' => $storeUserRequest->password ,
        ];
        try {
            Mail::to($storeUserRequest->email)->send(new DemoMail($mailData));
        } catch (\Exception $e) {
        }


        $user->save()  ;

        return  redirect()->back()->with('success' , 'تم أضافه الجهه بنجاح وارسال الأيميل بنجاح ') ;
    }
    public function  edit($id = null ):\Illuminate\View\View
    {
        $user  = User::with('mangemnet')->find($id) ;
        $mangements = Mangement::get() ;
        return view('admins.users.geaht.edit-user')->with(compact('user' ,'mangements')) ;
    }
    public function update(UpdateUserRequest $userRequest , $id):\Illuminate\Http\RedirectResponse
    {
        $user_data  =  User::find($id) ;
        $old_password = $user_data['password'] ;
        $is_manger = $userRequest->is_manger ;

        $new_user_request  =  $userRequest->safe()->except(['_token']) ;

        $password_email = $new_user_request['password'] ;
        if($user_data)
        {
            if(!empty($new_user_request['password']))
            {
                $new_user_request['password'] = Hash::make($new_user_request['password']) ;
            }else
            {
                $new_user_request['password'] =  $old_password ;
            }

            if(!empty($new_user_request['is_manger']) && $new_user_request['is_manger'] =='on' )
            {
                $new_user_request['is_manger'] = 1 ;
            }else
            {
                $new_user_request['is_manger']  = 0 ;
            }

            $mailData = [
                'job_number' => $userRequest->job_number,
                'password' => $password_email
            ];
            try {
                Mail::to($userRequest->email)->send(new DemoMail($mailData));
            } catch (\Exception $e) {
            }
            $user_data->update($new_user_request) ;
            return  redirect()->back()->with('success' ,  'تم تعديل  بيانات الجهه بنجاح') ;
        }
        else
        {
            return  redirect()->back()->with('error' ,  'الجهه ليست موجوده') ;
        }
    }
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $user = $this->user->find($id) ;
        if($user)
        {
            $user->delete() ;
            return  redirect()->back()->with('success' , 'User Deleted successfully') ;
        }
        return  redirect()->back()->with('error' , 'User Not Found ') ;
    }


    /** Admins  Functions */

    public function admins()
    {
        $admins = Admin::with('kheta')->get();
        return view('admins.users.Admins.index')->with(compact('admins'));
    }
    public function createadmin()
    {
        $khetas = Kheta::get() ;
        return  view('admins.users.Admins.create' , compact('khetas')) ;
    }
    public function storeAdmin(StoreAdminRequest $storeAdminRequest)
    {
        if (!empty($storeAdminRequest->password)) {
            $hashedPassword = Hash::make($storeAdminRequest->password);
        }
        // Create a new Admin instance and save to the database
        $admin = Admin::create([
            'kheta_id' => $storeAdminRequest->kheta_id ,
            'email' => $storeAdminRequest->email,
            'password' => $hashedPassword,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'تم أضافة مدير النظام بنجاح');
    }
    public function  editadmin($id = null ):\Illuminate\View\View
    {
        $admin  = Admin::find($id) ;
        $khetas = Kheta::get() ;
        return view('admins.users.Admins.edit')->with(compact('admin' ,'khetas')) ;
    }


    public function updateadmin(UpdateStaffRequest $staffRequest, $id)
    {
        // Retrieve validated data from the request
        $validatedData = $staffRequest->validated();

        // Find the admin by ID
        $admin = Admin::find($id);

        // Check if admin exists
        if ($admin) {
            // Hash the new password if provided
            if (!empty($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                // Keep the old password if not provided
                unset($validatedData['password']); // Remove password field from the update data
            }

            // Update the admin with the validated data
            $admin->update($validatedData);

            return redirect()->back()->with('success', 'تم تعديل  مدير النظام بنجاح ');
        } else {
            return redirect()->back()->with('error', 'User Not Found');
        }
    }

    public function  destory_admin(Request $request): \Illuminate\Http\RedirectResponse
    {
        $staff = Admin::find($request->admin_id) ;
        if($staff)
        {
            $staff->delete() ;
            return  redirect()->back()->with('success' , 'تم حذف مدير النظام  بنجاح ') ;
        }else
        {
            return  redirect()->back()->with('error' , 'تم حذف  مدير  النظام بنجاح ') ;
        }
    }
    public function change_execution_year(Request $request)
    {
        try {
            // Reset the currently selected execution year
            Execution_year::where('selected', 1)->update(['selected' => 0]);
            // Set the new execution year as selected
            Execution_year::where('year_name', $request->execuation_year)->update(['selected' => 1]);

            return redirect()->back()->with('success', 'تم بث السنه بنجاح');
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during the update
            return redirect()->back()->with('error' , 'something went error');
        }
    }
}
