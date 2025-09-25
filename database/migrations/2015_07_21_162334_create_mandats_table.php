<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMandatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->timestamp('from');
            $table->timestamp('to');
            $table->string('umsatz')->nullable();
            $table->string('ma')->nullable();
            $table->string('worker')->nullable();
            $table->string('budget')->nullable();
            $table->integer('branche');
            $table->string('description',500);
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
        Schema::drop('mandats');
    }
}
