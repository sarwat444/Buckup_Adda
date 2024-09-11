<?php

namespace App\Listeners;

use App\Enums\LessonType;
use App\Events\LessonViewedByUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UserViewedLesson
{

    public function __construct()
    {
        //
    }

    public function handle(LessonViewedByUser $event): void
    {
        $event->course->lessons()->each(function ($lesson) use ($event) {
            $lesson->lesson_progress()->update([
                'is_last_viewed' => false,
                'updated_at' => DB::raw('updated_at')
            ]);
        });
        $event->lesson->lesson_progress()->update([
            'is_last_viewed' => true,
            'updated_at' => DB::raw('updated_at')
        ]);

        if ($event->lesson->getAttribute('type') === LessonType::document->value) {
            $event->lesson->lesson_progress()->update([
                'is_completed' => true,
                'updated_at' => DB::raw('updated_at')
            ]);
        }

    }
}
