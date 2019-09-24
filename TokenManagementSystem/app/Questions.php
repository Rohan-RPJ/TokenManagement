<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = [
        'subject_id', 'question_description', 'option1', 'option2', 'option3', 'option4', 'correct_option', 'count',
    ];

    public function subject(){

    	return $this->belongsTo(Subjects::class, $foreignKey='subject_id', $ownerKey='id');

    }
}
