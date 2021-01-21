<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamCmMemberPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_cm_member', function (Blueprint $table) {
            $table->id();
            $table->integer('team_id')->unsigned();//team_center_managers table -> team_id
            $table->integer('center_manager_id')->unsigned();//users table ->user_id(user as center_manager)
            $table->timestamps();
            $table->foreign('team_id')
                ->references('id')->on('team_center_managers')
                ->onDelete('cascade');
            $table->foreign('center_manager_id')
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
        Schema::dropIfExists('team_cm_member');
    }
}
