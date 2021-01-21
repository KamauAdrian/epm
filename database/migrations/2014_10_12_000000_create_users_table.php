<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('gender')->nullable();
            $table->string('county')->nullable();
            $table->string('location')->nullable();
            $table->string('location_lat_long')->nullable();
            $table->text('bio')->nullable();
            $table->string('image')->nullable();
            $table->integer('center_id')->nullable();
            $table->string('department')->nullable();
            $table->string('speciality')->nullable();
            $table->date('start_date')->nullable();
            $table->integer('creator_id')->nullable();
            $table->string('password')->nullable();
            $table->integer('is_admin');
            $table->integer('role_id')->default(0);
            $table->string('employee_number')->nullable();
            $table->string('office_supplies')->nullable();
            $table->string('laptop_type')->nullable();
            $table->string('laptop_serial_number')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
