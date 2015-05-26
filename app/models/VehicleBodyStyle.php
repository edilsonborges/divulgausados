<?php

/**
 * Model class to represent vehicle body styles.
 */
class VehicleBodyStyle extends BaseModel
{
    protected static $rules = array('name' => 'required|unique:vehiclebodystyle');
    protected $table = 'vehiclebodystyle';
    protected $softDelete = true;
    protected $fillable = array('id', 'name');

    /**
     * Retrieve a vehicle list that belongs to this body style.
     *
     * @return array
     */
    public function vehicles()
    {
        return $this->hasMany('Vehicle', 'vehiclebodystyle_id');
    }

    public function scopeFilter($query)
    {
        $this->likeFilter($query, 'name', 'filter_by_name');
    }
}