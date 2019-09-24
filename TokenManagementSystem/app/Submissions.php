<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submissions extends Model
{
    protected $fillable = [
        'subject_id', 'teacher_id', 'year', 'branch', 'type', 'submission_date', 'start_time', 'end_time',
    ];

    public function subject(){

    	return $this->belongsTo(Subjects::class, $foreignKey='subject_id', $ownerKey='id');

    }

    public function teacher(){

    	return $this->belongsTo(Teachers::class, $foreignKey='teacher_id', $ownerKey='id');

    }

 //    public function getRouteKeyName()
	// {
 //    				return 'submission_id';
	// }
}
