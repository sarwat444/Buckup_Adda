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
        Schema::create('mokasher_implementions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mokasher_ex_year')->constrained('mokasher_execution_years')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('part_1')->nullable() ;
            $table->string('part_2')->nullable() ;
            $table->string('part_3')->nullable() ;
            $table->string('part_4')->nullable() ;
            $table->foreignId('added_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('mokasher_implementions');
    }
};
