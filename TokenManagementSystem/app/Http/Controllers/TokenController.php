<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Participant;
use App\Submissions;
use App\Round;
use App\Students;
use App\Token;

class TokenController extends Controller
{
		
		//for FCFS submissions
		public function createFCFS(Students $student , Submissions $submission) {
			
			//check if applied before
			//dd($student,$submission);
			$existingToken= Token::where("student_id",$student->id)
                                ->where("submission_id",$submission->id)
                                ->first();
             
             if($existingToken!=null){
             		$msg="Token $existingToken->value has already been assigned for {$submission->subject->name}";
             		return back()->with('warning',$msg);
             }


			$value= Token::where("submission_id",$submission->id)->max("value") ? (Token::where("submission_id",$submission->id)->max("value")+1) : 1;
			//dd($student,$submission);
			$token=Token::create(['student_id'=>$student->id,
							'submission_id'=>$submission->id,
							'value'=>$value,
				]);

			return redirect()->route('student.notifications')->with("success","Token #$token->value Assigned for {$submission->subject->name}");


		}

		public function getTokenForSubmissionRound(Participant $participant, Round $round){
			//dd($participant->student->id,$round);
			$existingToken= Token::where("student_id",$participant->student->id)
                                ->where("submission_id",$participant->submission->id)
                                ->where("round_id",$round->round_id)
                                ->first();
           $result=["result"=>true,"token"=>$existingToken];
           if($existingToken==null){
           		$result['result']=false;
           }
           return response($result,200);
            
		}

		public function redirectToNotification(Participant $participant, Round $round)
		{
			$token= Token::where("student_id",$participant->student->id)
                                ->where("submission_id",$participant->submission->id)
                                ->where("round_id",$round->round_id)
                                ->first();

        //dd("Token",$token);
        $message="";
        $msgsts="success";

        if($token->value<0){
            $msgsts="info";
            $message="No token was allocated. Try in next round!";
        }
        else{
            $msgsts="success";
            $message="Token #{$token->value} has been allocated";
        }
        return redirect()->route('student.notifications')->with($msgsts,$message);
		}

}
