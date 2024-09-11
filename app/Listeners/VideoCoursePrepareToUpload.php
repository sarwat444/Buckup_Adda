<?php

namespace App\Listeners;

use App\Enums\CourseProvider;
use App\Events\CourseVideoPreparedToUpload;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class VideoCoursePrepareToUpload
{
    public function __construct()
    {
        //
    }

    public function handle(CourseVideoPreparedToUpload $event): void
    {
        $event->response['video_id'] = Str::of($event->response['uri'])->explode('/')->last();
        $event->course->video()->updateOrCreate(['course_id' => $event->course->id], [
            'folder_id' => $event->course->folder->id,
            'video_id' => $event->response['video_id'],
            'provider' => CourseProvider::vimeo->value,
            'status' => $event->response['transcode']['status'],
            'name' => $event->response['name'],
            'description' => $event->response['description'],
            'embed' => $event->response['embed']['html'],
            'upload_link' => $event->response['upload']['upload_link']
        ]);
    }
}
