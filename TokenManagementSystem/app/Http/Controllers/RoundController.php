<?php

namespace App\Http\Controllers;

use App\Round;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Submissions;
use App\Participant;
use App\Questions;
use App\Token;
use App\Events\RoundCompletedEvent;

class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     dd($this);
    // }

    public function index(Submissions $submission,Round $round_id,Request $request)
    {
        $student_id= $request->user()->student->id;
        //checks if user is a participant of that round
        $participant = Participant::where('student_id',$student_id)->where('submission_id',$submission->id)->firstOrFail();
        return view('round/startround',compact('submission','round_id','participant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function show(Round $round)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function edit(Round $round)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Round $round)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function destroy(Round $round)
    {
        //
    }


    public function shouldStartRound(Submissions $submission, $round_id){
        $max_participants=5;
        $submission_id=$submission->id;
        $count=Round::where('submission_id',$submission_id)->where('round_id',$round_id)->count();
        $result=['result'=>$count==$max_participants];
        return response($result,200);
    }

    public function forceFireRoundCompletedEvent(Submissions $submission, Round $round_id, Participant $participant){
        event(new RoundCompletedEvent($submission,$round_id,$participant));
    }

    public function submitAnswers(Submissions $submission, Round $round_id,Request $request ){
        //dd($request->post());
        //dd($round_id);
        $student_id=$request->user()->student->id;
        $participant = Participant::where("student_id",$student_id)->where("submission_id",$submission->id)->first();
        //dd($participant); 

        $answers=$request->post();
        $correct=0;
        $wrong=0;
        //dd($answers);
        print "No of answers is ".count($answers);

        foreach($answers as $answer_id=>$answer_value){
            $question_id= explode("_",$answer_id)[1];
            //dd($question_id);
            $question = Questions::find($question_id);
            print "Answer Received for $question_id is $answer_value";

            if($question->correct_option == $answer_value){
                $correct++;
                print "Answer is correct\n";
                $participant->update(["correct"=>$correct]);
            } 
            else
            {
                $wrong++;
                print"Answer is wrong\n";
                $participant->update(["wrong"=>$wrong]);
            }

           
        }
        $score= $participant->roundsParticipated;
        $score+= $correct*3 + $wrong*(-1);
        
        $participant->update(["score"=>$score]);
        \Log::debug("Submission:{$submission->id} Round_id:{$round_id->round_id} P_id:{$participant->id} Name:{$participant->student->sName} C:{$participant->correct} W:{$participant->wrong}");
         //dd("Total:",$request->post(),"C:",$correct,"W:",$wrong, "score",$score);
        //sleep(10);
        $response=app('App\Http\Controllers\ParticipantStatusController')->count($participant->submission,$round_id,2);
        $count=$response->original['count'];
        //dd($response,$count);
        if($count==5) //checking all 5 participants have finished
        {
            dd("Count five reachd");
            event(new RoundCompletedEvent($submission,$round_id,$participant));
        }
        
            return view('round.loading',compact('participant','submission','round_id'));
        //}

        //sleep(5);
        
        // $token=Token::where('student_id',$student_id)->where('submission_id',$submission->id)->where('round_id',$round_id->round_id)->first();
        // //dd("Token",$token);
        // $message="";
        // $msgsts="success";

        // if($token->value<0){
        //     $msgsts="info";
        //     $message="No token was allocated. Try in next round!";
        // }
        // else{
        //     $msgsts="success";
        //     $message="Token #{$token->value} has been allocated";
        // }
        // return redirect()->route('student.notifications')->with($msgsts,$message);

    }
}
