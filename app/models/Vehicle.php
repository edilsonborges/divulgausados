<?php

class Vehicle extends BaseModel
{
    protected static $rules = array(
        'vehiclebodystyle_id' => 'required',
        'vehiclemake_id' => 'required',
        'vehiclemodelseries_id' => 'required',
        'price' => 'required',
        'kilometres' => 'required',
    );
    protected $table = 'vehicle';
    protected $softDelete = true;
    protected $fillable = array('id', 'user_id', 'vehiclebodystyle_id', 'vehiclemake_id', 'vehiclemodelseries_id', 'price', 'kilometres', 'colour');

    public function owner()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function bodyStyle()
    {
        return $this->belongsTo('VehicleBodyStyle', 'vehiclebodystyle_id');
    }

    public function make()
    {
        return $this->belongsTo('VehicleMake', 'vehiclemake_id');
    }

    public function modelSeries()
    {
        return $this->belongsTo('VehicleModelSeries', 'vehiclemodelseries_id');
    }

    public function features()
    {
        return $this->belongsToMany('VehicleFeature', 'vehiclefeaturevalue', 'vehiclefeature_id', 'vehicle_id');
    }

    public function scopeFilter($query)
    {
        $this->equalToFilter($query, 'vehiclebodystyle_id', 'filter_by_body_style_id');
        $this->equalToFilter($query, 'vehiclemake_id', 'filter_by_make_id');
        $this->equalToFilter($query, 'vehiclemodelseries_id', 'filter_by_model_series_id');
    }
}