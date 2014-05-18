<?php

class VehicleMake extends Eloquent {

    protected $table = 'vehiclemake';

    protected $softDelete = true;

    public function vehicles() 
    {
        return $this->hasMany('Vehicle', 'vehiclemake_id');
    }

}
