<?php

namespace App\Listeners;

use App\Events\NewParticipantJoined;
use App\Events\NewRoundNeeded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Participant;
use App\Subjects;
use App\Round;
use App\Submissions;

class JoinRound
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewParticipantJoined  $event
     * @return void
     */
    public function handle(NewParticipantJoined $event)
    {
        $participant = $event->participant;
        $submission = $participant->submission;
        $rounds = $submission->rounds;
        
        $max_participants =5;
        $nrn=1; //checks if newRound is needed

        if($rounds == null){
            //call the event to create new round
            event (new NewRoundNeeded($submission));
        }
        //new round will be created/ or exists
        $rounds= $submission->rounds;
        $rounds= $rounds->groupBy('round_id')->toArray();

        foreach ($rounds as $round_id => $round) {
            if(count($round)<$max_participants){

                $emptyRound=Round::where('round_id',$round_id)->where('participant_id',null)->first();
                
                if($emptyRound==null){
                    $tempRound=Round::where('round_id',$round_id)->first();//to get the questions
                    Round::create(['q1'=>$tempRound->q1,
                                   'q2'=>$tempRound->q2,
                                   'q3'=>$tempRound->q3,
                                   'participant_id'=>$participant->id,
                                   'round_id'=>$round_id,
                                   'created_at'=>now(),
                                   'updated_at'=>now(),
                                   'submission_id'=>$tempRound->submission_id,
                    ]);
                }
                else{
                     $update=Round::where('round_id',1)->where('participant_id',null)->first()->update(['participant_id'=>$participant->id,'updated_at'=>now()]);

                     if($update){print 'Updated successfully';}
                     else{print 'error occurred';}
                }

                $nrn=0;
                break;
            }
        }

        if($nrn!=0){
         event (new NewRoundNeeded($submission));   
        }
        //check for no of participants
        

    }
}
