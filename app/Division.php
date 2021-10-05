<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable=[];
    public function districts(){
    	return $this->hasMany('App\District')->where('status',1);
    }
}
