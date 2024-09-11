<?php

namespace App\Http\Controllers\Apis\site\Auth\users;

use App\Http\Requests\Web\Auth\User\LoginRequest;
use App\Services\Login\LoginService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User ;
use App\Http\Requests\Apis\UserRegister ;

class LoginController extends Controller
{
    //User Login Services


    public function store(LoginRequest $loginRequest): \Illuminate\Http\JsonResponse
    {
        return LoginService::login($loginRequest);
    }

    //User Registeration Services

    public function register(UserRegister $registerduser):  \Illuminate\Http\JsonResponse
    {
        try {
            User::create(
                [  'first_name' => $registerduser->first_name,
                    'last_name' => $registerduser->last_name,
                    'email' => $registerduser->email,
                    'password' => Hash::make($registerduser->password)
                ]
            );
            return response()->json([
                'message' => 'User Is Registered  Successfuly ' ,
            ]);

        } catch (Exception $e) {
            return $this->sendError('Validation Error  .', 'Something Wrong Happen');
        }
    }

}
