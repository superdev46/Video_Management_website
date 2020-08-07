<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlistvideo extends Model
{
    protected $fillable = ['playlist_id','video_id'];
    public $timestamps = false;
    public function playlist()
    {
    	return $this->belongsTo('App\Playlist');
    }
   	public function video()
    {
    	return $this->belongsTo('App\Video');
    }
}
