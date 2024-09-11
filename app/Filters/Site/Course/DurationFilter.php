<?php

namespace App\Filters\Site\Course;

use Closure;

class DurationFilter
{
    public function handle($query, Closure $next)
    {
        if (request()->filled('duration')) {

            $fullDuration = $this->getFullDuration(request()->duration);
            $query->having('lessons_sum_duration', '>=', $fullDuration['start'])
                  ->having('lessons_sum_duration', '<=', $fullDuration['end']);
        }
        return $next($query);
    }

    private function getFullDuration(string $duration): array
    {
        return match ($duration) {
            'less_than_2_hours' => ['start' => 0, 'end' => 7200],
            'between_3_and_6_hours' => ['start' => 7200, 'end' => 21600],
            'between_7_and_16_hours' => ['start' => 21600, 'end' => 57600],
            'greater_than_17_hours' => ['start' => 57600, 'end' => 999999999],
        };
    }
}
