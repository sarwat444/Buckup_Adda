<?php

namespace App\Enums;

enum CourseLevel: int
{
    case beginner = 1;
    case intermediate = 2;
    case expert = 3;

    public static function badgeBootstrap(CourseLevel $courseLevel): string
    {
        return match ($courseLevel) {
            self::beginner => 'badge-beginner',
            self::intermediate => 'badge-intermediate',
            self::expert => 'badge-all'
        };
    }
}
