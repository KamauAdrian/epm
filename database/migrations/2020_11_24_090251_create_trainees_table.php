<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->string('county');
            $table->string('location');
            $table->string('category');// digital marketing,,data management, transcription, content writing,virtual assistant            $table->string('county');
            $table->string('level_of_computer_literacy');//select beginner,intermediate,proficient
            $table->string('level_of_education');//select secondary, university,..
            $table->string('field_of_study');
            $table->string('email');
            $table->string('phone_number');
            $table->string('id_number');
            $table->integer('age');
            $table->string('interests');
//            $table->integer('day_id');
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
        Schema::dropIfExists('trainees');
    }
}
