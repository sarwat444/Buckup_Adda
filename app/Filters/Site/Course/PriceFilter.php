<?php

namespace App\Filters\Site\Course;

class PriceFilter
{
    public function handle($query, $next)
    {
        if (request()->filled('price')) {
            $price = request()->input('price') === 'free' ? 1 : 0;
            $query->where('is_free',$price);
        }
        return $next($query);
    }
}
