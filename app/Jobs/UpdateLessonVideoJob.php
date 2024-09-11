<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\VimeoVideoService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use App\Models\Lesson;

class UpdateLessonVideoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $videos;

    public function __construct($videos)
    {
        $this->videos = $videos;
    }

    public function handle()
    {
        foreach ($this->videos as $video) {
            $vimeoVideo = VimeoVideoService::getVideo($video->video_id);
            if (!empty($vimeoVideo)) {
                $video->update(['duration' => $vimeoVideo['duration'], 'status' => $vimeoVideo['status']]);
            }
        }
    }
}
