<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Course' => 'App\Policies\CoursesPolicy',
        'App\Models\Section' => 'App\Policies\Instructor\SectionPolicy',
        'App\Models\Lesson' => 'App\Policies\Instructor\LessonPolicy',
        'App\Models\Profile' => 'App\Policies\Instructor\ProfilePolicy',
        'App\Models\InstructorRequest' => 'App\Policies\InstructorRequestPolicy',
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        if (! $this->app->routesAreCached()) {
            Passport::ignoreRoutes();
        }

    }
}
