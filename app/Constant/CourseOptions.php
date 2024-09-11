<?php

namespace App\Constant;

class CourseOptions
{
    const is_top = 1;

    const not_top = 0;

    const is_active = 1;

    const not_active = 0;

    const is_free = 1;
    const not_free = 0;

    public static function getOptions(): array
    {
        return [
            self::is_top,
            self::is_active,
            self::is_free,
            self::not_free,
        ];
    }
}
