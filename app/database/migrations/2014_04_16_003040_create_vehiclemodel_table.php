<?php

use Illuminate\Database\Migrations\Migration;

class CreateVehicleModelTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiclemodel', function ($table) {
            $table->increments('id');
            $table->integer('vehiclebodystyle_id')->unsigned();
            $table->integer('vehiclemake_id')->unsigned();
            $table->string('name', 80);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('vehiclebodystyle_id')->references('id')->on('vehiclebodystyle');
            $table->foreign('vehiclemake_id')->references('id')->on('vehiclemake');
        });

        Schema::create('vehiclemodelseries', function ($table) {
            $table->increments('id');
            $table->integer('vehiclemodel_id')->unsigned()->nullable();
            $table->string('name', 80);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('vehiclemodel_id')->references('id')->on('vehiclemodel');
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
