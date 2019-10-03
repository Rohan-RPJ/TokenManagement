<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Auth;

class StudentCalls extends Model
{
    protected $fillable = [
        'submission_id', 'student_id',
    ];

    public static function updateToIsRead(){
    	$student_id = Auth::user()->student->id;
    	$notifications = StudentCalls::where('student_id',$student_id)->get();
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
}
