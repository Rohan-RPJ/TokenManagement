<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Subjects;
use App\Submissions;
use App\Teachers;
use Carbon\Carbon;
use \Auth;

class Teachers extends Model
{

	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tName', 'tEmail', //'tBranch',
    ];

    public function user(){

    	return $this->belongsTo(User::class, $foreignKey='tEmail', $ownerKey='email');

    }

    public function submissions(){

        return $this->hasMany(Submissions::class, $foreignKey='teacher_id', $localKey='id');

    }

    public static function getAllSubmissions(){
        $submissions = Submissions::all()->toArray();
        $subject_names = [];
        $teacher_names = [];
        for ($i=0; $i < count($submissions); $i++) { 
            $subject_names[$i] = Subjects::find($submissions[$i]['subject_id'])['name'];
            $teacher_names[$i] = Teachers::find($submissions[$i]['teacher_id'])['tName'];
        }
        //dd($submissions);
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
        //dd($currentDateTime->diffInSeconds(Carbon::parse($submissions[0]['submission_date'].$submissions[0]['start_time']),false));
        //dd($date->diffInHours(Carbon::parse($submissions[9]['start_time']),false));
        for ($i=count($submissions)-1; $i >=0  ; $i--) { 
            if ($submissions[$i]['teacher_id'] !== Auth::user()->teacher['id']) {
                continue;
            }
            if ($currentDateTime->diffInSeconds(Carbon::parse($submissions[$i]['submission_date'].$submissions[$i]['start_time']),false) > 0) {
                $upcoming_submissions[$up] = $submissions[$i];
                $upcoming_submissions[$up]['subject_name'] = $subject_names[$i];
                $upcoming_submissions[$up]['teacher_name'] = $teacher_names[$i];
                $up++;
                //dd(Carbon::parse($submissions[$i]['submission_date']));
                //dd($date->diffInDays(Carbon::parse($submissions[$i]['submission_date']),false));
            }
            else {
                if ($currentDateTime->diffInSeconds(Carbon::parse($submissions[$i]['submission_date'].$submissions[$i]['end_time']),false) > 0) {
                    $ongoing_submissions[$on] = $submissions[$i];
                    $ongoing_submissions[$on]['subject_name'] = $subject_names[$i];
                    $ongoing_submissions[$on]['teacher_name'] = $teacher_names[$i];
                    $on++;
                }
                else {
                    $finished_submissions[$fi] = $submissions[$i];        
                    $finished_submissions[$fi]['subject_name'] = $subject_names[$i];
                    $finished_submissions[$fi]['teacher_name'] = $teacher_names[$i];
                    $fi++;
                }
            }
        }
        return [$upcoming_submissions,$ongoing_submissions,$finished_submissions];
    }
}