@extends('layouts.main')

@section('content')

<script src="{{ asset('js/student/submissions.js') }}"></script>
<script type="text/javascript">
  var upcoming_submissions = {!! json_encode($upcoming_submissions, JSON_HEX_TAG) !!};
  var ongoing_submissions = {!! json_encode($ongoing_submissions, JSON_HEX_TAG) !!};
  var finished_submissions = {!! json_encode($finished_submissions, JSON_HEX_TAG) !!};
  //console.log(upcoming_submissions);
</script>

<div class="submissions">
  <div class="e-inner-elements">
    <div class="db"> <h1> Dashboard </h1> </div>
    <div class="animation-area">
      <ul class="circle-area">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    <div class="" style=" text-align:center " >  <h1>Ongoing Submissions</h1>   </div>
    <div class="on-events">
      <div class="card" >
        <div class="card-body">
          <h4 class="card-title"><span id="set-sub">Operating System</span></h4>
          <p class="card-text">Started at: <span id="set-st"></span>  </p>
          <p class="card-text">Ends in:  <span id="set-et"></span>  </p>
          <p class="card-text">Queue status: </p>
          <a href="#" class="card-btn">Join</a>
        </div>
      </div>
    </div>
    <br>
    <div class=""style=" text-align:center " >  <h1>Upcoming Submissions</h1>   </div>
    <div class="up-events">
      <div class="upevent-row">
        <span>Digital Logic</span>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  /*getUpcomingtime();
  getOngoingtime();*/
</script>
@endsection
