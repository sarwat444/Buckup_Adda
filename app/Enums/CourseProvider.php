<?php

namespace App\Enums;

enum CourseProvider: int
{
    case vimeo    = 2;


    public static function getProviders():array
    {
        return [
            self::vimeo->value
        ];
    }

}
