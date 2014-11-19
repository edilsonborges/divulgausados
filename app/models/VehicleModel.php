<?php

class VehicleModel extends BaseModel {

    protected $table = 'vehiclemodel';

    protected $softDelete = true;

    public function make() 
    {
        return $this->hasOne('VehicleMake', 'vehiclemake_id');
    }

    public function modelSeries()
    {
    	return $this->hasMany('VehicleModelSeries', 'vehiclemodelseries_id');
    }

}