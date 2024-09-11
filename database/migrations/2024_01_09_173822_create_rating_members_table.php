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
        Schema::create('rating_members', function (Blueprint $table) {
            $table->id();
            $table->text('username')->nullable();
            $table->string('job_number')->nullable();
            $table->string('password');
            $table->string('gehat')->nullable();
            $table->foreignId('kheta_id')->constrained('khetas')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('rating_members');
    }
};
