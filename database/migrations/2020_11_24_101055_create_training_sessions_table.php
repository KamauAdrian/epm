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
            $table->string('mode');// virtual or Physical
            $table->string('institution')->nullable();//institution
            $table->string('county')->nullable();//county
            $table->string('location')->nullable();//town/location
            $table->string('location_lat_long')->nullable();//geo coordinates
            $table->string('about');//short session description
            $table->string('status')->default('Pending');//ie active or pending or complete default pending
            $table->string('type')->nullable();//if virtual(public or private)
            $table->string('category');//session training category(data management, transcription ..etc)
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
