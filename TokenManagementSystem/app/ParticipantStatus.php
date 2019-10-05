<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticipantStatus extends Model
{
    protected $guarded=[];

    public function participant(){
    	return $this->hasOne('\App\Participant',$foreignKey="id",$localKey="participant_id");
    }

}
