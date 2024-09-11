<?php

namespace App\Listeners;

use App\Events\InstructorSectionLessonUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Lesson;

class InstructorUpdatedSectionLesson
{
    public function __construct()
    {
        //
    }

    public function handle(InstructorSectionLessonUpdated $event)
    {
        if ($event->lesson->wasChanged('section_id')) {
            $lastOrdering = Lesson::where('section_id', $event->lesson->section_id)->max('ordering');
            $event->lesson->withoutEvents(function () use ($event, $lastOrdering) {
                $event->lesson->update([
                    'ordering' => ++$lastOrdering,
                ]);
            });
        }
    }
}
