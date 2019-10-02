<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCalls extends Model
{
    protected $fillable = [
        'submission_id', 'student_id',
    ];
}
