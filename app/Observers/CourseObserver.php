<?php

namespace App\Observers;

use App\Repositories\VimeoFolderService;
use App\Models\VimeoFolder;
use Illuminate\Support\Str;
use App\Models\Course;

class CourseObserver
{
    public function created(Course $course): void
    {
        $folderCreated = VimeoFolderService::createFolder(['name' => Str::uuid() . '-' . Str::slug($course->name, '-')]);
        if ($folderCreated) {
            $user_id = auth()->guard('web')->user()->id ?? null;
            VimeoFolder::updateOrCreate(['folder_id' => $folderCreated['folder_id']], ['course_id' => $course->id, 'user_id' => $user_id, 'name' => $folderCreated['name'], 'folder_id' => $folderCreated['folder_id'], 'items_count' => $folderCreated['items_count']]);
        }
    }

    /**
     * Handle the Course "updated" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function updated(Course $course)
    {
        //
    }

    /**
     * Handle the Course "deleted" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function deleted(Course $course)
    {
        //
    }

    /**
     * Handle the Course "restored" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function restored(Course $course)
    {
        //
    }

    /**
     * Handle the Course "force deleted" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function forceDeleted(Course $course)
    {
        //
    }
}
