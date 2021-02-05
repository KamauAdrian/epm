<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmoAppraisalSelfScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmo_appraisal_self_scores', function (Blueprint $table) {
            $table->id();
            $table->string('self_score')->nullable();
            $table->string('self_comment')->nullable();
            $table->integer('appraisal_id')->unsigned();
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
        Schema::dropIfExists('pmo_appraisal_self_scores');
    }
}
