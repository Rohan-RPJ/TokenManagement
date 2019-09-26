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
    }

    function hideQues(){
        //document.getElementById('addQuestionButton').style.display = 'none';
        document.getElementById('question-div').style.display = 'none';
    }

</script>

<style>

</style>
<div class="inner-container">


<div class="create">

    <form method="POST" action="{{ route('questions.store') }}" onsubmit="updateTotal();" autocomplete="off"  >
    @csrf

    <!-- Select Year: -->
    <select class="years" name="year" id="year" onchange="fillSubjectsdropdown();"><br>
        <option value="">---Select--Year---</option>
        @foreach($years as $year)
            <option value="{{ $year['year'] }}">{{ $year['year'] }}</option>
        @endforeach
    </select>
    <br><br>
    <!-- Select Branch: -->
    <select class="branches" name="branch" id="branch" onchange="fillSubjectsdropdown()"><br>
        <option value="">---Select--Branch---</option>
        @foreach($branches as $branch)
            <option value="{{ $branch['branch'] }}">{{ $branch['branch'] }}</option>
        @endforeach
    </select>
    <br><br>
    <!-- Select Subject: -->
    <select class="subjects" name="subject" id="subject" onchange="showValue();">
      <!-- <option value=""></option> -->
    </select><br><br>
    <input id="quiz-radio-btn" type="radio" name="type" value="quiz" onclick="displayQues();">Take Quiz
    <input id="fcfs-radio-btn" type="radio" name="type" value="fcfs" onclick="hideQues();">FCFS<br>


    <div id="question-div" class="questionDiv">
        <ul class="questionCards" id="questionsList">
        </ul>
        <input id="addQuestionButton" type="button" value="Add Question" name="question" onclick="addQuestion();">
    </div>
    Enter Date of Submission:<input type="date" name="submission_date"><br>
    Enter Start Time of Submission:<input type="time" name="start_time"><br>
    Enter End Time of Submission:<input type="time" name="end_time"><br>

    <input type="text" name="total" id="hiddenText" value="" style="display: none;">
    <input type="submit" name="submit" value="Submit">
  </form>
</div>
</div>
@endsection
