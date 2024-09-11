<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command as CommandAlias;
use App\Jobs\UpdateLessonVideoJob;
use Illuminate\Console\Command;
use App\Models\Lesson;

class UpdateVimeoVideo extends Command
{

    protected $signature = 'update:video';

    protected $description = 'Update Vimeo Video Status and Duration';

    public function handle(): int
    {
        Lesson::typeVideo()->WhereStatusNotAvailable()->chunk(10, function ($videos) {
            UpdateLessonVideoJob::dispatch($videos);
        });
        return CommandAlias::SUCCESS;
    }
}
