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
            $table->foreignId("center_id")->nullable()->constrained("centers")->nullOnDelete();
            $table->foreignId("institution_id")->nullable()->constrained("institutions")->nullOnDelete();
            $table->foreignId("cohort_id")->nullable()->constrained("cohorts")->nullOnDelete();
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
