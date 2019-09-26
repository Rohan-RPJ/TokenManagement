@extends('layouts.main')

@section('content')
<script src="{{ asset('js/teacher/submissions.js') }}"></script>
<script type="text/javascript">
  var upcoming_submissions = {!! json_encode($upcoming_submissions, JSON_HEX_TAG) !!};
  var ongoing_submissions = {!! json_encode($ongoing_submissions, JSON_HEX_TAG) !!};
  var finished_submissions = {!! json_encode($finished_submissions, JSON_HEX_TAG) !!};
  //console.log(upcoming_submissions);
</script>
<style type="text/css">
  /* Font */
@import url('https://fonts.googleapis.com/css?family=Quicksand:400,700');

/* Design */
*,
*::before,
*::after {
  box-sizing: border-box;
}

body {
  /*background: linear-gradient(to bottom left, #0f0c29 40%, #302b63 100%);*/
  background-color: #242424;
}
.main{
  max-width: 1200px;
  margin: 0 auto;
}

h1 {
    font-size: 24px;
    font-weight: 400;
    text-align: center;
}

img {
  height: auto;
  max-width: 100%;
  vertical-align: middle;
}

.btn {
  color: #ffffff;
  padding: 0.8rem;
  font-size: 14px;
  text-transform: uppercase;
  border-radius: 4px;
  font-weight: 400;
  display: block;
  width: 100%;
  cursor: pointer;
  border: 1px solid rgba(255, 255, 255, 0.2);
  background: transparent;
}

.btn:hover {
  background-color: rgba(255, 255, 255, 0.12);
}

.cards {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  margin: 0;
  padding: 0;
}

.cards_item {
  display: flex;
  padding: 1rem;
}

@media (min-width: 40rem) {
  .cards_item {
    width: 50%;
  }
}

@media (min-width: 56rem) {
  .cards_item {
    width: 33.3333%;
  }
}

.card {
  background-color: white;
  border-radius: 0.25rem;
  box-shadow: 0 20px 40px -14px rgba(0, 0, 0, 0.25);
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.card_content {
  padding: 1rem;
  background: linear-gradient(to bottom left, #0f0c29 40%, #cf6679 100%);
}

.card_title {
  color: #ffffff;
  font-size: 1.1rem;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: capitalize;
  margin: 0px;
}

.card_text {
  color: #ffffff;
  font-size: 0.875rem;
  line-height: 1.5;
  margin-bottom: 1.25rem;    
  font-weight: 400;
}
.made_by{
  font-weight: 400;
  font-size: 13px;
  margin-top: 35px;
  text-align: center;
}
</style>
<div class="main">
  <h1>Ongoing Submissions</h1>
  <ul class="cards">
    @for($on=0; $on < count($ongoing_submissions); $on++)
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="https://picsum.photos/500/300/?image=10"></div>
        <div class="card_content">
          <h2 class="card_title">{{ $ongoing_submissions[$on]['subject_name'] }}</h2>
          <p class="card_text">
            Started at: 
            <span id="started-at{{ $on }}">
              {{ $ongoing_submissions[$on]['start_time'] }}
            </span>
          </p>
          <p class="card_text">
            Ends in:
            <span id="ends-in{{ $on }}"></span>
          </p>
          <p class="card_text">Queue status: <span class="queue" ></span> </p>
          <button class="btn card_btn">Read More</button>
        </div>
      </div>
    </li>
    @endfor
  </ul>
</div>
<div class="main">
  <h1>Upcoming Submissions</h1>
  <ul class="cards">
    @for($up=0; $up < count($upcoming_submissions); $up++)
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="https://picsum.photos/500/300/?image=10"></div>
        <div class="card_content">
          <h2 class="card_title">{{ $upcoming_submissions[$up]['subject_name'] }}</h2>
          <p class="card_text">
            Starts in: 
            <span id="starts-in{{ $up }}">
            </span>
          </p>
          <p class="card_text">
            Ends at:
            <span id="ends-at{{ $up }}">{{ $upcoming_submissions[$up]['end_time'] }}</span>
          </p>
          <p class="card_text">Queue status: <span class="queue" ></span> </p>
          <button class="btn card_btn">Read More</button>
        </div>
      </div>
    </li>
    @endfor
  </ul>
</div>
<div class="main">
  <h1>Expired Submissions</h1>
  <ul class="cards">
    @for($fi=0; $fi < count($finished_submissions); $fi++)
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="https://picsum.photos/500/300/?image=10"></div>
        <div class="card_content">
          <h2 class="card_title">{{ $finished_submissions[$fi]['subject_name'] }}</h2>
          <p class="card_text">
            Started at:
            <span id="">{{ $finished_submissions[$fi]['start_time'] }}</span>
          </p>
          <p class="card_text">
            Ended at:
            <span id="ends-at{{ $up }}">{{ $finished_submissions[$fi]['end_time'] }}</span>
          </p>
          <p class="card_text">Queue status: <span class="queue" ></span> </p>
          <button class="btn card_btn">Read More</button>
        </div>
      </div>
    </li>
    @endfor
  </ul>
</div>

{{-- <div id="submissions" class="submissions">
  <div class="e-inner-elements">
    <div class="db"> 
    </div>
    <div class="" style="" > 
      <h1></h1>
    </div>
    <div class="on-events">
      
      <div class="card" >
        <div class="card-body">
            <h4 class="card-title">
              <span id="set-sub" >
                
              </span>
            </h4>
            <p class="card-text">
              
            </p>
          <p class="card-text">
            Ends in:  <span id=""></span>
          </p>
          
        </div>
      </div>
      @endfor
    </div>
    <br>
    <div class="" style="" > 
      <h1>Upcoming Submissions</h1>
    </div>
    <div class="" style=" text-align: center " > 
      <button type="button"  class="create-events" name="button" onclick="showUser()"> Create Submission</button> 
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
              Starts in: <span id=""></span>
            </p>
          <p class="card-text">
            
          </p>
          <p class="card-text">Queue status: <span class="queue" ></span> </p>
        </div>
      </div>
      @endfor
    </div>
    <br>
    <div class="" style="" > 
      <h1></h1>
    </div>
    <div class="on-events">
      @for($fi=0; $fi < count($finished_submissions); $fi++)
      <div class="card" >
        <div class="card-body">
            <h4 class="card-title">
              <span id="set-sub" >
                {{ $finished_submissions[$fi]['subject_name'] }}
              </span>
            </h4>
            <p class="card-text">
              
            </p>
          <p class="card-text">
            Ended at:  <span id="">{{ $finished_submissions[$fi]['end_time'] }}</span>
          </p>
          <p class="card-text">Queue status: <span class="queue" ></span> </p>
        </div>
      </div>
      @endfor
    </div>
    <br>
  </div>
</div> --}}
<script type="text/javascript">
  getUpcomingtime();
  getOngoingtime();
</script>
@endsection
