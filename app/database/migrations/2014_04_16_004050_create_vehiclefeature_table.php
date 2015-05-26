<?php

use Illuminate\Database\Migrations\Migration;

class CreateVehicleFeatureTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiclefeaturecategory', function ($table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('vehiclefeature', function ($table) {
            $table->increments('id');
            $table->integer('vehiclefeaturecategory_id')->unsigned();
            $table->string('name', 100);
            $table->enum('type', array('EQUIPMENT', 'SPEC'));
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('vehiclefeaturecategory_id')->references('id')->on('vehiclefeaturecategory');
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
