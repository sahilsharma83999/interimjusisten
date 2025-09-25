<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            // $table->string('name');
            $table->string('email')->unique(); 
            $table->string('password', 60);
            $table->enum('title_gender',['Herr','Frau'])->nullable();
            $table->enum('title_graduation',['Prof. Dr.','Prof.','Dr. jur.','LL.M.','Dipl.-Ing.','MBA','M. Sc.'])->nullable();
            $table->string('forename')->nullable();
            $table->string('surname')->nullable();
            $table->timestamp('birthdate')->nullable();
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->enum('country',['Deutschland','Schweiz','Österreich'])->nullable();
            $table->string('email2')->nullable();
            $table->string('mobil')->nullable();
            $table->string('phone_private')->nullable();
            $table->string('phone_comercial')->nullable();
            $table->string('fax')->nullable();
            $table->string('email_signature')->nullable();
            $table->string('homepage')->nullable();
            $table->string('aktivkey',32);
            $table->boolean('aktiv')->default(false);
            $table->boolean('admin')->dfeault(false);
            $table->string('role')->nullable();
            $table->text('self_evaluation')->nullable();

            $table->boolean('festanstellung')->default(false);
            $table->boolean('interimManger')->default(false);
            $table->boolean('managementBuyIn')->default(false);

            $table->rememberToken();
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
        Schema::drop('users');
    }
}
