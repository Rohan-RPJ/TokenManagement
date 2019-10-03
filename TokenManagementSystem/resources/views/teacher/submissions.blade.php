@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/submissions.css') }}">
<script type="text/javascript" src="{{ asset('js/teacher/submissions.js') }}"></script>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<script type="text/javascript">
  var upcoming_submissions = {!! json_encode($upcoming_submissions, JSON_HEX_TAG) !!};
  var ongoing_submissions = {!! json_encode($ongoing_submissions, JSON_HEX_TAG) !!};
  var finished_submissions = {!! json_encode($finished_submissions, JSON_HEX_TAG) !!};
  //console.log(ongoing_submissions);

  //check if atleast one stud is selected to call
  var checkBoxes = null;
  function initStudCB(submission_id){
    checkBoxes = $('.students_called');
    console.log('CB'+checkBoxes);
    checkBoxes.change(function () {
    console.log('CB'+checkBoxes);
    $('#notify-form').prop('disabled', checkBoxes.filter(':checked').length < 1);
  });
  checkBoxes.change(); // or add disabled="true" in the HTML  
  document.getElementById('call-modal-subm-id').value = submission_id;
}

</script>

<div id="ongoing_submissions" class="main">
  <h1>Ongoing Submissions</h1>
  @if(count($ongoing_submissions) === 0)
    <p>👋 There are no ongoing submissions right now. Want to add Submissions? 
    Then Create it using above Create link.</p>
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
            <h4 class="img-content inline" id="on_venue{{ $on }}">Venue : {{ $ongoing_submissions[$on]['venue'] }}</h4>
            <h4 class="img-content inline" id="on_status{{ $on }}">Status : 
              @if($ongoing_submissions[$on]['status'] === 0)
                Over
              @elseif($ongoing_submissions[$on]['status'] === 1)
                Active
              @elseif($ongoing_submissions[$on]['status'] === 2)
                Pause
              @endif
            </h4>
            <button class="btn" onclick="toggleUpdateModal();getDetails('on','{{ $on }}', '{{ $ongoing_submissions[$on]['id'] }}');">
              Edit Submission &nbsp &nbsp<i class='fas fa-edit'></i>
            </button>
          </div>
          <button class="float-btn" onclick="toggleCallModal();showStudents('{{ $on }}');
          initStudCB('{{ $ongoing_submissions[$on]['id'] }}');"><i class="fas fa-user"></i></button>
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
          <button id="btn{{ $on }}" class="btn card_btn" onclick="toggleRemoveModal();removeSubmission('{{ $ongoing_submissions[$on]['id'] }}');">Remove Submission</button>
        </div>
      </div>
    </li>
    @endfor
  </ul>
</div>
<div id="upcoming_submissions" class="main">
  <h1>Upcoming Submissions</h1>
  @if(count($upcoming_submissions) === 0)
    <p>👋 There are no upcoming submissions right now. Want to add Submissions? 
    Then Create it using above Create link.</p>
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
            <button class="btn" onclick="toggleUpdateModal();getDetails('up','{{ $up }}', '{{ $upcoming_submissions[$up]['id'] }}');">
              Edit Submission &nbsp &nbsp<i class='fas fa-edit'></i>
            </button>
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
          <button id="btn{{ $up }}" class="btn card_btn" onclick="toggleRemoveModal();removeSubmission('{{ $upcoming_submissions[$up]['id'] }}');">Remove Submission</button>
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
          <button id="btn{{ $fi }}" class="btn card_btn" onclick="toggleRemoveModal();removeSubmission('{{ $finished_submissions[$fi]['id'] }}');">Remove Submission</button>
        </div>
      </div>
    </li>
    @endfor
  </ul>
</div>

<div class="modal_callParticipant">
    <div class="call-modal-content">
      <span class="close-button" onclick="toggleCallModal();">×</span>
      <h1 style="color: black;display: none;" id="call-modal-header">👋 Congratulations, You have checked all your submissions.</h1>
      <form method="GET" action="{{ route('student.call') }}" onsubmit="" autocomplete="off">
        @csrf
      <table id="call-modal-table" class="call-modal-table">
  <caption><input type="submit" id="notify-form" name="notify" value="Notify Students"></caption>
  <thead>
    <tr>
      <th scope="col">Token</th>
      <th scope="col">Name</th>
      <th scope="col">Roll No</th>
      <th scope="col">Notify</th>
    </tr>
  </thead>
  <tbody id="call-student-table-body">
  </tbody>
