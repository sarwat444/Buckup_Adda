<?php

namespace App\Http\Controllers\web\site;

use App\Http\Controllers\Controller;
use App\Models\Execution_year;
use App\Models\Mokasher;
use App\Models\MokasherGehaInput;
use App\Models\MokasherInput;
use App\Models\RatingMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class RatingMembersController extends Controller
{
    public function login()
    {
       return view('ratingMembers.auth.login') ;
    }
    public  function ratingLogin(Request $request)
    {
        $credentials = $request->only('job_number', 'password');
        if(Auth::guard('ratingMember')->attempt($credentials)) {
            //custom
            $responsable_gehat = json_decode(Auth::guard('ratingMember')->user()->gehat);
            $users =  User::whereIn('id' ,$responsable_gehat)->get() ;
            return  view('ratingMembers.geaht.index' , compact('users')) ;
        }
        else {
            return view('ratingMembers.auth.login')->with('error', 'Invalid credentials');
        }
    }
    public  function logout()
    {
        Auth::logout();
        return redirect(route('Home'));
    }
    public function rating_gehat()
    {
        $kheta_id = Auth::guard('ratingMember')->user()->kehta_id ;
        $responsable_gehat = json_decode(Auth::guard('ratingMember')->user()->gehat);
        $users =  User::whereIn('id' ,$responsable_gehat)->where('kehta_id' , $kheta_id)->get() ;
        return  view('ratingMembers.geaht.index' ,  compact('users'));
    }
    public function rating_mokshart($user_id)
    {
        $mokasher_geha_input = MokasherGehaInput::where('geha_id', $user_id)->get();
        $mokashert = [];
        if (!$mokasher_geha_input->isEmpty()) {
            $mokasher_ids = $mokasher_geha_input->pluck('mokasher_id')->toArray();
            $mokashert = Mokasher::with('addedBy_fun' ,'mokasher_geha_inputs')->whereIn('id', $mokasher_ids)->where('addedby' , 0)->get();
        }

        return view('ratingMembers.moksherat.index', compact('mokashert'));
    }

    public function ratinginput ($mokasher_id)
    {
        $gehat = json_decode(Auth::user()->gehat);
        $geha_id = $gehat[0];
        $selected_year = Execution_year::where('selected',1)->first() ;
        $mokaser_data  = MokasherGehaInput::with('mokasher.mokasher_inputs' , 'geha')->where(['mokasher_id' => $mokasher_id , 'geha_id' => $geha_id])->first() ;
        return view('ratingMembers.moksherat.view_achived_mokasher' , compact( 'mokaser_data' ,'selected_year')) ;
    }
    public function storeRating(Request $request)
    {
        if($request->part == 1){
            MokasherGehaInput::where('id', $request->mokasher_geha_id)->update(['rate_part_1' => $request->rate_part_1 ,'note_part_1' =>  $request->note_part_1]);
            return redirect()->back()->with('success' , 'تم تقيم الربع الاول  بنجاح ') ;
        }else if($request->part == 2)
        {
            MokasherGehaInput::where('id', $request->mokasher_geha_id)->update(['rate_part_2' => $request->rate_part_2 ,'note_part_2' =>  $request->note_part_2]);
            return redirect()->back()->with('success' , 'تم تقيم الربع الثانى  بنجاح ') ;
        }else if($request->part == 3)
        {
            MokasherGehaInput::where('id', $request->mokasher_geha_id)->update(['rate_part_3' => $request->rate_part_3 ,'note_part_3' =>  $request->note_part_3]);
            return redirect()->back()->with('success' , 'تم تقيم الربع الثالث   بنجاح ') ;
        }else if($request->part == 4)
        {
            MokasherGehaInput::where('id', $request->mokasher_geha_id)->update(['rate_part_4' => $request->rate_part_4 ,'note_part_4' =>  $request->note_part_4]);
            return redirect()->back()->with('success' , 'تم تقيم الربع الرابع   بنجاح ') ;
        }
    }
}
