<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replylike extends Model
{
    protected $fillable = ['reply_id', 'user_id','is_like','is_dislike'];
    public $timestamps = false;
    public function reply()
    {
    	return $this->belongsTo('App\Reply');
    }    
}
