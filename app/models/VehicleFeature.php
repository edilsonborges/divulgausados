<?php

class VehicleFeature extends Eloquent {

    protected $table = 'vehiclefeature';

    protected $softDelete = true;

    public function vehicles()
    {
        return $this->belongsToMany('Vehicle', 'vehiclefeaturevalue', 'vehicle_id', 'vehiclefeature_id');
    }

}
