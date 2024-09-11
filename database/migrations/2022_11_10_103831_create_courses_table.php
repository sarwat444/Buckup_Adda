<?php

use App\Constant\CourseOptions;
use App\Enums\CourseLevel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id()->from(21955486);
            $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->string('tags');
            $table->text('description');
            $table->integer('instructor_id')->nullable();
            $table->integer('video_type')->default(0);
            $table->text('path');
            $table->text('url');
            $table->text('seo');
            $table->float('price', 8, 2)->default(0);
            $table->float('old_price', 8, 2)->default(0);
            $table->boolean('level')->comment('1: Beginner, 2: Intermediate, 3: Expert');
            $table->boolean('is_top')->comment('1: top, 0: not_top')->default(0);
            $table->boolean('is_active')->comment('1: active, 0: not_active')->default(0);
            $table->boolean('is_free')->comment('1: free, 0: not_free')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
