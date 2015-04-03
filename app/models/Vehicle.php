<?php

class Vehicle extends BaseModel
{

    protected $table = 'vehicle';

    protected $softDelete = true;

    protected static $rules = array(
        'vehiclebodystyle_id' => 'required',
        'vehiclemake_id' => 'required',
        'vehiclemodelseries_id' => 'required',
        'price' => 'required',
        'kilometres' => 'required',
    );

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

    public function scopeFilter($query)
    {
        $this->likeFilter($query, 'make', 'filter_by_make');
    }

}
