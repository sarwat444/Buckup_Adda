<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate() ;
            $table->string('phone') ;
            $table->string('phone2')->nullable() ;
            $table->string('experience_certifications')->nullable() ;
            $table->string('teaching_fileds') ;
            $table->string('teaching_languages') ;
            $table->string('linkedIn')->nullable() ;
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructor_details');
    }
};
