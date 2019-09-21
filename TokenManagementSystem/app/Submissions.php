<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submissions extends Model
{
    protected $fillable = [
        'subject_id', 'submission_id', 'subject_id', 'year', 'branch', 'type',
    ];

    public function subject(){

    	return $this->belongsTo(Subjects::class, $foreignKey='subject_id', $ownerKey='subject_id');

    }
}
