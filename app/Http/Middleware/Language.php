<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Language
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('locale')){
            $lang = $request->session()->get('locale');
            app()->setLocale($lang);
        }else{
            $lang = 'en';
            app()->setLocale($lang);
        }

        return $next($request);
    }
}
