<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamTrainerMemberPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_trainer_member', function (Blueprint $table) {
            $table->id();
            $table->integer('team_id')->unsigned();//team_trainers table -> team_id
            $table->integer('trainer_id')->unsigned();//users table ->user_id(user as trainer)
            $table->timestamps();
            $table->foreign('team_id')
                ->references('id')->on('team_trainers')
                ->onDelete('cascade');
            $table->foreign('trainer_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_trainer_member');
    }
}
