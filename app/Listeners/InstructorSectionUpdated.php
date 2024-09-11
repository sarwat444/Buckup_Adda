<?php

namespace App\Listeners;

use App\Events\InstructorUpdateSection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InstructorSectionUpdated
{
    public function __construct()
    {
        //
    }

    public function handle(InstructorUpdateSection $event)
    {
        if ($event->section->wasChanged('course_id')) {
            $event->section->lessons()->update(['course_id' => $event->section->course_id]);
        }
    }
}
