<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssigneeTaskPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignee_task', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('assignee_id')->unsigned();
            $table->bigInteger('task_id')->unsigned();
            $table->timestamps();


//            $table->foreign('task_id')
//                ->references('id')->on('tasks')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignee_task');
    }
}
