<?php

use Illuminate\Database\Migrations\Migration;

class CreateVehicleMakeTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiclemake', function ($table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->string('brand_image_path', 80);
            $table->timestamps();
            $table->softDeletes();
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
