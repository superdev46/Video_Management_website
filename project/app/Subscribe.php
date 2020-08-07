<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = ['channel_id','user_id'];
    public function channel()
    {
    	return $this->belongsTo('App\Channel');
    }
    public function channelcontent()
    {
    	return $this->belongsTo('App\Channelcontent');
    }
}
