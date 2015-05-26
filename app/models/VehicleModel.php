<?php

class VehicleModel extends BaseModel
{
    protected static $rules = array('name' => 'required|unique:vehiclemodel');
    protected $table = 'vehiclemodel';
    protected $softDelete = true;
    protected $fillable = array('id', 'name', 'vehiclemake_id');

    public function make()
    {
        return $this->belongsTo('VehicleMake', 'vehiclemake_id');
    }

    public function modelSeries()
    {
        return $this->hasMany('VehicleModelSeries', 'vehiclemodel_id');
    }

    public function scopeFilter($query)
    {
        $this->equalToFilter($query, 'vehiclemake_id', 'filter_by_make_id');
        $this->likeFilter($query, 'name', 'filter_by_name');
    }
}