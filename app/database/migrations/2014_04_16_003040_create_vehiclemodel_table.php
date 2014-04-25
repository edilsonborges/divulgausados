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
        Schema::create('vehiclemodel', function ($table) {
            $table->increments('id');
            $table->integer('vehiclebrand_id')->unsigned();
            $table->string('name', 80);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('vehiclebrand_id')->references('id')->on('vehiclebrand');
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
