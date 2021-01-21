<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainerDailyAttendanceFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_daily_attendance_forms', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('name');
            $table->integer('trainer_id')->unsigned();
            $table->string('job_category');
            $table->string('job_task_role');
            $table->string('time');
            $table->string('comments');
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
        Schema::dropIfExists('trainer_daily_attendance_forms');
    }
}
