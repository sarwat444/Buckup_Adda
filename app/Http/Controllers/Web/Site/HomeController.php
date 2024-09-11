<?php

namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    use ResponseJson;

    public function Home()
    {
        return view('welcome') ;
    }
    public function index()
    {
        return view('gehat.dashboard.index');
    }
    public  function subgeha()
    {
        return view('sub_geha.dashboard.index');
    }
    public function login()
    {
      return view('gehat.auth.login') ;
    }
    public function authenticate(Request $request)
    {
            $credentials = $request->only('job_number', 'password');
            if(Auth::attempt($credentials)) {
                    $user = Auth::user();
                    if ($user->is_manger == 1) {
                        return redirect()->intended(route('gehat.index'));
                    } else {
                        return redirect()->intended(route('sub_geha.index'));
                    }
            }
             else {
                return view('gehat.auth.login')->with('error', 'Invalid credentials');
            }
    }
    public  function logout()
    {
        Auth::logout();
        return redirect(route('Home'));
    }
}
