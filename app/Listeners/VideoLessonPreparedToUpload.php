<?php

namespace App\Listeners;

use App\Events\LessonVideoPreparedToUpload;
use App\Models\Course;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Enums\LessonProvider;
use Illuminate\Support\Str;
use App\Enums\LessonType;

class VideoLessonPreparedToUpload
{
    public static int $lessonId;

    public function __construct()
    {
    }

    public function handle(LessonVideoPreparedToUpload $event)
    {
        $event->response['video_id'] = Str::of($event->response['uri'])->explode('/')->last();
        $lesson = $event->lesson->create([
            'course_id' => request()->course_id,
            'section_id' => request()->section_id,
            'folder_id' => Course::find(request()->course_id)->with('folder')->first()->folder->id,
            'title' => request()->title,
            'type' => LessonType::video->value,
            'provider' => LessonProvider::vimeo->value,
            'is_free' => request()->is_free ? 1 : 0,
            'is_publish' => request()->is_publish ? 1 : 0,
            'video_id' => $event->response['video_id'],
            'status' => $event->response['transcode']['status'],
            'embed' => $event->response['embed']['html'],
            'upload_link' => $event->response['upload']['upload_link']
        ]);
        self::$lessonId = $lesson->id;
    }

    public static function getLessonId(): int
    {
        return self::$lessonId;
    }
}
