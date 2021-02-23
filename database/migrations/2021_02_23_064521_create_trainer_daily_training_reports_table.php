<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainerDailyTrainingReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_daily_training_reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('employee_number');
            $table->date('date');
            $table->integer('trainer_id')->unsigned();
            $table->string('training_type');
            $table->string('training_category');
            $table->string('total_trainees');
            $table->string('total_trainees_female');
            $table->string('total_trainees_male');
            $table->text('trainer_challenges_achievements');
            $table->text('training_recommendation');
            $table->text('training_support');
            $table->string('training_photo');
            $table->string('training_photo_url');
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
        Schema::dropIfExists('trainer_daily_training_reports');
    }
}
