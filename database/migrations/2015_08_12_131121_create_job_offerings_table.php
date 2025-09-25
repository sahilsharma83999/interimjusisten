<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOfferingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offerings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('type',['intrim','permanent']);
            $table->string('immersion');
            $table->string('location');
            $table->string('organisation');
            $table->text('minimal_requirement');
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
        Schema::drop('job_offerings');
    }
}
