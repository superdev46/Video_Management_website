<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['video_id', 'user_id','text'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function video()
    {
    	return $this->belongsTo('App\Video');
    }

	public function replies()
	{
	     return $this->hasMany('App\Reply');
	}

	public function commentlikes()
	{
	     return $this->hasMany('App\Commentlike');
	}
 }
