<?php

class VehicleModel extends Eloquent {

    protected $table = 'vehiclemodel';

    protected $softDelete = true;

    public function vehicles() 
    {
        $this->hasMany('Vehicle', 'vehiclemodel_id');
    }

}