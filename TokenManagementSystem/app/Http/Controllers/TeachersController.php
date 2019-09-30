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

    private function createTime($date)
    {
        $date = Carbon::parse($date)->format('H:i:s');
        return $date;
    }

    private function createDate($date)
    {
        $date = Carbon::parse($date)->format('Y-m-d');
        return $date;
    }

    public function profile()
    {
      return view('teacher/profile');
    }

    public function submissions()
    {
        $segregatedSubmissions = Submissions::getTeacherSubmissions();
        //dd($segregatedSubmissions);
        $upcoming_submissions = $segregatedSubmissions[0];
        $ongoing_submissions = $segregatedSubmissions[1];
        $finished_submissions = $segregatedSubmissions[2];
        /*dd($upcoming_submissions);
        dd($ongoing_submissions);
        dd($finished_submissions);*/

        return view('teacher/submissions', compact('upcoming_submissions', 'ongoing_submissions', 'finished_submissions'));
    }


    public function createSubmissions()
    {
        if (Auth::user()->type === "Teacher") {
        $subjects = Subjects::getTeacherSubjects();
        $branches = Subjects::select('branch')->groupBy('branch')->get()->toArray();
        $years = Subjects::select('year')->groupBy('year')->get()->toArray();
        //dd($years);
            return view('teacher/createSubmissions',compact('subjects','years','branches'));
        }
        return view('welcome')->with('subjects',Subjects::all());
    }

    public function storeSubmission(Request $request)
    {
        //dd(Auth::user()->teacher['id']);
        //dd($request);
        //dd(date("H:i:s",strtotime($request['start_time'])));
        // get subject id
        $subject_id = Subjects::getSubjectId($request['subject'],  $request['year'], $request['branch']);
        $teacher_id = Auth::user()->teacher['id'];
        $request['subject_id'] = $subject_id;
        $request['teacher_id'] = $teacher_id;
        //dd($teacher_id);
        //dd($subject_id);
        //store questions in db
        if ($request['type'] === 'quiz') {
            //store questions
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
        }

        Submissions::create([
            'subject_id' => $request['subject_id'],
            'teacher_id' => $request['teacher_id'],
            'year' => $request['year'],
            'branch' => $request['branch'],
            'type' => $request['type'],
            'submission_date' => $this->createDate($request['submission_date']),
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],
            'venue' => $request['venue'],
        ]);

        return redirect()->route('teacher.submissions');
        //submissions();
    }

    public function updateSubmission(Request $request){
        //todays date
        $currentDateTime = new Carbon;
        //dd(self::createTime($currentDateTime->subMinutes(1)));
        //dd($request);
        $submission = Submissions::findOrFail($request['submission_id']);
        //dd($submission);
        //Make sure you have got the page model
        if ($submission) {
            $submission->status = (int)$request['new_status'];
            $submission->venue = $request['new_venue'];

            if ($request['new_status'] == 0) {
                $submission->end_time = self::createTime($currentDateTime->subMinutes(1));

                if ($currentDateTime->diffInSeconds(Carbon::parse($submission['submission_date'].$request['new_start_time']),false) > 0) {
                    $submission->start_time = self::createTime($currentDateTime->subMinutes(1));
                }
                else{
                    $submission->start_time = $request['new_start_time'];
                }
            }
            else{
                $submission->start_time = $request['new_start_time'];
                $submission->end_time = $request['new_end_time'];
                if ($currentDateTime->diffInSeconds(Carbon::parse($submission['submission_date'].$request['new_end_time']),false) < 0) {
                    $submission->status = 0;
                    $submission->end_time = self::createTime($currentDateTime->subMinutes(1));
                    if ($currentDateTime->diffInSeconds(Carbon::parse($submission['submission_date'].$request['new_start_time']),false) > 0) {
                        $submission->start_time = self::createTime($currentDateTime->subMinutes(1));
                    }
                    else{
                        $submission->start_time = $request['new_start_time'];
                    }
                }
            }

            $submission->save();
        }
        return redirect()->route('teacher.submissions');
    }

    public function removeSubmission(Request $request) {
        //dd($request);
        $submission = Submissions::findOrFail($request['submission_id']);
        //dd($submission);
        //Make sure you have got the page model
        if ($submission) {
            $submission->delete();
        }
        return redirect()->route('teacher.submissions');
    }
}
