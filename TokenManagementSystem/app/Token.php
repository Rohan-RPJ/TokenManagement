<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Students;
use App\Submissions;

class Token extends Model
{
	protected $guarded= [];
    public function student(){
    	return $this->hasOne('\App\Students',$foreignKey='student_id');
    }

    public function submission(){
    	return $this->hasOne('\App\Submissions', $foreignKey="submission_id");
    }

}
