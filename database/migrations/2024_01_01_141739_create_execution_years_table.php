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
        Schema::create('execution_years', function (Blueprint $table) {
            $table->id();
            $table->string('year_name')->nullable() ;
            $table->string('value')->default(0) ;
            $table->foreignId('kheta_id')->constrained('khetas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->tinyInteger('selected')->default(0) ;
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
        Schema::dropIfExists('execution_years');
    }
};
