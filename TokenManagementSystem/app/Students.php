<?php

namespace App
;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Subjects;
use App\Submissions;
use Carbon\Carbon;
use \Auth;

class Students extends Model
{

	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sName', 'sEmail', 'sYear', 'sBranch', 'sRollNo',
    ];

    public function user(){

    	return $this->belongsTo(User::class, $foreignKey='sEmail', $ownerKey='email');

    }

    public static function getAllSubmissions(){
        //dd(Auth::user()->student['sBranch']);
        //dd(Subjects::find(38)['branch']);
        //dd(Submissions::all()->toArray());
        $submissions = Submissions::all()->toArray();
        $subject_names = [];
        $year = Auth::user()->student['sYear'];
        $branch = Auth::user()->student['sBranch'];
        $id = 0;
        for ($i=0; $i < count($submissions); $i++) { 
            if (Subjects::find($submissions[$i]['subject_id'])['year'] === $year && Subjects::find($submissions[$i]['subject_id'])['branch'] === $branch) {
                $subject_names[$id++] = Subjects::find($submissions[$i]['subject_id'])['name'];
            }
        }
        //dd($subject_names);
        //dd($subject_names);
        //dd($teacher_names);

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
        //dd($currentDateTime->diffInSeconds(Carbon::parse("2019-10-24 20:10:00"),false));
        //dd($date->diffInHours(Carbon::parse($submissions[9]['start_time']),false));
        for ($i=count($subject_names)-1; $i >=0  ; $i--) { 
            if ($currentDateTime->diffInSeconds(Carbon::parse($submissions[$i]['submission_date'].$submissions[$i]['start_time']),false) > 0) {
                $upcoming_submissions[$up] = $submissions[$i];
                $upcoming_submissions[$up]['subject_name'] = $subject_names[$i];
                //$upcoming_submissions[$up]['teacher_name'] = $teacher_names[$i];
                $up++;
                //dd(Carbon::parse($submissions[$i]['submission_date']));
                //dd($date->diffInDays(Carbon::parse($submissions[$i]['submission_date']),false));
            }
            else {
                if ($currentDateTime->diffInSeconds(Carbon::parse($submissions[$i]['submission_date'].$submissions[$i]['end_time']),false) > 0) {
                    $ongoing_submissions[$on] = $submissions[$i];
                    $ongoing_submissions[$on]['subject_name'] = $subject_names[$i];
                    //$ongoing_submissions[$on]['teacher_name'] = $teacher_names[$i];
                    $on++;
                }
                else {
                    $finished_submissions[$fi] = $submissions[$i];        
                    $finished_submissions[$fi]['subject_name'] = $subject_names[$i];
                    //$finished_submissions[$fi]['teacher_name'] = $teacher_names[$i];
                    $fi++;
                }
            }
        }
        return [$upcoming_submissions, $ongoing_submissions, $finished_submissions];
    }
}
