<?php

class VehicleModelSeries extends BaseModel
{
    protected static $rules = array('name' => 'required|unique:vehiclemodelseries');
    protected $table = 'vehiclemodelseries';
    protected $softDelete = true;
    protected $fillable = array('id', 'name');

    public function model()
    {
        return $this->belongsTo('VehicleModel', 'vehiclemodel_id');
    }

    public function scopeFilter($query)
    {
        $this->equalToFilter($query, 'vehiclemodel_id', 'filter_by_model_id');
        $this->likeFilter($query, 'name', 'filter_by_name');
    }
}