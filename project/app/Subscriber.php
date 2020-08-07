<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['email', 'scriber_id', 'scribed_id'];
    public $timestamps = false;
}
