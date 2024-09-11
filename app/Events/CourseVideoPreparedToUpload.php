<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel;
use App\Models\Course;

class CourseVideoPreparedToUpload
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Course $course, public array $response)
    {
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('channel-name');
    }
}
