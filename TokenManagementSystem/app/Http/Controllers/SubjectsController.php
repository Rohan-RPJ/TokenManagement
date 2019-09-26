<?php

namespace App\Http\Controllers;

use App\Subjects;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;

class SubjectsController extends Controller
{
    
    public function index()
    {
        $subjects= Subjects::all();
        return response($subjects,200); 
    }

    public function show(Subjects $subject)
    {
        //dd($subject->subject_id);
        return response($subject,200);
    }
}
