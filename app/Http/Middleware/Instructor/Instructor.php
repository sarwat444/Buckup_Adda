<?php

namespace App\Http\Middleware\Instructor;

use Illuminate\Http\Request;
use Closure;

class Instructor
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isAcceptedInstructorRequest()) {
            return $next($request);
        }
        return redirect(route('site.home'));
    }
}
