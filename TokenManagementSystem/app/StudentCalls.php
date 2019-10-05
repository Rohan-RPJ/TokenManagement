<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Auth;
use App\Submissions;
use App\Subjects;
use App\Teachers;

class StudentCalls extends Model
{
    protected $fillable = [
        'submission_id', 'student_id',
    ];

    public static function updateToIsRead(){
    	$student_id = Auth::user()->student->id;
    	$notifications = StudentCalls::where('student_id',$student_id)->where('isRead',0)->get();
    	//dd($notifications,count($notifications));
    	foreach ($notifications as $notification) {
    		$notification = $notification;
    		//dd($notification);
    		$notification->isRead = 1;
    		$notification->save();	
    	}
    }

    public static function getUnReadNotifCount(){
    	$student_id = Auth::user()->student->id;
    	$unReadNotifications = StudentCalls::where('student_id',$student_id)->where('isRead',0)->get();
    	//dd(count($unReadNotifications));
    	return count($unReadNotifications);
    }

    public static function getNotifWithSubmissions(){
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
        return [$notifications,$submissions];
    }

    public static function getUnreadNotifWithSubmissions(){
        $student_id = Auth::user()->student['id'];
        $unread_notifications = StudentCalls::where('student_id',$student_id)->where('isRead',0)->get();
        $notifications = [];
        $n=0;

        $submissions = [];
        //dd($student_id);
        for ($i=0; $i < count($unread_notifications); $i++) {
            if ($unread_notifications[$i]['student_id'] == $student_id) {
                $notifications[$n] = $unread_notifications[$i];
                $submissions[$n] = Submissions::find($unread_notifications[$i]['submission_id']);
                $submissions[$n]['subject_name'] = Subjects::find($submissions[$n]['subject_id'])['name'];
                $submissions[$n]['teacher_name'] = Teachers::find($submissions[$n]['teacher_id'])['tName'];
                $n++;
            }
        }
        return [$notifications,$submissions];
    }
}
