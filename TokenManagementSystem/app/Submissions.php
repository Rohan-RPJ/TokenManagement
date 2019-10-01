<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Subjects;
use App\Teachers;
use \Auth;

class Submissions extends Model
{
    protected $fillable = [
        'subject_id', 'teacher_id', 'year', 'branch', 'type', 'submission_date', 'start_time', 'end_time', 'venue', 'status' ,
    ];

    public function subject(){

    	return $this->belongsTo(Subjects::class, $foreignKey='subject_id', $ownerKey='id');

    }

    public function teacher(){

    	return $this->belongsTo(Teachers::class, $foreignKey='teacher_id', $ownerKey='id');

    }

    public function rounds(){
        return $this->hasMany('\App\Round',$foreignKey='submission_id');
    }

    private static function segregateSubmissions($required_submissions) {
        //dd($subject_names);
        //upcoming submissions
        $up=0;
        $upcoming_submissions = [];
        //ongoing submissions
        $on=0;
        $ongoing_submissions = [];
        //Finished submissions
        $fi=0;
        $finished_submissions = [];
        //todays date
        $currentDateTime = new Carbon;
        //dd($date);
        //dd($currentDateTime->diffInSeconds(Carbon::parse($submissions[0]['submission_date'].$submissions[0]['start_time']),false));
        //dd($date->diffInHours(Carbon::parse($submissions[9]['start_time']),false));

        for ($i=count($required_submissions)-1; $i >=0  ; $i--) { 
            
            if ($currentDateTime->diffInSeconds(Carbon::parse($required_submissions[$i]['submission_date'].$required_submissions[$i]['start_time']),false) > 0) {
                $upcoming_submissions[$up++] = $required_submissions[$i];
                //dd(Carbon::parse($submissions[$i]['submission_date']));
                //dd($date->diffInDays(Carbon::parse($submissions[$i]['submission_date']),false));
            }
            else {
                if ($currentDateTime->diffInSeconds(Carbon::parse($required_submissions[$i]['submission_date'].$required_submissions[$i]['end_time']),false) > 0) {
                    $ongoing_submissions[$on] = $required_submissions[$i];
                    if ($ongoing_submissions[$on]['status'] == null) {
                        $ongoing_submissions[$on]['status'] = 1;
                    }
                    
                    $on++;
                }
                else {
                    $finished_submissions[$fi++] = $required_submissions[$i];        
                }
            }
        }
        return [$upcoming_submissions,$ongoing_submissions,$finished_submissions];
    }

    public static function getTeacherSubmissions(){

        $user = Auth::user();
        $submissions = Submissions::all()->toArray();
        $required_submissions = [];
        $rs = 0;

        for ($i=0; $i < count($submissions); $i++) { 
            if ($submissions[$i]['teacher_id'] !== $user->teacher['id']) {
                continue;
            }    
            $required_submissions[$rs] = $submissions[$i];
            $required_submissions[$rs]['subject_name'] = Subjects::find($submissions[$i]['subject_id'])['name'];
            $required_submissions[$rs]['teacher_name'] =Teachers::find($submissions[$i]['teacher_id'])['tName'];
            $rs++;
        }

        //dd($submissions);
        //dd($subject_names);
        //dd($teacher_names);
        
        return self::segregateSubmissions($required_submissions);
    }

    public static function getStudentSubmissions(){

        $user = Auth::user();
        $submissions = Submissions::all()->toArray();
        $required_submissions = [];
        $rs = 0;
        $year = Auth::user()->student['sYear'];
        $branch = Auth::user()->student['sBranch'];

        for ($i=0; $i < count($submissions); $i++) { 
            if (Subjects::find($submissions[$i]['subject_id'])['year'] === $year && Subjects::find($submissions[$i]['subject_id'])['branch'] === $branch) {
                $required_submissions[$rs] = $submissions[$i];
                $required_submissions[$rs]['subject_name'] = Subjects::find($submissions[$i]['subject_id'])['name'];
                $required_submissions[$rs]['teacher_name'] =Teachers::find($submissions[$i]['teacher_id'])['tName'];
                $rs++;
            }
        }   
        return self::segregateSubmissions($required_submissions);
    }
 //    public function getRouteKeyName()
	// {
 //    				return 'submission_id';
	// }
}
