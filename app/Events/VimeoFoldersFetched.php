<?php

namespace App\Events;

use App\Models\VimeoFolder;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VimeoFoldersFetched
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public VimeoFolder $vimeoFolder, public array $apiFolders)
    {
        //
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
