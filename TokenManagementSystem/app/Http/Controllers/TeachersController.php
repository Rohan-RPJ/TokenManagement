<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subjects;
use App\Questions;
use \Auth;

class TeachersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function submissions()
    {
        return view('teacher/submissions');
    }


    public function createSubmissions()
    {
        if (Auth::user()->type === "Teacher") {
        $subjects = Subjects::all()->toArray();
        $branches = Subjects::select('branch')->groupBy('branch')->get()->toArray();
        $years = Subjects::select('year')->groupBy('year')->get()->toArray();
        //dd($years);
            return view('teacher/createSubmissions',compact('subjects','years','branches'));   
        }
        return view('welcome')->with('subjects',Subjects::all());
    }

    public function storeQuestions(Request $request)
    {
        //dd($request->all());
        // get subject id
        $subject_id = Subjects::getSubjectId($request['subject'],  $request['year'], $request['branch']);
        //dd($request['question'.strval(1)]);
        //store questions in db
        for ($i=1; $i <= $request['total']; $i++) { 
            Questions::create([
                'subject_id' => $subject_id,
                'question_description' => $request['question'.strval($i)],
                'option1' => $request['q'.strval($i).'option1'],
                'option2' => $request['q'.strval($i).'option2'],
                'option3' => $request['q'.strval($i).'option3'],
                'option4' => $request['q'.strval($i).'option4'],
                'correct_option' => (int)$request['q'.strval($i).'correctOption'],
                'count' => 0,
            ]);
        }

        return redirect()->route('teacher.submissions');
    }
}
