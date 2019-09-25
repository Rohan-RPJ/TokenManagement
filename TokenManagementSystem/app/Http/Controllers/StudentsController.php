<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Subjects;
use App\Submissions;
use App\Students;
use \Auth;

class StudentsController extends Controller
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
        $allSubmissions = Students::getAllSubmissions();
        //dd($allSubmissions);
        $upcoming_submissions = $allSubmissions[0];
        $ongoing_submissions = $allSubmissions[1];
        $finished_submissions = $allSubmissions[2];
        
        //dd($upcoming_submissions);
        //dd($ongoing_submissions);
        //dd($finished_submissions);

        return view('student/submissions', compact('upcoming_submissions', 'ongoing_submissions', 'finished_submissions'));
    }
}
