<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        $guards = empty($guards) ? ['admin', 'web'] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard === 'admin') {
                    $url = RouteServiceProvider::ADMIN;
                } elseif ($guard === 'web' && auth()->user()->isAcceptedInstructorRequest()) {
                    $url = RouteServiceProvider::INSTRUCTOR;
                } else {
                    $url = RouteServiceProvider::WEBSITE;
                }
                return redirect($url);
            }
        }
        return $next($request);
    }
}
