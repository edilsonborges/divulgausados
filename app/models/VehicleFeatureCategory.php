<?php

class VehicleFeatureCategory extends BaseModel
{
    protected static $rules = array('name' => 'required|unique:vehiclefeaturecategory');
    protected $table = 'vehiclefeaturecategory';
    protected $softDelete = true;
    protected $fillable = array('id', 'name');

    public function features()
    {
        return $this->hasMany('VehicleFeature', 'vehiclefeaturecategory_id');
    }

    public function scopeFilter($query)
    {
        $this->likeFilter($query, 'name', 'filter_by_name');
    }
}