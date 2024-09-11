<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('instructor_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('message');
            $table->tinyInteger('status')->default(0)->comment('0: pending, 1: accepted, 2: rejected');
            $table->date('requested_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('instructor_requests');
    }
};
