@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/submissions.css') }}">
<script type="text/javascript">
  var upcoming_submissions = {!! json_encode($upcoming_submissions, JSON_HEX_TAG) !!};
  var ongoing_submissions = {!! json_encode($ongoing_submissions, JSON_HEX_TAG) !!};
  var finished_submissions = {!! json_encode($finished_submissions, JSON_HEX_TAG) !!};
  //console.log(ongoing_submissions);
</script>
{{--
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
--}}

<div id="ongoing_submissions" class="main">
  <h1>Ongoing Submissions</h1>
  @if(count($ongoing_submissions) === 0)
    <p>👋 There are no ongoing submissions right now. Come Again later to search your submission.</p>
  @endif
  <ul class="cards">
    @for($on=0; $on < count($ongoing_submissions); $on++)
    <li class="cards_item">
      <div class="card">
        <div class="card_image">
          <img src="{{ asset('images/darkbg4.jpg') }}">
          <div class="text-block">
            <h4 class="img-header">{{ $ongoing_submissions[$on]['subject_name'] }}</h4>
            <h4 class="img-content">Professor : &nbsp {{ $ongoing_submissions[$on]['teacher_name'] }}</h4>
            <h4 class="img-content" id="on_venue{{ $on }}">Venue : {{ $ongoing_submissions[$on]['venue'] }}</h4>
            <h4 class="img-content" id="on_status{{ $on }}">Status :
              @if($ongoing_submissions[$on]['status'] === 0)
                Over
              @elseif($ongoing_submissions[$on]['status'] === 1)
                Active
              @elseif($ongoing_submissions[$on]['status'] === 2)
                Pause
              @endif
            </h4>
          </div>
        </div>
        <div class="card_content">
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
          <button id="btn{{ $on }}" class="btn card_btn" onclick="toggleParticipantModal();getDetails('{{ $on }}','{{ $ongoing_submissions[$on]['id'] }}')">Join Submission</button>
        </div>
      </div>
    </li>
    @endfor
  </ul>
</div>
<div id="upcoming_submissions" class="main">
  <h1>Upcoming Submissions</h1>
  @if(count($upcoming_submissions) === 0)
    <p>👋 There are no upcoming submissions right now. Come Again later to search your submission.</p>
  @endif
  <ul class="cards">
    @for($up=0; $up < count($upcoming_submissions); $up++)
    <li id="up_cards_item{{ $up }}" class="cards_item">
      <div id="up_card{{ $up }}" class="card">
        <div class="card_image">
          <img src="{{ asset('images/darkbg4.jpg') }}">
          <div class="text-block">
            <h4 class="img-header">{{ $upcoming_submissions[$up]['subject_name'] }}</h4>
            <h4 class="img-content">Professor : &nbsp {{ $upcoming_submissions[$up]['teacher_name'] }}</h4>
            <h4 class="img-content" id="up_venue{{ $up }}">Venue : {{ $upcoming_submissions[$up]['venue'] }}</h4>
          </div>
        </div>
        <div class="card_content">
          <p class="card_text">
              Starts in :
              <span id="starts-in{{ $up }}"></span>
            </p>
            <p class="card_text">
              Ends at :
              <span id="ends-at{{ $up }}">{{ $upcoming_submissions[$up]['end_time'] }}</span>
            </p>
          <p class="card_text">Queue status : <span class="queue" ></span> </p>
          {{-- <button id="btn{{ $up }}" class="btn card_btn" onclick="">Join Submission</button> --}}
        </div>
      </div>
    </li>
    @endfor
  </ul>
</div>
<div id="finished_submissions" class="main">
  <h1>Finished Submissions</h1>
  @if(count($finished_submissions) === 0)
    <p>👋 There are no finished submissions right now.</p>
  @endif
  <ul class="cards">
    @for($fi=0; $fi < count($finished_submissions); $fi++)
    <li class="cards_item">
      <div class="card">
        <div class="card_image">
          <img src="{{ asset('images/darkbg4.jpg') }}">
          <div class="text-block">
            <h3 class="">{{ $finished_submissions[$fi]['subject_name'] }}</h3>
            <h4 class="">Professor : &nbsp {{ $finished_submissions[$fi]['teacher_name'] }}</h4>
            <h4 class="img-content" id="fi_venue{{ $fi }}">Venue : {{ $finished_submissions[$fi]['venue'] }}</h4>
          </div>
        </div>
        <div class="card_content">

          <p class="card_text">
            Started at :
            <span id="">{{ $finished_submissions[$fi]['start_time'] }}</span>
          </p>
          <p class="card_text">
            Ended at :
            <span id="ends-at{{ $up }}">{{ $finished_submissions[$fi]['end_time'] }}</span>
          </p>
          {{-- <button id="btn{{ $fi }}" class="btn card_btn" onclick="">Join Submission</button> --}}
        </div>
      </div>
    </li>
    @endfor
  </ul>
</div>


<div class="modal_joinParticipant">
    <div class="modal-content">
      <span class="close-button" onclick="toggleParticipantModal();">×</span>
      <h1 style="color: #9f9fc9;">Join Submission</h1>
      <form method="POST" action="{{ route('participant.join') }}"
      onsubmit="" autocomplete="off">
      @csrf
      <table border="0">
        <tr>
          <td>Subject:</td>
          <td><label id="subject_label"></label></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
          <td>Professor:</td>
          <td><label id="professor_label"></label></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
          <td>Status:</td>
          <td><label id="status_label"></label></td>
        </tr>
        <tr>
          <td>
            <input name="submission_id" id="hidden_submission_id" value="" style="display: none;"></td>
          <td>
            <br>
          </td>
        </tr>
      </table>
      <input class="btn participate_btn" type="submit" name="participate_btn" value="Participate ✔️">
    </form>
  </div>
</div>

<style type="text/css">
</style>
</div>
<script type="text/javascript">
  getUpcomingtime();
  getOngoingtime();

  var modal_joinParticipant = document.querySelector(".modal_joinParticipant");

  function toggleParticipantModal() {
    modal_joinParticipant.classList.toggle("show-modal");
}

function windowOnClick(event) {
    if (event.target === modal_joinParticipant) {
        toggleParticipantModal();
    }
}

function getDetails(card_id, submission_id){
  //console.log(ongoing_submissions[card_id],submission_id);
  document.getElementById('subject_label').innerHTML = ongoing_submissions[card_id]['subject_name'];
  document.getElementById('professor_label').innerHTML = ongoing_submissions[card_id]['teacher_name'];

  if (ongoing_submissions[card_id]['status'] == 0) {
    document.getElementById('status_label').innerHTML = "Over";
  }
  else if (ongoing_submissions[card_id]['status'] == 1) {
    document.getElementById('status_label').innerHTML = "Active";
  }
  else if (ongoing_submissions[card_id]['status'] == 2) {
    document.getElementById('status_label').innerHTML = "Pause";
  }

  document.getElementById('hidden_submission_id').value = submission_id;
}

window.addEventListener("click", windowOnClick);
</script>

<script type="text/javascript">
  var user = {!! json_encode(Auth::user()->toArray(), JSON_HEX_TAG) !!};
    //console.log(user);
    var unReadNotifCount = 0;
    if (user['type'] == 'Student') {
      this.unReadNotifCount = {!! $unReadNotifCount !!};
      //console.log(this.unReadNotifCount);
    }
    showUnreadNotifCount(unReadNotifCount);
</script>

@endsection
