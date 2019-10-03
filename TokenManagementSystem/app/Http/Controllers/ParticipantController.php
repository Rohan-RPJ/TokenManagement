<?php

namespace App\Http\Controllers;

use App\Participant;
use App\Submissions;
use App\Students;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Events\NewParticipantJoined;
use App\Events\TestEvent;
use App\Token;

class ParticipantController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('checkUserType:teacher');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Submissions $submission)
    {
        $participants = Participant::where('submission_id',$submission->submission_id)->get();
        return response($participants ,200);
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
    {//dd($request);
        //check if participant exists
        //event(new TestEvent('YO wassup'));
        $messageStatus="success";
        
        $participant = null;
        $student_id=$request->user()->student->id;
        $participant = Participant::where('submission_id',$request->submission_id)->get()->where('student_id',$student_id)->first();
        
        $latestExistingToken = Token::where("student_id",$student_id)
                                ->where("submission_id",$request->submission_id)
                                ->latest("round_id")
                                ->first();

        if($participant==null and $latestExistingToken==null ){
        $participant = Participant::create([
                            'student_id'=>$student_id,
                            'submission_id'=>$request->submission_id,
                            'correct'=>0,
                            'wrong'=>0,
                            'score'=>0,
                        ]);
        //dd($participant);
       // dd($message);
        $message="Created a participant with ".$participant->id;
        event (new NewParticipantJoined($participant));
        }
        else if(!($latestExistingToken==null or $latestExistingToken->value<0))
        {
            $message="Token $latestExistingToken->value has already been assigned";
            $messageStatus="warning";
        }
        else
        {
            //check if round has been assigned
            $round=$participant->submission->rounds->where('participant_id',$participant->id)->first();

            if( $round==null){
                event (new NewParticipantJoined($participant));
                $round=$participant->submission->rounds->where('participant_id',$participant->id)->first();//re get the round id
                dd('Conditional inside',$round);
            }
         //check if the round is over or not
         $message="Already a participant for ".$participant->submission->subject->name.' in Round '.$round->round_id ;
         $messageStatus="info";
         return redirect()->route('round.start', ['submission' => $request->submission_id, 'round_id'=>$round->round_id]);
         //dd($message);
        }



        return back()->with($messageStatus,$message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request)
    {
       // event(new TestEvent('YO wassup'));
        $branch=$request->user()->student->sBranch;
        $year=$request->user()->student->sYear;
        $submissions= Submissions::where('year',$year)->get();

        return view('participant.join',compact('submissions','request'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        //
    }
}
