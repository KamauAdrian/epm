<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmoPerformanceAppraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmo_performance_appraisals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('pmo_id')->unsigned();
            $table->integer('supervisor_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('employee_number')->nullable();
            $table->string('department')->nullable();
            $table->string('self_overall_comment')->nullable();
            $table->string('supervisor_overall_comment')->nullable();
            $table->string('self_sign_date')->nullable();
            $table->string('self_signature')->nullable();
            $table->string('supervisor_sign_date')->nullable();
            $table->string('supervisor_signature')->nullable();
            $table->string('supervisor_status')->nullable()->default(0);
            $table->string('pmo_status')->nullable()->default(0);
//            $table->string('status')->nullable()->default('0');
            $table->string('improvement_areas')->nullable();
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
        Schema::dropIfExists('pmo_performance_appraisals');
    }
}
