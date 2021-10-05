<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
   public function category(){
    	return $this->belongsTo('App\Category');
   }

   public function ads(){
      return $this->hasMany('App\Advertisment','subcategory_id',);
   }

}
