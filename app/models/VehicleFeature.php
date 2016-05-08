<?php

class VehicleFeature extends BaseModel
{
    protected static $rules = array('name' => 'required|unique:vehiclefeaturecategory');
    protected $table = 'vehiclefeature';
    protected $softDelete = true;
    protected $fillable = array('id', 'name', 'type');

    public function vehicles()
    {
        return $this->belongsToMany('Vehicle', 'vehiclefeaturevalue', 'vehicle_id', 'vehiclefeature_id');
    }
}