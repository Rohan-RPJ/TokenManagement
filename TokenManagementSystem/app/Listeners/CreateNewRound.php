<?php

namespace App\Listeners;

use App\Events\NewRoundNeeded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Questions;
use App\Subjects;
use App\Participant;
use App\Submissions;
use App\Round;

class CreateNewRound
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
     * @param  NewRoundNeeded  $event
     * @return void
     */
    public function handle(NewRoundNeeded $event)
    {
        //dd($event->submission);
        $submission= $event->submission;
        $new_round_id = 1; //default to 1
        //get latest round id
        $rounds = $submission->rounds->groupBy('round_id')->toArray();
        
        
        if($rounds!=null)
        {
            $round_ids= array_keys($rounds);
            $latest_round_id= array_pop($round_ids);
            $new_round_id = $latest_round_id+1;
        }

        //initialise questions
        $question_set = Questions::where('subject_id',$submission->subject_id)->get() //get all the questions of the subject_id
                        ->sortBy('count') //sort by count ascending
                        ->slice(0,3); //slice the first three questions
        $question_ids= $question_set->pluck('id')->all(); //Array containing ids of the questions

        //create round
        Round::create(
                    [ 'round_id'=>$new_round_id,
                       'q1'=> $question_ids[0],
                       'q2'=>$question_ids[1],
                       'q3'=>$question_ids[2],
                       'submission_id'=>$submission->id,
                       'participant_id'=>$event->participant->id,
                       'created_at'=>now(),
                       'updated_at'=>now(),

                    ]
        );

        //update question count
        $question_set->each(function($question,$key){
            $qcount=$question->count;
            $qcount+=1;
            $question->update(['count'=>$qcount]);
        });
        //dd($question_set->all());
    }
}
