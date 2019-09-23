<?php
	$submission_id=null;
	if(isset($_POST['submission_id'])){
		$submission_id=$_POST['submission_id'];
	}
?>

@extends('layouts.main')

@section('content')
		@if($message  = Session::get('success'))
		<div><strong>{{$message}}</strong></div>
		@endif

	<form method="POST" action="/student/submissions/join">
		@csrf

		<label>{{$request->user()->student->sName}}</label>
		<br>
		
		<label>Submission:</label>
		<select name="submission_id">
			@foreach($submissions as $submission)
			<option value="{{$submission->submission_id}}"> {{$submission->year}} {{$submission->branch}} {{$submission->subject->name}} </option>
			@endforeach
		</select>
		<button type="submit">JOIN</button>
	</form>

@endsection