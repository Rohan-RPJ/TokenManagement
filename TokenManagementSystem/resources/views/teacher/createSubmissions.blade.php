@extends('layouts.main')

@section('content')

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
  var c = document.getElementById('fcfs-radio-btn').value;
  document.getElementById('chk-btn').value = c;
}

</script>

<style>

</style>
<div class="inner-container">
  <div class="create">

    <form method="POST" action="{{ route('questions.store') }}" onsubmit="updateTotal();" autocomplete="off" class="form" >
      @csrf
      <table>
        <!-- Select Year: -->
        <tr>
          <td>
            <select class="years" name="year" id="year" onchange="fillSubjectsdropdown();"><br>
              <option value="">---Select--Year---</option>
              @foreach($years as $year)
              <option value="{{ $year['year'] }}">{{ $year['year'] }}</option>
              @endforeach
            </select>
            <span id='yr' style=" color: red;"  ></span>
          </td>
        </tr>
        <tr>
          <td><br></td>
        </tr>


        <!-- Select Branch: -->
        <tr>

          <td>
            <select class="branches" name="branch" id="branch" onchange="fillSubjectsdropdown()"><br>
              <option value="">---Select--Branch---</option>
              @foreach($branches as $branch)
              <option value="{{ $branch['branch'] }}">{{ $branch['branch'] }}</option>
              @endforeach
            </select>
            <span id='br' style=" color: red;"  ></span>
          </td>
        </tr>
        <tr>
          <td><br></td>
        </tr>
        <!-- Select Subject: -->
        <tr>
          <td>
            <select class="subjects" name="subject" id="subject" onchange="showValue();">
              <!-- <option value=""></option> -->
            </select>
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
            <input id="quiz-radio-btn" type="radio" name="type" value="quiz" onclick="displayQues();">
            &nbsp;&nbsp;
            Take Quiz
          </td>
        </tr>
        <tr>
          <td><br></td>
        </tr>
        <tr>
          <td>
            <input id="fcfs-radio-btn" type="radio" name="type" value="fcfs" onclick="hideQues();">
            &nbsp;&nbsp;
            FCFS
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
            <div id="question-div" class="questionDiv">
              <ul class="questionCards" id="questionsList">
              </ul>
              <input id="addQuestionButton" type="button" value="Add Question" name="question" onclick="addQuestion();">
            </div>
          </td>
        </tr>
        <tr>
          <td><br></td>
        </tr>
        <tr>
          <td>
            Enter Date of Submission:
          </td>
        </tr>
        <tr>
          <td><input type="date" name="submission_date" id="chk-date" required >
            <!-- <span id='d' style=" color: red;"  ></span> -->
          </td>
        </tr>

        <tr>
          <td><br></td>
        </tr>

        <tr>
          <td>Enter Start Time of Submission:</td>
        </tr>
        <tr>
          <td> <input type="time" name="start_time" id="chk-start-time" required >
            <!-- <span id='st' style=" color: red;"  ></span> -->
          </td>

        </tr>

        <tr>
          <td><br></td>
        </tr>

        <tr>
          <td>
            Enter End Time of Submission:</td>
          </tr>

          <tr>
            <td><br></td>
          </tr>
          <tr>

            <td> <input type="time" name="end_time" id="chk-end-time" required>
              <!-- <span id='et' style=" color: red;"  ></span> -->
            </td>
          </tr>


          <tr>
            <td>
              <input type="text" name="total" id="hiddenText" value="" style="display: none;">
              <!-- <span id='br' style=" color: red;"  ></span> -->
            </td>
            <td>
              <br>
            </td>
          </tr>
          <tr>
            <td>
              <input type="submit" name="submit" value="Submit"  onclick="return validate()" >
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  @endsection
