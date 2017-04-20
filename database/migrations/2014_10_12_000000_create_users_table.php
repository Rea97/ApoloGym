<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('name', 50);
            /*Pendientes*/
            //$table->string('first_surname', 50);
            //$table->string('second_surname', 50)->nullable();
            //$table->string('profile_picture')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        /*
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('instructor_id')->unsigned();
            $table->foreign('instructor_id')->references('id')->on('instructors');
            //$table->integer('instructor_id')->unsigned()->index()->nullable();
            $table->string('name', 50);
            $table->string('first_surname', 50);
            $table->string('second_surname', 50)->nullable();
            $table->char('gender');
            $table->tinyInteger('age');
            $table->tinyInteger('height')->unsigned();
            $table->tinyInteger('weight')->unsigned();
            $table->string('phone_number', 50);
            $table->string('address', 100);
            $table->string('rfc', 30)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
