<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainerDailyAttendanceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_daily_attendance_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('trainer_id')->unsigned();
            $table->string('other_training_task_roles')->nullable();
            $table->string('comments')->nullable();
            $table->dateTime('date_time');
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
        Schema::dropIfExists('trainer_daily_attendance_reports');
    }
}
