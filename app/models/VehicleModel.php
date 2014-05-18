<?php

class VehicleModel extends Eloquent {

    protected $table = 'vehiclemodel';

    protected $softDelete = true;

    public function vehicles() 
    {
        return $this->hasMany('Vehicle', 'vehiclemodel_id');
    }

}