<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['video_id', 'user_id','is_like','is_dislike'];
    public $timestamps = false;
    public function video()
    {
    	return $this->belongsTo('App\Video');
    }
}
