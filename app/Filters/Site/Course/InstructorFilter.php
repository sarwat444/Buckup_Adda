<?php

namespace App\Filters\Site\Course;

class InstructorFilter
{
    public function handle($query, $next)
    {
        if (request()->filled('instructor')) {
            $query->whereIn('user_id',request()->input('instructor'));
        }
        return $next($query);
    }
}
