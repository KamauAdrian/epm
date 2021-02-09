<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppraisalSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_supervisors', function (Blueprint $table) {
            $table->id();
            $table->string('supervisor');
            $table->string('supervisor_email');
            $table->integer('supervisor_id')->unsigned();
            $table->integer('appraisal_id')->unsigned();
            $table->text('supervisor_overall_comment')->nullable();
            $table->string('supervisor_sign_date')->nullable();
            $table->string('supervisor_signature')->nullable();
            $table->text('improvement_areas')->nullable();
            $table->integer('supervisor_status')->default(0);
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
        Schema::dropIfExists('appraisal_supervisors');
    }
}
