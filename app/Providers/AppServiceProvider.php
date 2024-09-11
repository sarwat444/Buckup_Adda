<?php

namespace App\Providers;

use App\Models\Execution_year;
use App\Models\MokasherInput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Observers\CourseObserver;
use App\Models\Course;

class AppServiceProvider extends ServiceProvider
{

    public function register():void
    {
    }

    public function boot():void
    {
        Course::observe(CourseObserver::class);
        Model::preventLazyLoading();
        Model::unguard();
/*
        // Retrieve the selected year from the database
        $selectedYear = Execution_year::where('selected', 1)->value('year_name');
        // Bind the selected year to the service container as a global variable
        config(['app.selected_year' => $selectedYear ]);
*/
    }
}
