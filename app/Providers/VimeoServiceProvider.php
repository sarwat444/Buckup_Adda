<?php

namespace App\Providers;

use App\Repositories\VimeoFolderService;
use App\Repositories\VimeoVideoService;
use App\Services\Vimeo\VimeoFolder;
use App\Services\Vimeo\VimeoVideo;
use Illuminate\Support\ServiceProvider;

class VimeoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(VimeoFolderService::class,VimeoFolder::class);
        $this->app->bind(VimeoVideoService::class,VimeoVideo::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot():void
    {
        //
    }
}
