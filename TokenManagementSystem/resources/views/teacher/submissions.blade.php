@extends('layouts.main')

@section('content')

<div class="submissions">
  <div class="e-inner-elements">
    <div class="db"> 
      <h1> Dashboard </h1> 
    </div>
    <div class="" style=" text-align:center " > 
      <h1>Ongoing Events</h1>
    </div>
    <div class="" style=" text-align: center " > 
      <button type="button"  class="create-events" name="button" onclick="showUser()"> Create Submission</button>
    </div>
    <div class="on-events">
      <div class="card" >
        <div class="card-body">
          <h4 class="card-title"><span id="set-sub" >Operating System</span></h4>
          <p class="card-text">Started at: <span id="set-st"></span>  </p>
          <p class="card-text">Ends in:  <span id="set-et"></span>  </p>
          <p class="card-text">Queue status: <span class="queue" ></span> </p>
        </div>
      </div>
    </div>
    <br>
    <div class=""style=" text-align:center " >  <h1>Upcoming Events</h1>   </div>
    <div class="up-events">
      <div class="upevent-row">
        <span>Digital Logic</span>
      </div>
    </div>
  </div>
</div>

@endsection