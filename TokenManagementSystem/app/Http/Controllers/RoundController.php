<?php

namespace App\Http\Controllers;

use App\Round;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Submissions;
use App\Participant;
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
        return view('round/startround',compact('submission','round_id'));
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
}
