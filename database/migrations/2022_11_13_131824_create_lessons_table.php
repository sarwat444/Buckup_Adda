<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('folder_id')->unsigned()->index()->nullable();
            $table->foreign('folder_id')->references('id')->on('vimeo_folders')->onDelete('cascade');
            $table->string('title');
            $table->tinyInteger('type')->comment('1: for video,2: for document')->default(1);
            $table->boolean('provider')->comment('1: youtube, 2: vimeo, 3: url');
            $table->boolean('is_free')->default(0);
            $table->boolean('is_publish')->default(0);
            $table->integer('ordering')->default(0);
            $table->string('video_id')->nullable();
            $table->string('duration')->nullable();
            $table->string('status')->nullable();
            $table->text('embed')->nullable();
            $table->string('upload_link')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lessons');
    }
};
