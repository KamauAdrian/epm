<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clocks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('user_id');// ie who clocked in or out
            $table->string('status');//0 or 1 ie clocked in or out(0=out 1=in)
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
        Schema::dropIfExists('clocks');
    }
}
