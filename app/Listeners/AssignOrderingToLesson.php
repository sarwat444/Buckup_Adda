<?php

namespace App\Listeners;

use App\Events\AssignOrderingToLessonWasCreated;

class AssignOrderingToLesson
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\AssignOrderingToLessonWasCreated $event
     * @return void
     */
    public function handle(AssignOrderingToLessonWasCreated $event)
    {
        $lastOrdering = $event->lesson->section->lessons()->max('ordering');
        $event->lesson->update([
            'ordering' => ++$lastOrdering,
        ]);
    }
}
