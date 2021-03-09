<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionFacilitatorPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_facilitator', function (Blueprint $table) {
            $table->id();
            $table->foreignId("session_id")->constrained("sessions")->onDelete("cascade");
            $table->foreignId("facilitator_id")->nullable()->constrained("users","id")->nullOnDelete();
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
        Schema::dropIfExists('session_facilitator');
    }
}
