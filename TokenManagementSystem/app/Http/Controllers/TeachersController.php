<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subjects;
use App\Questions;
use App\Submissions;
use App\Teachers;
use \Auth;
use App\Events\QuestionsStored;
use Carbon\Carbon;

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
        $date = new Carbon;
        //dd(Carbon::parse($submissions[1]['end_time']));
        //dd($date->diffInSeconds(Carbon::parse("2019-09-24"),false));
        //dd($date->diffInMinutes(Carbon::parse($submissions[3]['start_time']),false));
        for ($i=count($submissions)-1; $i >=0  ; $i--) {
            if ($date->diffInDays(Carbon::parse($submissions[$i]['submission_date']),false) < 0) {
                if ($date->diffInSeconds(Carbon::parse($submissions[$i]['submission_date']),false) < 0) {
                    $finished_submissions[$fi] = $submissions[$i];
                    $finished_submissions[$fi]['subject_name'] = $subject_names[$i];
                    $finished_submissions[$fi]['teacher_name'] = $teacher_names[$i];
                    $fi++;
                }
                //dd(Carbon::parse($submissions[$i]['submission_date']));
                //dd($date->diffInDays(Carbon::parse($submissions[$i]['submission_date']),false));
            }
            else {
                if ($date->diffInDays(Carbon::parse($submissions[$i]['submission_date']),false) === 0) {
                    if ($date->diffInHours(Carbon::parse($submissions[$i]['start_time']),false) > 0) {
                        $upcoming_submissions[$up] = $submissions[$i];
                        $upcoming_submissions[$up]['subject_name'] = $subject_names[$i];
                        $upcoming_submissions[$up]['teacher_name'] = $teacher_names[$i];
                        $up++;
                    }
                    elseif ($date->diffInHours(Carbon::parse($submissions[$i]['end_time']),false) > 0) {
                        if ($date->diffInMinutes(Carbon::parse($submissions[$i]['start_time']),false) > 0) {
                            $upcoming_submissions[$up] = $submissions[$i];
                            $upcoming_submissions[$up]['subject_name'] = $subject_names[$i];
                            $upcoming_submissions[$up]['teacher_name'] = $teacher_names[$i];
                            $up++;
                        }
                        else {
                            $ongoing_submissions[$on] = $submissions[$i];
                            $ongoing_submissions[$on]['subject_name'] = $subject_names[$i];
                            $ongoing_submissions[$on]['teacher_name'] = $teacher_names[$i];
                            $on++;
                        }
                    }
                    elseif ($date->diffInMinutes(Carbon::parse($submissions[$i]['end_time']),false) > 0) {
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
                else {
                    $upcoming_submissions[$up] = $submissions[$i];
                    $upcoming_submissions[$up]['subject_name'] = $subject_names[$i];
                    $upcoming_submissions[$up]['teacher_name'] = $teacher_names[$i];
                    $up++;
                }
            }
        }
        //dd($upcoming_submissions);
        //dd($ongoing_submissions);
        //dd($finished_submissions);

        return view('teacher/submissions', compact('upcoming_submissions', 'ongoing_submissions', 'finished_submissions'));
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
        //dd($request);
        //dd(date("H:i:s",strtotime($request['start_time'])));
        // get subject id
        $subject_id = Subjects::getSubjectId($request['subject'],  $request['year'], $request['branch']);
        $teacher_id = Auth::user()->id;
        //dd($teacher_id);
        //dd($subject_id);
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

        $request['subject_id'] = $subject_id;
        $request['teacher_id'] = $teacher_id;
        event(new QuestionsStored($request));

        return redirect()->route('teacher.submissions');
        submissions();
    }
}
