<?php

class VehicleFeature extends BaseModel
{
    protected static $rules = array('name' => 'required|unique:vehiclefeature');
    protected $table = 'vehiclefeature';
    protected $softDelete = true;
    protected $fillable = array('id', 'name', 'type');

    public function vehicles()
    {
        return $this->belongsToMany('Vehicle', 'vehiclefeaturevalue', 'vehicle_id', 'vehiclefeature_id');
    }
    
    public function featureCategory()
    {
        return $this->belongsTo('VehicleFeatureCategory', 'vehiclefeaturecategory_id');
    }

    public function scopeFilter($query)
    {
        $this->likeFilter($query, 'name', 'filter_by_name');
        $this->equalToFilter($query, 'vehiclefeaturecategory_id', 'filter_by_category_id');
    }
}