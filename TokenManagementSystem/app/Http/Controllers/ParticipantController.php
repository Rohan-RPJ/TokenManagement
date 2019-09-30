<?php

namespace App\Http\Controllers;

use App\Participant;
use App\Submissions;
use App\Students;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Events\NewParticipantJoined;

class ParticipantController extends Controller
{
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
    {dd($request);
        //check if participant exists
        $participant = null;
        $student_id=$request->user()->student->id;
        $participant = Participant::where('submission_id',$request->submission_id)->get()->where('student_id',$student_id)->first();
        
        if($participant==null){
        $participant = Participant::create([
                            'student_id'=>$student_id,
                            'submission_id'=>$request->submission_id,
                            'correct'=>0,
                            'wrong'=>0,
                            'score'=>0,
                        ]);
        //dd($participant);
        $message="Created a participant with ".$participant->id;
        event (new NewParticipantJoined($participant));
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
         $message="Already a participant for ".$participant->submission->subject->name.' in Round '.$round->round_id ;
        }


        return back()->with('success',$message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request)
    {
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
