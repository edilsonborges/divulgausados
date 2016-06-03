<?php

class VehicleFeatureValue extends BaseModel
{
    protected static $rules = [
        'vehicle_id' => 'required',
        'vehiclefeature_id' => 'required',
        'value' => 'required',
    ];
    protected $table = 'vehiclefeaturevalue';
    protected $softDelete = false;
    protected $fillable = ['id', 'vehicle_id', 'vehiclefeature_id', 'value'];

    public function vehicle()
    {
        return $this->belongsTo('Vehicle', 'vehicle_id');
    }

    public function feature()
    {
        return $this->belongsTo('VehicleFeature', 'vehiclefeature_id');
    }

    public function scopeFilter($query)
    {
        $this->equalToFilter($query, 'vehicle_id', 'filter_by_vehicle_id');
    }

}
