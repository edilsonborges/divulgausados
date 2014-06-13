<?php

/**
 * Model class to represent vehicle body styles.
 */
class VehicleBodyStyle extends BaseModel {

    protected $table = 'vehiclebodystyle';

    protected $softDelete = true;

    protected $fillable = array('id', 'name');

    protected static $rules = array('name' => 'required|unique:vehiclebodystyle');

    /**
     * Retrieve a vehicle list that belongs to this body style.
     *
     * @return array
     */
    public function vehicles()
    {
        return $this->hasMany('Vehicle', 'vehiclebodystyle_id');
    }

}
