<?php

class VehicleModelSeries extends Eloquent {

    protected $table = 'vehiclemodelseries';

    protected $softDelete = true;

    public function models() 
    {
        return $this->hasMany('VehicleModel', 'vehiclemodelseries_id');
    }

}
