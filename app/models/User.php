<?php

use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    protected $table = 'user';
    protected $softDelete = true;

    public function vehicles()
    {
        $this->hasMany('Vehicle', 'user_id');
    }

    public function getAuthIdentifier()
    {

    }

    public function getAuthPassword()
    {

    }

    public function getRememberToken()
    {

    }

    public function setRememberToken($value)
    {

    }

    public function getRememberTokenName()
    {

    }

    public function getReminderEmail()
    {

    }
}