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

    public function profile()
    {
      return view('student/profile');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function submissions()
    {
        $segregatedSubmissions = Submissions::getStudentSubmissions();
        //dd($segregatedSubmissions);
        $upcoming_submissions = $segregatedSubmissions[0];
        $ongoing_submissions = $segregatedSubmissions[1];
        $finished_submissions = $segregatedSubmissions[2];

        //dd($upcoming_submissions);
        //dd($ongoing_submissions);
        //dd($finished_submissions);

        return view('student/submissions', compact('upcoming_submissions', 'ongoing_submissions', 'finished_submissions'));
    }
}
