<?php

namespace App\Services\Login;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class LoginService
{
    public static function login($loginRequest): \Illuminate\Http\JsonResponse
    {
        if (self::userExistsInOurDatabase($loginRequest)) {
            $user = Auth::user();
            $user['token'] =   $user->createToken('lmsApp')-> accessToken;
            return response()->json([
                'message' => 'User Login Successfuly ' ,
                'user'  => $user ,
            ]);
        } elseif (self::tryToAuthenticateUserFromThirdParty($loginRequest)) {
            $user = Auth::user();
            $user['token'] =   $user->createToken('lmsApp')-> accessToken;
            return response()->json([
                'message' => 'User Login Successfuly ' ,
                'user'  => $user ,
            ]);
        }
             return response()->json(['errors' => [['Invalid credentials.']]], Response::HTTP_UNAUTHORIZED);
    }

    private static function userExistsInOurDatabase($loginRequest): bool
    {
        return auth()->guard()->attempt($loginRequest->validated(), request()->boolean('remember_me'));
    }

    private static function tryToAuthenticateUserFromThirdParty($loginRequest): bool
    {
        if ($user = self::userExistsInThirdParty($loginRequest)) {
            DB::beginTransaction();
            $user = self::createOrUpdateUserInOurDatabase($user);
            self::loginUserInOurSystem($user);
            DB::commit();
            return true;
        }
        return false;
    }

    private static function userExistsInThirdParty($loginRequest): object|bool
    {
        return DB::connection('third_party_db')->table('users')->where([
            ['email', $loginRequest->email],
            ['password', third_party_crypt($loginRequest->password)]
        ])->first() ?? false;
    }

    private static function createOrUpdateUserInOurDatabase($user): User
    {
        return User::updateOrCreate(['email' => $user->email], [
            'password' => Hash::make($user->password)
        ]);
    }

    private static function loginUserInOurSystem($user): void
    {
        auth()->login($user, request()->boolean('remember_me'));
    }
}
