@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/teacher/createsubmissions.css') }}">
<script type="text/javascript">
var subjects = JSON.parse('{!! json_encode($subjects) !!}');
function focusButton(){
  var listItems = document.getElementById('questionsList').getElementsByTagName("li");
  console.log(listItems.length);
  //document.getElementByClassName("question_cards_item"+listItems.length.toString()).focus();
}

function displayQues(){
  //document.getElementById('addQuestionButton').style.display = 'block';
  document.getElementById('question-div').style.display = 'block';
  var c = document.getElementById('quiz-radio-btn').value;
  document.getElementById('chk-btn').value = c;
}

function hideQues(){
  //document.getElementById('addQuestionButton').style.display = 'none';
  document.getElementById('question-div').style.display = 'none';
  var listItems = document.getElementById('questionsList').getElementsByTagName("li");
  for (var i = 0; i < listItems.length; i++) {
    removeQuestion(i+1);
  }
  var c = document.getElementById('fcfs-radio-btn').value;
  document.getElementById('chk-btn').value = c;
}

</script>

<style>
.header li .create{
  background-color: #242424;
}
</style>
<div class="inner-container">


  <div class="create-div">

    <form method="POST" class="create-form" action="{{ route('questions.store') }}" onsubmit="updateTotal();return validateForm();" autocomplete="off"  >
      @csrf
      <table>
        <!-- Select Year: -->
        <tr>
          <td>Enter Year: </td>
          <td>
            <div class="select">
            <select class="years" name="year" id="year" onchange="fillSubjectsdropdown();"><br>
              <option value="">----Select--Year----</option>
              @foreach($years as $year)
              <option value="{{ $year['year'] }}">{{ $year['year'] }}</option>
              @endforeach
            </select>
          </div>
          <span id='yr' style=" color: red;"  ></span>
          </td>
        </tr>
        <tr>
          <td><br></td>
        </tr>


        <!-- Select Branch: -->
        <tr>
          <td>Enter Branch : </td>
          <td>
            <div class="select">
            <select class="branches" name="branch" id="branch" onchange="fillSubjectsdropdown()"><br>
              <option value="">----Select--Branch----</option>
              @foreach($branches as $branch)
              <option value="{{ $branch['branch'] }}">{{ $branch['branch'] }}</option>
              @endforeach
            </select>
          </div>
          <span id='br' style=" color: red;"  ></span>
          </td>
        </tr>
        <tr>
          <td><br></td>
        </tr>
        <!-- Select Subject: -->
        <tr>
          <td>Enter Subject: </td>
          <td>
            <div class="select">
            <select class="subjects" name="subject" id="subject" onchange="showValue();">
              <!-- <option value=""></option> -->
            </select>
          </div>
          <span id='sub' style=" color: red;"  ></span>
          </td>

        </tr>
        <tr>
          <td><br></td>
        </tr>
        <tr>
          <td>
            Select Submission type
          </td>
        </tr>
        <tr>
          <td>
            <br>
          </td>
        </tr>
        <tr>
          <td>
            Enter Date of Submission:
          </td>
          <td><input type="date" name="submission_date" id="chk-date" required>
            <span id='d' style=" color: red;"  ></span>
        </tr>
        <tr>
          <td><br></td>
        </tr>
        <tr>
          {{-- <td>
            <input id="fcfs-radio-btn" type="radio" name="type" value="fcfs" onclick="hideQues();">
            &nbsp;&nbsp;
            FCFS
            <!-- stores submission type -->
            <input type="text" name="" value="" id="chk-btn" style="display: none" onchange="isEmpty()" >
            <span id='radio-btn' style=" color: red; padding-left: 215px;"  ></span>
          </td> --}}
          <td>Enter Start Time of Submission:</td>
          <td> <input type="time" name="start_time" id="chk-start-time" required></td>
        </tr>
        <tr>
          <td><br></td>
        </tr>

        <tr>
          <td>
            Enter End Time of Submission:</td>
            <td> <input type="time" name="end_time" id="chk-end-time" required></td>
          </tr>
          <tr>
            <td><br></td>
        </tr>
        <tr>
          <td><br></td>
          <tr>
          <td>Enter Venue of Submission:</td>
          <td><input type="number" name="venue" placeholder="Enter room no." required></td>
          </tr>
          <tr>
            <td><br></td>
        </tr>
        <tr>
          <td>
            Select Submission type:
          </td>
        </tr>
        <tr>
          <td>
            <br>
          </td>
        </tr>
          <tr>
          <td class="radio">
            <input id="quiz-radio-btn" type="radio" name="type" value="quiz" onclick="displayQues();" required>
            &nbsp;&nbsp;
            <label for="quiz-radio-btn" class="radio-label">Take Quiz</label>
          </td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
          <td class="radio">
            <input id="fcfs-radio-btn" type="radio" name="type" value="fcfs" onclick="hideQues();" required>
          &nbsp;&nbsp;
            <label for="fcfs-radio-btn" class="radio-label">FCFS</label>
              <!-- stores submission type -->
            <input type="text" name="" value="" id="chk-btn" style="display: none" onchange="isEmpty()" >
            <span id='radio-btn' style=" color: red; padding-left: 215px;"  ></span>
          </td>
        </tr>
        <tr>
          <td><br></td>
        </tr>
          <tr>
            <td>
              <input type="text" name="total" id="hiddenText" value="" style="display: none;"></td>
              <td>
                <br>
              </td>
            </tr>
          </table>
          <div id="question-div" class="questionDiv">
              <ul class="questionCards" id="questionsList">
              </ul>
              <input class="btn" id="addQuestionButton" type="button" value="Add Question" name="question" onclick="addQuestion();" style="cursor: pointer;">
              <span id="error" style="display: none;"></span>
            </div>
            <input class="btn create-submit-btn" type="submit" name="submit" value="Submit" style="outline: none;">
        </form>
      </div>
    </div>
  </div>
  @endsection
