<?php

class VehicleAccessory extends Eloquent {

    protected $table = 'vehicleaccessory';

    protected $softDelete = true;

    public function vehicles()
    {
        return $this->belongsToMany('Vehicle', 'vehicleaccessory_dependency', 'vehicle_id', 'vehicleaccessory_id');
    }

}
