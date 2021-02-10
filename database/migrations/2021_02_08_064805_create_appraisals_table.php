<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisals', function (Blueprint $table) {
            $table->id();
            $table->string('pmo');
            $table->string('pmo_email');
            $table->string('pmo_employee_number')->nullable();
            $table->string('pmo_department')->nullable();
            $table->integer('pmo_id')->unsigned();
            $table->string('question_one')->nullable();
            $table->string('question_two')->nullable();
            $table->string('question_three')->nullable();
            $table->string('question_four')->nullable();
            $table->string('question_five')->nullable();
            $table->string('pmo_title')->nullable();
            $table->text('pmo_overall_comment')->nullable();
            $table->string('pmo_sign_date')->nullable();
            $table->string('pmo_signature')->nullable();
            $table->integer('pmo_status')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('appraisals');
    }
}
