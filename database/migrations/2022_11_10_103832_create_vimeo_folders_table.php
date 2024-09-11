<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Course;
use App\Models\User;

return new class extends Migration {
    public function up()
    {
        Schema::create('vimeo_folders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('folder_id')->unique();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Course::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name')->unique();
            $table->unsignedInteger('items_count');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vimeo_folders');
    }
};
