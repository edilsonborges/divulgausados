<?php

class VehicleCategory extends Eloquent {

    protected $table = 'vehiclecategory';

    protected $softDelete = true;

    public function vehicles()
    {
        $this->hasMany('Vehicle', 'vehiclecategory_id');
    }

}
