<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainerDailyVirtualTrainingReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_daily_virtual_training_reports', function (Blueprint $table) {
            $table->id();
            $table->string('training_category');
            $table->string('trainer_name');
            $table->string('trainer_id');
            $table->string('total_trainees_morning_session');
            $table->string('total_trainees_afternoon_session');
            $table->string('total_trainees_all_session');
            $table->string('total_trainees_female');
            $table->string('total_trainees_male');
            $table->string('training_facilitation_techniques');
            $table->string('training_challenges');
            $table->string('training_recommendation');
            $table->string('training_trainers_available_missing');
            $table->string('trainees_photo');
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
        Schema::dropIfExists('trainer_daily_virtual_training_reports');
    }
}
