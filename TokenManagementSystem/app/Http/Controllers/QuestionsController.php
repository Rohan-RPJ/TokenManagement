<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;

class QuestionsController extends Controller
{
    public function show(Questions $question)
    {
    	$result=array("question_description"=>$question->question_description,
    	    			 "option1"=>$question->option1	,
    	    			 "option2"=>$question->option2,
    	    			 "option3"=>$question->option3,
    	    			 "option4"=>$question->option4,);
    	return response($result,200);
    }

    
}
