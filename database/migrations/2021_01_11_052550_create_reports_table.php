<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('employee_number');
            $table->string('date_of_report');
            $table->string('duty_station');
            $table->string('role');//name role of admin in report
            $table->integer('user_id')->unsigned();// id of admin submitting the report
            $table->integer('report_target_group_id')->unsigned();
            $table->integer('report_template_id')->unsigned();// report template id
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
        Schema::dropIfExists('reports');
    }
}
