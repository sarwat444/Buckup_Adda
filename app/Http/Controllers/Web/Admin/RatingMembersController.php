<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\admin\RatingMembers\StoreRatingMembersRequest;
use App\Http\Requests\Web\admin\RatingMembers\UpdateRatingMembersRequest;
use App\Models\Kheta;
use App\Models\RatingMember;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseJson;
use App\Models\Mangement ;
use Illuminate\Support\Facades\Hash ;
class RatingMembersController extends Controller
{
    use  ResponseJson ;
    public  function __construct(private RatingMember $user)
    {}
    /** Gehat  Functions */
    public function show( $kheta_id = null )
    {
        $kheta = Kheta::find($kheta_id) ;
        $ratingMembers  =  $this->user->where('kheta_id',$kheta_id)->get() ;
        return  view('admins.ratingMembers.index')->with(compact('ratingMembers' , 'kheta')) ;
    }

    public  function CreateratingMembers($kheta_id)
    {
         $kehta = Kheta::find($kheta_id) ;
         $gehat =  User::where(['is_manger' => 1 , 'kehta_id' => $kheta_id])->get() ;
         return  view('admins.ratingMembers.create')->with(compact('gehat' ,'kehta')) ;
    }
    public function store(StoreRatingMembersRequest $storeRatingMembersRequest): \Illuminate\Http\RedirectResponse
    {
        $ratingMember  = new RatingMember() ;
        $ratingMember->username  = $storeRatingMembersRequest->username;
        $ratingMember->job_number  = $storeRatingMembersRequest->job_number;
        $ratingMember->password =  Hash::make($storeRatingMembersRequest->password);
        $ratingMember->kheta_id =   $storeRatingMembersRequest->kheta_id;
        $ratingMember->gehat =  json_encode($storeRatingMembersRequest->geha_id);


        $ratingMember->save();
        return redirect()->back()->with('success', 'تم أضافة لجنة التقييم بنجاح');
    }
    public function  edit($id = null ):\Illuminate\View\View
    {
        $all_gehat  =  User::get() ;
        $member  = RatingMember::find($id) ;
        return view('admins.ratingMembers.edit-user')->with(compact('all_gehat' ,'member')) ;
    }
    public function update(UpdateRatingMembersRequest $updateRatingMembersRequest , $id):\Illuminate\Http\RedirectResponse
    {
        $member  =  RatingMember::find($id) ;
        $old_password = $member['password'] ;
        $new_user_request  =  $updateRatingMembersRequest->safe()->except(['_token']) ;
        if($member)
        {
            if(!empty($new_user_request['password']))
            {
                $new_user_request['password'] = Hash::make($new_user_request['password']) ;
            }else
            {
                $new_user_request['password'] =  $old_password ;
            }

            if(!empty($new_user_request['gehat']))
            {
                $new_user_request['gehat'] = json_encode($new_user_request['gehat']) ;
            }

            $member->update($new_user_request) ;
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
        $admins = Admin::get();
        return view('admins.users.Admins.index')->with(compact('admins'));
    }
    public function createadmin()
    {
        return  view('admins.users.Admins.create') ;
    }
    public function storeAdmin(StoreAdminRequest $storeAdminRequest)
    {
        if (!empty($storeAdminRequest->password)) {
            $hashedPassword = Hash::make($storeAdminRequest->password);
        }
        // Create a new Admin instance and save to the database
        $admin = Admin::create([
            'email' => $storeAdminRequest->email,
            'password' => $hashedPassword,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'تم أضافة مدير النظام بنجاح');

    }
    public function  editadmin($id = null ):\Illuminate\View\View
    {
        $admin  = Admin::find($id) ;
        return view('admins.users.Admins.edit')->with(compact('admin')) ;
    }


    public function  updatestaff(UpdateStaffRequest $staffRequest , $id)
    {
        $staff_data  =  Admin::find($id) ;
        $old_password = $staff_data['password'] ;
        $new_staff_request  =  $staffRequest->safe()->except(['role_name' , '_token']) ;

        if($staff_data)
        {
            if(!empty($new_staff_request['password']))
            {
                $new_staff_request['password'] = Hash::make($new_staff_request['password']) ;
            }else
            {
                $new_staff_request['password'] =  $old_password ;
            }
            $staff_data->update($new_staff_request) ;
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $staffRequest->assignRole($staffRequest['role_name']);
            return  redirect()->back()->with('success' ,  'User Updated Successfuly') ;
        }
        else
        {
            return  redirect()->back()->with('error' ,  'User Not Found') ;
        }
    }

    public function  destory_admin($id=null): \Illuminate\Http\RedirectResponse
    {
        $staff = Admin::find($id) ;
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
