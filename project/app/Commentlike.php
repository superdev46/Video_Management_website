<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentlike extends Model
{
    protected $fillable = ['comment_id', 'user_id','is_like','is_dislike'];
    public $timestamps = false;
    public function comment()
    {
    	return $this->belongsTo('App\Comment');
    }    
}
