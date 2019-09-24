<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    private $guarded = []; //allowing mass assignment

    public function student(){
    	return $this->hasOne('\App\Students');
    }

	public function round(){
    	return $this->belongsTo('\App\Round');
	}

}
