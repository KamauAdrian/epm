<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainerOfficeSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_office_supplies', function (Blueprint $table) {
            $table->id();
            $table->string('contract');
            $table->string('contract_name')->nullable();
            $table->string('contract_download_link')->nullable();
            $table->string('tag');
            $table->string('laptop');
            $table->string('laptop_serial_number')->nullable();
            $table->string('laptop_type')->nullable();
            $table->integer('trainer_id')->unsigned();
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
        Schema::dropIfExists('trainer_office_supplies');
    }
}
