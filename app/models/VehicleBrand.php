<?php

class VehicleBrand extends Eloquent {

    protected $table = 'vehiclebrand';

    protected $softDelete = true;

    public function vehicles() 
    {
        $this->hasMany('Vehicle', 'vehiclebrand_id');
    }

}
