<?php

class Vehicle extends Eloquent {

    protected $table = 'vehicle';

    protected $softDelete = true;

    public function owner() 
    {
        return $this->belongsTo('User');
    }

    public function bodyStyle() 
    {
        return $this->belongsTo('VehicleBodyStyle');
    }

    public function make() 
    {
        return $this->belongsTo('VehicleMake');
    }

    public function model() 
    {
        return $this->belongsTo('VehicleModel');
    }

    public function features() 
    {
        return $this->belongsToMany('VehicleFeature', 'vehicleafeaturevalue', 'vehiclefeature_id', 'vehicle_id');
    }

}