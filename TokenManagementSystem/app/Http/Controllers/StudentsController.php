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
        $unReadNotifCount = StudentCalls::getUnReadNotifCount();
        return view('student/submissions', compact('upcoming_submissions', 'ongoing_submissions', 'finished_submissions','unReadNotifCount'));
    }

    public function showNotifications(){
        $student_id = Auth::user()->student['id'];

        $notif_with_subm = StudentCalls::getNotifWithSubmissions();
        $notifications = $notif_with_subm[0];
        $submissions = $notif_with_subm[1];
        //fetching if there are any positive tokens
        $tokens=Token::where("student_id",$student_id)->where("value",">",0)->get()->sortByDESC('created_at');
        $tokenCount=$tokens->count();
        if($tokenCount==0){
            $tokens=[];
        }

        //update all notification to isRead = 1
        StudentCalls::updateToIsRead();

        //get unread notifications count
        $unReadNotifCount = StudentCalls::getUnReadNotifCount();
        return view('student/notifications', compact('notifications', 'submissions','tokens', 'unReadNotifCount'));
    }

    public function sendAjaxNotifCount(){
        //get unread notifications count
        $unReadNotifCount = StudentCalls::getUnReadNotifCount();
        
        return response()->json(array('unReadNotifCount' => $unReadNotifCount),200);
    }

    public function sendAjaxUnreadNotif(){

        $notif_with_subm = StudentCalls::getUnreadNotifWithSubmissions();
        $notifications = $notif_with_subm[0];
        $submissions = $notif_with_subm[1];
        for ($i=0; $i < count($notifications); $i++) {
           $notifications[$i]['createdAt']=$notifications[$i]['created_at']->diffForHumans();
        }
        //dd($notifications);
        //update all notification to isRead = 1
        StudentCalls::updateToIsRead();
        //dd($notifications,$submissions);
        return response()->json(array('notifications' => $notifications, 'submissions' => $submissions),200);
    }

    public function profile()
    {
      $student_id = Auth::user()->student['id'];
      $student=Students::find($student_id);

      $unReadNotifCount = StudentCalls::getUnReadNotifCount();
      return view('student/profile',compact('student', 'unReadNotifCount'));
    }
}
