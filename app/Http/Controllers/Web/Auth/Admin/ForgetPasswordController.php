<?php

namespace App\Http\Controllers\Web\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\Auth\Admin\ForgetPassword;
use Illuminate\Support\Facades\Password;

class ForgetPasswordController extends Controller
{
    public function create(): \Illuminate\View\View
    {
        return view('dashboard.auth.forget-password');
    }

    public function store(ForgetPassword $forgetPassword): \Illuminate\Http\RedirectResponse
    {
        $status = Password::broker('admins')->sendResetLink(
            $forgetPassword->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()->with('error', __($status));
    }
}
