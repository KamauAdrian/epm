<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmoPerformanceAppraisalReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmo_performance_appraisal_reports', function (Blueprint $table) {
            $table->id();
            $table->string('pmo');
            $table->integer('pmo_id')->unsigned();
            $table->string('supervisor');
            $table->integer('supervisor_id')->unsigned();
            $table->string('pmo_status')->nullable()->default(0);
            $table->string('supervisor_status')->nullable()->default(0);
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
        Schema::dropIfExists('pmo_performance_appraisal_reports');
    }
}
