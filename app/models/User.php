<?php

use Illuminate\Auth\UserInterface;

class User extends BaseModel implements UserInterface
{
    protected static $rules = array('email' => 'required|unique:users', 'name' => 'required:users', 'password' => 'required:users');
    protected $table = 'users';
    protected $softDelete = true;
    protected $fillable = array('id', 'name', 'email');
    protected $hidden = array('password');

    protected $remeberToken;

    public function vehicles()
    {
        $this->hasMany('Vehicle', 'user_id');
    }

    public function getAuthIdentifier()
    {
        return $this->attributes['id'];
    }

    public function getAuthPassword()
    {
        return $this->attributes['password'];
    }

    public function getRememberToken()
    {
        return $this->remeberToken;
    }

    public function setRememberToken($remeberToken)
    {
        $this->remeberToken = $remeberToken;
    }

    public function getRememberTokenName()
    {

    }

    public function scopeFilter($query)
    {
        $this->likeFilter($query, 'name', 'filter_by_name');
    }

}