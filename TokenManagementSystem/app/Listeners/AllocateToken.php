<?php

namespace App\Listeners;

use App\Events\RoundCompletedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Round;
use App\Token;
use App\Participant;
use App\Submissions;
use Illuminate\Support\Facades\DB;

class AllocateToken
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
     * @param  RoundCompletedEvent  $event
     * @return void
     */
    public function handle(RoundCompletedEvent $event)
    {
        //dd($event->round_id,$event->submission);
        $round_id=$event->round_id;
        
        $submission=$event->submission;

        $student_id=$event->participant->student_id;
        
        //dd($round_id,$submission,$student_id);

        $checkToken= Token::where('submission_id',$submission->id)
                            ->where('student_id',$student_id)
                            ->where('round_id',$round_id->round_id)
                            ->exists();
        if($checkToken)
            {
                dd("Print here",$checkToken,"TOken exists so returning for event handler");

                return false;

            } //prevents the event from rehandling
        else{
        $round_participants_id= Round::where("round_id",$round_id->round_id)
                                    ->where("submission_id",$round_id->submission_id)
                                    ->pluck("participant_id")->toArray();
        
        $participants=Participant::find($round_participants_id)
                                    ->sortBy("wrong")
                                    ->sortByDesc("correct")
                                    ->sortByDesc("score")
                                    ->values();


        $winners= $participants->splice(0,3)->values(); //removing the first three winners from participants and getting there ids
        //dd($winners);
        $winners->each( function($winner,$key){
            //global $submission;
            //$participant=     
             $lastTokenValue= Token::where('submission_id',$winner->submission_id)->orderBy("value","desc")->first();
             if($lastTokenValue!=null) 
                $lastTokenValue=$lastTokenValue->value;
             else 
                $lastTokenValue=0;
             //dd($lastTokenValue);
            
            $round = Round::where("participant_id",$winner->id)->get("round_id")->first();
            Token::create(['submission_id'=>$winner->submission_id,
                            'student_id'=>$winner->student_id,
                            'round_id'=>$round->round_id,
                            'value'=>($lastTokenValue+1),
                            ]);
        });

        //giving the losers token of values -1
        $participants->each(function($loser,$key){
             //$lastTokenValue= Token::where('submission_id',$loser->submission_id)->orderBy("value","desc")->first()->value;
            $round = Round::where("participant_id",$loser->id)->get("round_id")->first();
            Token::create(['submission_id'=>$loser->submission_id,
                            'student_id'=>$loser->student_id,
                            'round_id'=>$round->round_id,
                            'value'=>-1,
                            ]);
        });

      }
    }
}
