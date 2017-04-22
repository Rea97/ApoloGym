<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorsScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('instructor_id')->unsigned();
            $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');
            $table->enum('day', [1, 2, 3, 4, 5, 6, 7]);
            $table->time('from')->nullable();
            $table->time('to')->nullable();
            $table->tinyInteger('hours')->nullable();
            $table->timestamps();
            /*
            $table->integer('instructor_id')->references('id')->on('instructors');
            $table->time('monday')->nullable();
            $table->time('tuesday')->nullable();
            $table->time('wednesday')->nullable();
            $table->time('thursday')->nullable();
            $table->time('friday')->nullable();
            $table->time('saturday')->nullable();
            $table->time('sunday')->nullable();
            $table->integer('hours');
            */

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructors_schedule');
    }
}
