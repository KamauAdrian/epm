<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string("training");
            $table->string("venue");
            $table->date("start_date");
            $table->date("end_date");
            $table->string("type");
            $table->integer("center_id")->unsigned()->nullable();
            $table->integer("institution_id")->unsigned()->nullable();
            $table->integer("cohort_id")->unsigned();
            $table->string("description");
            $table->string("status")->default("Pending");
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
        Schema::dropIfExists('trainings');
    }
}
