<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;
use App\Round;
use App\Submissions;
use App\ParticipantStatus;

class ParticipantStatusController extends Controller
{
    public function __construct()
    {
        //$this->middleware('checkUserType:teacher');
    }

    public function updateStatus(Participant $participant, Round $round){

    	$ps=ParticipantStatus::where("participant_id",$participant->id)->where("round_id",$round->round_id)->first();
    	$ps_status=$ps->status;
    	$ps->update(['status'=>($ps_status+1)]);
    	return response(200);
    }

    public function getStatus(Participant $participant, Round $round){
    	$ps=ParticipantStatus::where("participant_id",$participant->id)->where("round_id",$round->round_id)->first();
    	$result=["status"=>$ps->status,"participant_id"=>$ps->participant_id,"round_id"=>$ps->round_id];
    	
    	return response($result,200);
    }

    public function create(Participant $participant, Round $round){
    	
    	if(ParticipantStatus::where("participant_id",$participant->id)->where("round_id",$round->round_id)->count()>0)
    		return response("Already exists",200);

    	$ps=ParticipantStatus::create(['participant_id'=>$participant->id,
    									'submission_id'=>$participant->submission->id,
    								'round_id'=>$round->round_id]);
    	return response($ps,200); 
    }

    public function count(Submissions $submission, Round $round, $statuscode){
    	$pss=ParticipantStatus::where("submission_id",$submission->id)->where("round_id",$round->round_id)->where("status",$statuscode)->get()->count();
    	$pss=array("count"=>$pss);
    	return response($pss,200);

    }
}
