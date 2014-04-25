<?php

class Vehicle extends Eloquent {

    protected $table = 'vehicle';

    protected $softDelete = true;

    public function owner() 
    {
        return $this->belongsTo('User');
    }

    public function category() 
    {
        return $this->belongsTo('VehicleCategory');
    }

    public function brand() 
    {
        return $this->belongsTo('VehicleBrand');
    }

    public function model() 
    {
        return $this->belongsTo('VehicleModel');
    }

    public function accessories() 
    {
        return $this->belongsToMany('VehicleAccessory', 'vehicleaccessory_dependency', 'vehicleaccessory_id', 'vehicle_id');
    }

}