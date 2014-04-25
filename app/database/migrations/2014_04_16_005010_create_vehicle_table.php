<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle', function ($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('vehiclemodel_id')->unsigned();
            $table->integer('vehiclecategory_id')->unsigned();
            $table->integer('vehiclebrand_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('vehiclecategory_id')->references('id')->on('vehiclecategory');
            $table->foreign('vehiclebrand_id')->references('id')->on('vehiclebrand');
            $table->foreign('vehiclemodel_id')->references('id')->on('vehiclemodel');
        });

        Schema::create('vehicleaccessory_dependency', function ($table) {
            $table->increments('id');
            $table->integer('vehicle_id')->unsigned();
            $table->integer('vehicleaccessory_id')->unsigned();
            $table->boolean('enabled');

            $table->foreign('vehicle_id')->references('id')->on('vehicle');
            $table->foreign('vehicleaccessory_id')->references('id')->on('vehicleaccessory');
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
