<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    public function country(){

    	return $this->belongsTo('App\Country');
    }
}
