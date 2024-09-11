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
        Schema::create('instructor_bankdetails', function (Blueprint $table) {
            $table->increments('id') ;
            $table->string('account_name') ;
            $table->foreignIdFor(App\Models\User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate() ;
            $table->string('bank_country') ;
            $table->string('bank_name') ;
            $table->string('account_number') ;
            $table->string('account_iban') ;
            $table->string('swift_code') ;
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
        Schema::dropIfExists('instructor__bankdetails');
    }
};
