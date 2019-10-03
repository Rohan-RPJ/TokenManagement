<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Subjects;
use App\Submissions;
use App\Students;
use App\Teachers;
use App\StudentCalls;
use App\Token;
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
        $this->middleware('checkUserType:student');
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

    public function showNotifications(){
        $all_notifications = StudentCalls::all()->toArray();
        $notifications = [];
        $n=0;
        $student_id = Auth::user()->student['id'];

        $submissions = [];
        //dd($student_id);
        for ($i=0; $i < count($all_notifications); $i++) {
            if ($all_notifications[$i]['student_id'] == $student_id) {
                $notifications[$n] = $all_notifications[$i];
                $submissions[$n] = Submissions::find($all_notifications[$i]['submission_id']);
                $submissions[$n]['subject_name'] = Subjects::find($submissions[$n]['subject_id'])['name'];
                $submissions[$n]['teacher_name'] = Teachers::find($submissions[$n]['teacher_id'])['tName'];
                $n++;
            }
        }

        //fetching if there are any positive tokens
        $tokens = Token::where("student_id",$student_id)->where("value",">",0)->get();
        $tokenCount=$tokens->count();
        if($tokenCount==0){
            $tokens=[];
        }
        return view('student/notifications', compact('notifications', 'submissions','tokens'));
    }

    public function profile()
    {
      $student_id = Auth::user()->student['id'];
      $student=Students::find($student_id);
      return view('student/profile',compact('student'));
    }
}