</table>
<input name="submission_id" type="text" id="call-modal-subm-id" value="" style="display: none;">
</form>
</div>
</div>

<div class="modal_updateSubmission">
    <div class="modal-content">
      <span class="close-button" onclick="toggleUpdateModal();">×</span>
      <h1 style="color: black;">Change Details</h1>
      <form method="GET" action="{{ route('submission.update') }}" 
      onsubmit="" autocomplete="off">
      @csrf
      <table border="0">
        <tr>
          <td>Start Time:</td>
          <td><input type="time" id="changeStartTime" name="new_start_time" required></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
          <td>End Time:</td>
          <td><input type="time" id="changeEndTime" name="new_end_time" required></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
          <td>Venue:</td>
          <td><input type="number" id="changeVenue" name="new_venue" placeholder="Enter room no." required></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
          <td>Status:</td>
          <td><input type="number" id="changeStatus" name="new_status" placeholder="Enter status" required min="0" max="2"></td>
        </tr>
        <tr style="font-size: 14px;margin: 10px;color: grey;text-align: center;">
          <td>0 for over</td>
          <td>1 for active</td>
          <td>2 for pause</td>
        </tr>
        <tr>
          <td>
            <input name="submission_id" id="hidden_submission_id" value="" style="display: none;"></td>
          <td>
          </td>
        </tr>
      </table>
      <input class="btn update_btn" type="submit" name="update_btn" value="Change">
    </form>
  </div>
</div>

<div class="modal_removeSubmission">
    <div class="modal-content">
      <span class="close-button" onclick="toggleRemoveModal();">×</span>
      <h1 style="color: red;">Warning !!</h1>
      <h3 style="color: black;">You are about to remove a submission!</h3>
      <h4>Click remove to proceed.</h4>
      <form method="GET" action="{{ route('submission.remove') }}" 
      onsubmit="" autocomplete="off">
      @csrf
      <input name="submission_id" id="remove_submission_id" value="" style="display: none;">
      <input class="btn remove_btn" type="submit" name="remove_btn" value="Remove">
    </form>
  </div>
</div>
<style type="text/css">
</style>
<script type="text/javascript">
  getUpcomingtime();
  getOngoingtime();
  
  var modal_updateSubmission = document.querySelector(".modal_updateSubmission");
  var modal_removeSubmission = document.querySelector(".modal_removeSubmission");
  var modal_callParticipant = document.querySelector(".modal_callParticipant");

function toggleUpdateModal() {
    modal_updateSubmission.classList.toggle("show-modal");
}

function toggleRemoveModal() {
    modal_removeSubmission.classList.toggle("show-modal");
}

function toggleCallModal(){
  modal_callParticipant.classList.toggle("show-modal");
}

function windowOnClick(event) {
    if (event.target === modal_updateSubmission) {
        toggleUpdateModal();
    }
    if (event.target === modal_removeSubmission) {
        toggleRemoveModal();
    }
    if (event.target === modal_callParticipant) {
        toggleCallModal();
    }
}

function getDetails(type, id, submission_id){
  //console.log(submission_id);
  if (type === 'up') {
    //console.log(document.getElementById('starts-in'+id).innerHTML);
    venue = document.getElementById('up_venue'+id).innerHTML;
    //console.log(s.substring(8).trim());
    document.getElementById('changeVenue').value = venue.substring(8).trim();
    document.getElementById('hidden_submission_id').value = submission_id;
  }
  if (type === 'on') {
    //console.log(document.getElementById('up_venue'+id).innerHTML);
    venue = document.getElementById('on_venue'+id).innerHTML;
    //console.log(s.substring(8).trim());
    document.getElementById('changeVenue').value = venue.substring(8).trim();
    document.getElementById('hidden_submission_id').value = submission_id;
  }
}

function removeSubmission(submission_id){
  document.getElementById('remove_submission_id').value = submission_id;
}

window.addEventListener("click", windowOnClick);  
</script>
@endsection
  