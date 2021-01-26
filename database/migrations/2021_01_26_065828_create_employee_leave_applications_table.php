<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLeaveApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leave_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('applicant_id')->unsigned();
            $table->string('applicant_name');
            $table->string('applicant_email');
            $table->string('applicant_phone');
            $table->string('leave_days');
            $table->string('leave_first_day');
            $table->string('leave_last_day');
            $table->string('applicant_duty_station');
            $table->string('applicant_maternity_leave_due_date')->nullable();
            $table->string('applicant_sick_off_study_leave_proof')->nullable();
            $table->string('colleague_name');
            $table->string('colleague_email');
            $table->string('colleague_phone');
            $table->string('colleague_designation');
            $table->string('colleague_duty_station');
            $table->string('next_of_kin_name');
            $table->string('next_of_kin_email');
            $table->string('next_of_kin_phone');
            $table->string('general_comment_concern');
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
        Schema::dropIfExists('employee_leave_applications');
    }
}
