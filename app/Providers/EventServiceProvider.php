<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\InstructorUpdatedSectionLesson;
use App\Events\AssignOrderingToLessonWasCreated;
use App\Events\InstructorSectionLessonUpdated;
use App\Listeners\VideoLessonPreparedToUpload;
use App\Listeners\VideoCoursePrepareToUpload;
use App\Events\LessonVideoPreparedToUpload;
use App\Events\CourseVideoPreparedToUpload;
use App\Listeners\InstructorSectionUpdated;
use App\Listeners\AssignOrderingToLesson;
use App\Events\InstructorUpdateSection;
use Illuminate\Auth\Events\Registered;
use App\Events\VimeoFoldersFetched;
use App\Listeners\UserViewedLesson;
use App\Events\LessonViewedByUser;
use App\Listeners\FoldersFetched;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LessonVideoPreparedToUpload::class => [
            VideoLessonPreparedToUpload::class,
        ],
        CourseVideoPreparedToUpload::class => [
            VideoCoursePrepareToUpload::class,
        ],
        VimeoFoldersFetched::class => [
            FoldersFetched::class,
        ],
        AssignOrderingToLessonWasCreated::class => [
            AssignOrderingToLesson::class,
        ],
        InstructorUpdateSection::class => [
            InstructorSectionUpdated::class,
        ],
        InstructorSectionLessonUpdated::class => [
            InstructorUpdatedSectionLesson::class,
        ],
        LessonViewedByUser::class => [
            UserViewedLesson::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
