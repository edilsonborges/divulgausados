<?php

/**
 * Model class to represent vehicle makes.
 */
class VehicleMake extends BaseModel
{
    protected static $rules = array('name' => 'required|unique:vehiclemake');
    protected $table = 'vehiclemake';
    protected $softDelete = true;
    protected $fillable = array('id', 'name');

    /**
     * Retrieve a vehicle list that belongs to this make.
     *
     * @return array
     */
    public function vehicles()
    {
        return $this->hasMany('Vehicle', 'vehiclemake_id');
    }

    public function models()
    {
        return $this->hasMany('VehicleModel', 'vehiclemake_id');
    }

    public function scopeFilter($query)
    {
        $this->likeFilter($query, 'name', 'filter_by_name');
    }
}