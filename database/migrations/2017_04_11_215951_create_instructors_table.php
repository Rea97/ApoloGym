<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('first_surname', 50);
            $table->char('gender');
            $table->date('birth_date');
            $table->string('second_surname', 50)->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('phone_number', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->text('about_me')->nullable();
            $table->rememberToken();
            $table->timestamps();
            //$table->softDeletes();
        });
        DB::unprepared('ALTER TABLE instructors AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructors');
    }
}
