<?php

class VehicleBodyStyle extends Eloquent {

    protected $table = 'vehiclebodystyle';

    protected $softDelete = true;

    protected $fillable = array('id', 'name');

    public function vehicles()
    {
        return $this->hasMany('Vehicle', 'vehiclebodystyle_id');
    }

}
