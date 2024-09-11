<?php

namespace Database\Seeders;

use App\Enums\InstructorRequestStatus;
use App\Models\Kheta;
use App\Models\Mangement;
use App\Models\RatingMember;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        Kheta::factory(1)->create() ;
        Admin::factory(1)->create();
        Mangement::factory(1)->create() ;
        User::factory(1)->create();
        RatingMember::factory(1)->create();
    }
}
