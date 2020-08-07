<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['title','user_id','photo'];
	public function contents()
	{
	     return $this->hasMany('App\Channelcontent');
	}
	public function subscribes()
	{
	     return $this->hasMany('App\Subscribe');
	}
	public function user()
	{
	     return $this->belongsTo('App\User');
	}
}
