<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilisationActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobilisation_activities', function (Blueprint $table) {
            $table->id();
            $table->string('activity_name');
            $table->string('county');
            $table->string('town');
            $table->time('time');
            $table->date('Date');
            $table->string('center_id');
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
        Schema::dropIfExists('mobilisation_activities');
    }
}
