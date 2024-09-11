<?php

namespace App\Http\Controllers\Web\Auth\User;

use App\Http\Requests\Web\Auth\User\LoginRequest;
use App\Services\Login\LoginService;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function store(LoginRequest $loginRequest): \Illuminate\Http\JsonResponse
    {
        return LoginService::login($loginRequest);
    }

    public function destroy(): \Illuminate\Http\RedirectResponse
    {
        auth()->guard()->logout();
        return redirect(route('site.home'))->with('success', 'You have been logged out successfully.');
    }
}
