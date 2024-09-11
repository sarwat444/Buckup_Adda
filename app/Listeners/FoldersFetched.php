<?php

namespace App\Listeners;

use App\Events\VimeoFoldersFetched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FoldersFetched
{
    public function __construct()
    {
    }

    public function handle(VimeoFoldersFetched $event): void
    {
        foreach ($event->apiFolders['data'] as $folder) {
            $event->vimeoFolder->updateOrCreate(['folder_id' => $folder['folder_id']], [
                'name' => $folder['name'],
                'items_count' => $folder['items_count']
            ]);
        }
    }
}
