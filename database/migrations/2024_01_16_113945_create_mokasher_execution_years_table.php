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
        Schema::create('mokasher_execution_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mokasher_id')->constrained('mokashers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('year_id')->constrained('execution_years')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('value')->nullable() ;
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
        Schema::dropIfExists('mokasher_execution_years');
    }
};
