<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('due_date');
            $table->text('description')->nullable();
            $table->integer('status')->default(0);
            $table->date('completion_date')->nullable();
            $table->integer('creator_id')->unsigned();
            $table->bigInteger('project_id')->unsigned();
            $table->bigInteger('board_id')->unsigned();
            $table->timestamps();
            $table->foreign('board_id')
                ->references('id')->on('boards')
                ->onDelete('cascade');
//            $table->foreign('creator_id')
//                ->references('id')->on('users')
//                ->onDelete('set_null');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
