<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuslandsProjektesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auslands_projektes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->timestamp('from');
            $table->timestamp('to');
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
        Schema::drop('auslands_projektes');
    }
}
