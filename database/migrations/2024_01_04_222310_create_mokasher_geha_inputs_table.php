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
        Schema::create('mokasher_geha_inputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mokasher_id')->constrained('mokashers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('geha_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('sub_geha_id')->nullable() ;
            $table->text('target')->nullable() ;
            $table->foreignId('year_id')->constrained('execution_years')->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('part_1')->default(0) ;
            $table->string('rate_part_1')->default(0) ;
            $table->text('evidence1')->nullable() ;
            $table->text('vivacity1')->nullable()  ;
            $table->text('impediments1')->nullable()  ;

            $table->string('part_2')->default(0) ;
            $table->string('rate_part_2')->default(0) ;
            $table->text('evidence2')->nullable() ;
            $table->text('vivacity2')->nullable()  ;
            $table->text('impediments2')->nullable()  ;


            $table->string('part_3')->default(0) ;
            $table->string('rate_part_3')->default(0) ;
            $table->text('evidence3')->nullable() ;
            $table->text('vivacity3')->nullable()  ;
            $table->text('impediments3')->nullable()  ;

            $table->string('part_4')->default(0) ;
            $table->string('rate_part_4')->default(0) ;
            $table->text('evidence4')->nullable() ;
            $table->text('vivacity4')->nullable()  ;
            $table->text('impediments4')->nullable()  ;

            $table->tinyInteger('accept')->default(0);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('mokasher_geha_inputs');
    }
};
