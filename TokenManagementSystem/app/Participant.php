<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $guarded = []; //allowing mass assignment

    public function student(){
    	return $this->hasOne('\App\Students');
    }

	public function round(){
    	return $this->belongsTo('\App\Round',$foreignKey='participant_id', $ownerKey='id');
	}

	public function submission(){
		return $this->belongsTo('\App\Submissions',$foreignKey='submission_id',$ownerKey='id');
	}

}
