<?php

/** helper simple function to get hours and minute and seconds from seconds */

use Illuminate\Support\Carbon;

if(!function_exists('hours_minutes_seconds')) {

    function hours_minutes_seconds(int|null $seconds):string
    {
        return $seconds ? Carbon::now()->addSecond($seconds)->diffForHumans(null, true, false, 3) : '00:00:00';
    }
}
