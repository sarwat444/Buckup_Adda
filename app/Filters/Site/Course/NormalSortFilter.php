<?php

namespace App\Filters\Site\Course;

use Closure;

class NormalSortFilter
{
    public function handle($query, Closure $next)
    {
        /** desc is for order from the highest to the lowest & asc is for order from the lowest to the highest */

        if (request()->filled('sort') && in_array(request()->input('sort'), ['latest', 'oldest'])) {
            $sortBy = match (request()->input('sort')) {
                'latest' => 'DESC',
                'oldest' => 'ASC'
            };
            $query->orderBy('id', $sortBy);
        }
        return $next($query);
    }
}
