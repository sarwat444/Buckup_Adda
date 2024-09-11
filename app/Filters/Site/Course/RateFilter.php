<?php

namespace App\Filters\Site\Course;

use App\Models\Course;

class RateFilter
{
    public function handle($query, $next)
    {
        if (request()->filled('rate')) {
            $rates = $this->getFullRateRange(request()->rate);
            $query->having('rates_avg_rate', '>=', $rates['start'])
                  ->having('rates_avg_rate', '<=', $rates['end']);
        }

        return $next($query);
    }

    private function getFullRateRange(string $rate): array
    {
        return match ($rate) {
            '5' => ['start' => 5, 'end' => 5],
            '4' => ['start' => 4, 'end' => 4.9],
            '3' => ['start' => 3, 'end' => 3.9],
            '2' => ['start' => 2, 'end' => 2.9],
            '1' => ['start' => 1, 'end' => 1.9],
        };
    }

}
