<?php

namespace App\Filters\Site\Course;

use Closure;

class TitleSortFilter
{
    public function handle($query, Closure $next)
    {
        if (request()->filled('sort') && in_array(request()->input('sort'), ['title_asc', 'title_desc'])) {
            $sortBy = match (request()->input('sort')) {
                'title_desc' => 'DESC',
                'title_asc' => 'ASC'
            };
            $query->orderBy('title', $sortBy);
        }
        return $next($query);
    }
}
