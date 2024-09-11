<?php

namespace App\Http\Controllers\Web\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\Admin\LoginRequest;

class LoginController extends Controller
{
    public function create(): \Illuminate\View\View
    {
        return view('admins.auth.login');
    }
    public function store(LoginRequest $loginRequest): \Illuminate\Http\RedirectResponse
    {
        if(!auth()->guard('admin')->attempt($loginRequest->validated())){
            return redirect(route('admins.login'))->withErrors('oops invalid credentials');
        }
        return redirect()->route('dashboard.index');
    }

    public function destroy(): \Illuminate\Http\RedirectResponse
    {
        auth()->guard('admin')->logout();
        return redirect(route('Home'));
    }
}
