<?php

namespace App\Filters\Site\Course;

class LevelFilter
{
    public function handle($query, $next)
    {
        if (request()->filled('level')) {
            $query->whereIn('level',request()->input('level'));
        }
        return $next($query);
    }
}
