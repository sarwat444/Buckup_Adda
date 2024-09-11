<?php

if (!function_exists('calculateProgress')) {
    function calculateProgress($progress, $total, $withPercentageSign = false): int|string
    {
        $total = $total ? round(100 / $total * $progress, 2) : 0;
        return $withPercentageSign ? $total . '%' : $total;
    }
}
