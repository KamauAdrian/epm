<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_days', function (Blueprint $table) {
            $table->id();
            $table->integer('day');
            $table->date('date');
            $table->foreignId('training_id')->nullable()->constrained("trainings")->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained("job_categories")->nullOnDelete();
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
        Schema::dropIfExists('training_days');
    }
}
