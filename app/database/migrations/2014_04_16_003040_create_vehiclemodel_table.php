<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleModelTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiclemodelseries', function ($table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('vehiclemodel', function ($table) {
            $table->increments('id');
            $table->integer('vehiclemake_id')->unsigned();
            $table->integer('vehiclemodelseries_id')->unsigned()->nullable();
            $table->string('name', 80);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('vehiclemake_id')->references('id')->on('vehiclemake');
            $table->foreign('vehiclemodelseries_id')->references('id')->on('vehiclemodelseries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }

}
