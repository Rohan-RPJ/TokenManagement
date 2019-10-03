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
      <input type="text" name="" value="" required >
      {{-- <br><br><br><hr> --}}
      <hr>
      {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp/;&nbsp;&nbsp;&nbsp; --}}
      <span class="user-detail">Email:</span>
      <br>
      <input type="email" name="" value="" required >
      <hr>
      {{-- <br><br><br> --}}
      {{-- <br><br><br><br><br><br> --}}
      {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
      <span class="user-detail" >Password:</span>
      <br>
      <input type="password" name="" value="" required >
      {{-- <br><br><br> --}}
      <hr>
      <span class="user-detail" >Select Year:</span>
      <br>
      <select class="year" name="sYear" id="sYear" onchange="isEmpty3()" required >
          <option value=""> <span></span> </option>
          <option value="FE">First year</option>
          <option value="SE">Second year</option>
          <option value="TE">Third year</option>
          <option value="BE">Fourth year</option>
      </select>
      <hr>
      {{-- <br><br><br> --}}
      <span class="user-detail" >Select Branch:</span>
      <br>
      <select class="branch" name="sBranch" id="sBranch" onchange="isEmpty4()" required >
                        <option value=""> <span></span> </option>
                        <option value="Computer">Computer </option>
                        <option value="Mechanical">Mechanical</option>
                        <option value="Extc">Extc</option>
                        <option value="Instrumentation">Instrumentation</option>
                        <option value="Civil">Civil  </option>
                    </select>
      <hr>
      {{-- <br><br><br> --}}
      <span class="user-detail" >Roll Number:</span>
      <br>
      <input type="text" class="effect-3 @error('sRollNo') is-invalid @enderror" name="sRollNo" value="{{ old('sRollNo') }}" placeholder="  Roll no" id="sRollNo" onchange="isEmpty6()" required >
        <hr>
      {{-- <br><br><br><br> --}}
      {{-- <input type="password" class="effect-4" name="sPassword" value="" placeholder="  New Password" id="sPassword" onchange="isEmpty5()"  required > --}}
      {{-- <br><br><br><br> --}}
      {{-- <hr> --}}
      <input type="submit" name="" value="Update" class="update" >
      <button type="button" name="button" class="edit-btn" >Edit Profile</button>
  </form>

</div>

@endsection
