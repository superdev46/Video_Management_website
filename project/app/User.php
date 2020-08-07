<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $guard = 'user';

    protected $fillable = ['name', 'photo', 'description','email','f_url','g_url','t_url','l_url','password'];

    protected $hidden = [
        'password'
    ];  

    protected $remember_token = false;  


    public function videos()
    {
    	return $this->hasMany('App\Video');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
