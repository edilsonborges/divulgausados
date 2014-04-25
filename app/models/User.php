<?php

class User extends Eloquent {

    protected $table = 'user';

    protected $softDelete = true;

    public function vehicles() 
    {
        $this->hasMany('Vehicle', 'user_id');
    }

}
