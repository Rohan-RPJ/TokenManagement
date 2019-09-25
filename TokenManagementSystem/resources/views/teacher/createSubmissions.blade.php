@extends('layouts.main')

@section('content')

<script type="text/javascript">
  var subjects = JSON.parse('{!! json_encode($subjects) !!}');
    function focusButton(){
        var listItems = document.getElementById('questionsList').getElementsByTagName("li");
        console.log(listItems.length);
        //document.getElementByClassName("question_cards_item"+listItems.length.toString()).focus();
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

    <div class="questionDiv">
    <ul class="questionCards" id="questionsList">
    </ul>
    <input id="addQuestionButton" type="button" value="Add Question" name="question" onclick="addQuestion();">
</div>
    Enter Date of Submission: <br> <input type="date" name="submission_date"><br><br>
    Enter Start Time of Submission: <br> <input type="time" name="start_time"><br><br>
    Enter End Time of Submission: <br> <input type="time" name="end_time"><br><br>
    <input type="text" name="total" id="hiddenText" value="" style="display: none;">
    <input type="submit" name="submit" value="Submit">
  </form>
</div>
</div>
@endsection
