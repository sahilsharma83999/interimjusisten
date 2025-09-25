<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKarrieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karrieres', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('from');
            $table->timestamp('to');
            $table->string('type');
            $table->integer('user_id');
            $table->integer('fachrichtung');
            $table->integer('spezialisierung')->nullable()->default(null);
            $table->string('description',500)->nullable();
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
        Schema::drop('karrieres');
    }
}
