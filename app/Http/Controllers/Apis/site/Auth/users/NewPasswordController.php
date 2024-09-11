<?php

namespace App\Http\Controllers\Web\Auth\User;

use App\Http\Requests\Web\Dashboard\Auth\Admin\ResetPassword;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class NewPasswordController extends Controller
{
    public function create(Request $request): \Illuminate\View\View
    {
        return view('dashboard.auth.reset-password',['request' => $request]);
    }

    public function store(ResetPassword $resetPassword): \Illuminate\Http\RedirectResponse
    {
        $status = Password::broker('admins')->reset(
            $resetPassword->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($resetPassword) {
                $user->forceFill(['password' => Hash::make($resetPassword->password)])->save();
            }
        );
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($resetPassword->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
