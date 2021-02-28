<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->date('DOB')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('county_of_residence')->nullable();
            $table->string('academic_qualification')->nullable();
            $table->string('institution')->nullable();
            $table->string('center')->nullable();
            $table->string('tag')->nullable()->default("No");
            $table->string('contract')->nullable()->default("0");
            $table->string('contract_start_date')->nullable();
            $table->string('contract_end_date')->nullable();
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
        Schema::dropIfExists('user_profiles');
    }
}
