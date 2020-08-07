<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sociallink extends Model
{
    protected $fillable = ['facebook', 'twitter', 'gplus', 'linkedin', 'f_status', 't_status', 'g_status', 'l_status'];
    public $timestamps = false;
}
