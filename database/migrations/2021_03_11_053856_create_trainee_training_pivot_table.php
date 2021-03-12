<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraineeTrainingPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainee_training', function (Blueprint $table) {
            $table->id();
            $table->foreignId("training_id")->nullable()->constrained("trainings")->nullOnDelete();
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
        Schema::dropIfExists('trainee_training');
    }
}
