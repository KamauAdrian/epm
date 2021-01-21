<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainerDailyPhysicallTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_daily_physicall_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('county');
            $table->string('constituency');
            $table->string('center');
            $table->string('total_trainees');
            $table->string('total_trainees_female');
            $table->string('total_trainees_male');
            $table->string('trainer_challenges_achievements');
            $table->string('training_recommendation');
            $table->string('training_support');
            $table->string('training_photo');
            $table->string('next_training');
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
        Schema::dropIfExists('trainer_daily_physicall_trainings');
    }
}
