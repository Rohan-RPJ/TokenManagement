@extends('layouts.main')

@section('content')
<script src="{{ asset('js/teacher/submissions.js') }}"></script>
<script type="text/javascript">
  var upcoming_submissions = {!! json_encode($upcoming_submissions, JSON_HEX_TAG) !!};
  var ongoing_submissions = {!! json_encode($ongoing_submissions, JSON_HEX_TAG) !!};
  var finished_submissions = {!! json_encode($finished_submissions, JSON_HEX_TAG) !!};
  //console.log(upcoming_submissions);
</script>

<div id="submissions" class="submissions">
  <div class="e-inner-elements">
    <div class="db">
      <h1> Dashboard </h1>
    </div>
    <div class="" style=" text-align:center " >
      <h1>Ongoing Events</h1>
    </div>
    <div class="on-events">
      @for($up=0; $up < count($upcoming_submissions); $up++)
      <div class="card" >
        <div class="card-body">
            <h4 class="card-title">
              <span id="set-sub" >
                {{ $upcoming_submissions[$up]['subject_name'] }}
              </span>
            </h4>
            <p class="card-text">
              Starts in: <span id="starts-in{{ $up }}"></span>
            </p>
          <p class="card-text">
            Ends at:  <span id="ends-at{{ $up }}">{{ $upcoming_submissions[$up]['end_time'] }}</span>
          </p>
          <p class="card-text">Queue status: <span class="queue" ></span> </p>
        </div>
      </div>
      @endfor
    </div>
    <br>
    <div class="" style=" text-align:center " >
      <h1>Ongoing Submissions</h1>
    </div>
    <div class="on-events">
      @for($on=0; $on < count($ongoing_submissions); $on++)
      <div class="card" >
        <div class="card-body">
            <h4 class="card-title">
              <span id="set-sub" >
                {{ $ongoing_submissions[$on]['subject_name'] }}
              </span>
            </h4>
            <p class="card-text">
              Started at: <span id="started-at{{ $on }}">{{ $ongoing_submissions[$on]['start_time'] }}</span>
            </p>
          <p class="card-text">
            Ends in:  <span id="ends-in{{ $on }}"></span>
          </p>
          <p class="card-text">Queue status: <span class="queue" ></span> </p>
        </div>
      </div>
      @endfor
    </div>
    <br>
    <div class=""style=" text-align:center " >  <h1>Upcoming Events</h1>   </div>
    <div class="on-events">
      <div class="upevent-row">
        <span>Digital Logic</span>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  getUpcomingtime();
  getOngoingtime();
</script>
@endsection
