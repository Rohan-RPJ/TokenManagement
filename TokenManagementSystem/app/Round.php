<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    private $guarded= [];

    public function submission()
    {
    	return $this->belongsTo('\App\Submissions');

    }

    public function participants()
    {
    	return $this->hasMany('\App\Participant');

    }

    public function questions()
    {
    	return $this->hasMany('\App\Questions');
    }
}
