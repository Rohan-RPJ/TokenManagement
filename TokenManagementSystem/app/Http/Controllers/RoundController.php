<?php

namespace App\Http\Controllers;

use App\Round;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Submissions;

class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('round/startround');
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
