<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = ['title','user_id','photo'];
	public function videos()
	{
	     return $this->hasMany('App\Playlistvideo');
	}
	public function user()
	{
	     return $this->belongsTo('App\User');
	}
}
