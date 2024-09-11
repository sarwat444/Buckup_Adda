<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->nullable()->unique();
            $table->tinyInteger('status')->default(1)->comment('1: pending, 2: completed, 3: cancelled, 4: rejected');
            $table->tinyInteger('type')->comment('1: local, 2: online');
            $table->float('amount', 8, 2);
            $table->string('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
