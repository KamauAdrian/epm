<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppraisalSupervisorReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_supervisor_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('appraisal_id')->unsigned();
            $table->string('supervisor_score')->nullable();
            $table->text('supervisor_comment')->nullable();
            $table->integer('supervisor_id')->unsigned();
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
        Schema::dropIfExists('appraisal_supervisor_reports');
    }
}
