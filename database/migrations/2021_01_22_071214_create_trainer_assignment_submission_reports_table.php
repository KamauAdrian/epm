<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainerAssignmentSubmissionReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_assignment_submission_reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('trainer_id')->unsigned();
            $table->string('employee_number');
            $table->string('speciality');
            $table->string('assignment');
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
        Schema::dropIfExists('trainer_assignment_submission_reports');
    }
}