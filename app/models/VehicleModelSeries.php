<?php

class VehicleModelSeries extends BaseModel {

    protected $table = 'vehiclemodelseries';

    protected $softDelete = true;

    public function models() 
    {
        return $this->hasOne('VehicleModel', 'vehiclemodel_id');
    }

}
