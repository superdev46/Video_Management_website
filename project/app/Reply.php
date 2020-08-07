<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['comment_id', 'user_id','text'];
    
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

	public function replylikes()
	{
	     return $this->hasMany('App\Replylike');
	}

    public function comment()
    {
    	return $this->belongsTo('App\Comment');
    }

}
