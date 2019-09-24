@extends('layouts.main')

@section('content')
<script type="text/javascript">
  var upcoming_submissions = {!! json_encode($upcoming_submissions, JSON_HEX_TAG) !!};
  var ongoing_submissions = {!! json_encode($ongoing_submissions, JSON_HEX_TAG) !!};
  var finished_submissions = {!! json_encode($finished_submissions, JSON_HEX_TAG) !!};
  console.log(upcoming_submissions);
  function gettime() {

  // Set the date we're counting down to
  var countDownDate = new Date(upcoming_submissions[1]['submission_date']+" "+upcoming_submissions[1]['start_time']).getTime();
  var x;
  var now,distance;
  var days,hours,minutes,seconds;
  console.log("countDownDate");
  // Update the count down every 1 second
  x = setInterval(function() {

    // Get today's date and time
    now = new Date().getTime();

    // Find the distance between now and the count down date
    distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    days = Math.floor(distance / (1000 * 60 * 60 * 24));
    hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    if (document.getElementById("set-et")) {
      for (var i = 0; i < 6; i++) {
        document.getElementById("set-st"+i.toString()).innerHTML = days + "d " +hours + "h "
        + minutes + "m " + seconds + "s "; 
      }
      // If the count down is over, write some text
      /*if (distance < 0) {
        clearInterval(x);
        document.getElementById("set-et").innerHTML = "EXPIRED";
      }*/
    }
  }, 1000);
  return false;
}  
</script>

<div class="submissions">
  <div class="e-inner-elements">
    <div class="db"> 
      <h1> Dashboard </h1> 
    </div>
    <div class="" style=" text-align:center " > 
      <h1>Upcoming Submissions</h1>
    </div>
    {{-- <div class="" style=" text-align: center " > 
      <button type="button"  class="create-events" name="button" onclick="showUser()"> Create Submission</button> 
    </div> --}}
    <div class="on-events">
      @for($up=0; $up < count($finished_submissions); $up++)
      <div class="card" >
        <div class="card-body">
            <h4 class="card-title">
              <span id="set-sub" >
                {{ $finished_submissions[$up]['subject_name'] }}
              </span>
            </h4>
            <p class="card-text">
              Started at: <span id="set-st{{ $up }}">{{-- $upcoming_submissions[$up]['start_time'] --}}</span>
            </p>
          <p class="card-text">
            Ends in:  <span id="set-et"></span>{{-- $upcoming_submissions[$up]['end_time'] --}}
          </p>
          <p class="card-text">Queue status: <span class="queue" ></span> </p>
        </div>
      </div>
      @endfor
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