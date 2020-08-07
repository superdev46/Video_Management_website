<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title','user_id','path','thumbnail','text','category_id','tags','type','url','is_top','is_slider'];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function playlist()
    {
        return $this->hasMany('App\Playlistvideo');
    }

    public function channel()
    {
        return $this->hasMany('App\Channelcontent');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
