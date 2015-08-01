<?php

use Illuminate\Database\Migrations\Migration;

class CreateVehicleTable extends Migration
{

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
            $table->integer('vehiclebodystyle_id')->unsigned();
            $table->integer('vehiclemake_id')->unsigned();
            $table->integer('vehiclemodelseries_id')->unsigned();
            $table->decimal('price', 10, 2);
            $table->bigInteger('kilometres');
            $table->string('colour', 10);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('vehiclebodystyle_id')->references('id')->on('vehiclebodystyle');
            $table->foreign('vehiclemake_id')->references('id')->on('vehiclemake');
            $table->foreign('vehiclemodelseries_id')->references('id')->on('vehiclemodelseries');
        });

        Schema::create('vehiclefeaturevalue', function ($table) {
            $table->increments('id');
            $table->integer('vehicle_id')->unsigned();
            $table->integer('vehiclefeature_id')->unsigned();
            $table->boolean('value');

            $table->foreign('vehicle_id')->references('id')->on('vehicle');
            $table->foreign('vehiclefeature_id')->references('id')->on('vehiclefeature');
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
