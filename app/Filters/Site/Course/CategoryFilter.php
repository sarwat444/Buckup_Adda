<?php

namespace App\Filters\Site\Course;

class CategoryFilter
{
    public function handle($query, $next)
    {
        if (request()->filled('category')) {
            $query->whereIn('category_id',request()->input('category'));
        }
        return $next($query);
    }
}
