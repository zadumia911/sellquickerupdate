<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
   protected $fillable=[];
   public function division(){
    	return $this->hasMany('App\Division')->where('status',1);
   }
   public function thanas(){
    	return $this->hasMany('App\Thana')->where('status',1);
    }
}
