@extends('layouts.main')

@section('content')

  <head>

      <link rel="stylesheet" href="{{ asset('css/teacher/profile.css') }}">
      {{-- <link rel="stylesheet" href="{{ asset('css/main.css') }}"> --}}


  </head>

<div class="profile-box">

  <div class="left-stuff">
    <h1 style=" text-align: center" >About Me</h1><br>

  <form class="" action="{{ route('register') }}" method="POST" onsubmit="return validation1()">
      @csrf
      <span class="user-detail" >Full Name:</span>
      <br>
      <input type="text" name="" value="{{$teacher->tName}}" class="edit" required >
      <hr>
      {{-- <br><br><br><br> --}}
      {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp/;&nbsp;&nbsp;&nbsp; --}}
      <span class="user-detail">Email:</span>
      <br>
      <input type="email" name="" value="{{$teacher->tEmail}}" class="edit1"  required >
      {{-- <br><br><br><br> --}}
      <hr>
      {{-- <br><br><br><br><br><br> --}}
      <span class="user-detail" >Password:</span>
      <br>
      <input type="password" name="" value="{{$teacher->tPassword}}" required  class="edit2" >
      {{-- <br><br><br><br> --}}
      {{-- <hr> --}}
      <br><br><br>
      <input type="submit" name="" value="Update" class="update" >
      <button type="button" name="button" class="edit-btn"  onclick="enable()" >Edit Profile</button>
  </form>

</div>

@endsection
