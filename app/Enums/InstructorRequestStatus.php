<?php

namespace App\Enums;

enum InstructorRequestStatus: int
{
    case pending = 0;
    case accepted = 1;
    case rejected = 2;
}
