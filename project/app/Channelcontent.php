<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channelcontent extends Model
{
    protected $fillable = ['playlist_id','video_id','type','channel_id'];
    public $timestamps = false;
    public function channel()
    {
    	return $this->belongsTo('App\Channel');
    }    
    public function playlist()
    {
    	return $this->belongsTo('App\Playlist');
    }
   	public function video()
    {
    	return $this->belongsTo('App\Video');
    }   
}
