<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('course_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('folder_id')->unsigned()->index()->nullable();
            $table->foreign('folder_id')->references('id')->on('vimeo_folders')->onDelete('cascade');
            $table->string('video_id');
            $table->boolean('provider')->comment('1: youtube, 2: vimeo');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('duration')->default(0);
            $table->string('status');
            $table->text('embed')->nullable();
            $table->string('upload_link')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_videos');
    }
};
