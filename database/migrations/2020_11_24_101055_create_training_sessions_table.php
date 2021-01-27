<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('name');//session name
            $table->string('date');//session date
            $table->string('start_time');//session start time
            $table->string('end_time');//session end time
            $table->string('institution');//institution
            $table->string('town');//town
            $table->string('about');//short session description
            $table->string('status')->default('Pending');//ie active or pending or complete default pending
            $table->string('type');
            $table->string('category');
            $table->string('google_meet_link')->nullable();//Google meet link
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
        Schema::dropIfExists('training_sessions');
    }
}
