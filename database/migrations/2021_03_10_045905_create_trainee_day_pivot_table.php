<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraineeDayPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainee_day', function (Blueprint $table) {
            $table->id();
            $table->foreignId("day_id")->nullable()->constrained("training_days")->nullOnDelete();
            $table->foreignId("trainee_id")->nullable()->constrained("trainees")->nullOnDelete();
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
        Schema::dropIfExists('trainee_day');
    }
}
