<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['cat_name', 'cat_slug'];
    public $timestamps = false;

    public function videos()
    {
    	return $this->hasMany('App\Video');
    }
}
