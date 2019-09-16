@extends('layouts.app')

@section('content')

<div class="center">
  <form class="form" action="{{ route('login') }}" method="POST"  name="form" onsubmit="return validation()" >
    @csrf

    <h1> <b>Log in</b> </h1>

    <table border="0">
      <tr>
        <td><input type="email" id="username" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="off" onchange="isEmpty1()" required autofocus></td>
      </tr>

      <tr>
        <td> 
            <span id="user" style="color:red; font-size: 18px;">
                @error('email')
                    <span class="">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </span>
        </td>
      </tr>


      <tr>
        <td>  <br> </td>
      </tr>
      <tr>
        <td><input type="password" class="@error('password') is-invalid @enderror" name="password" placeholder=" Password"  id="password" onchange="isEmpty2()" required></td>
      </tr>


      <tr>
        <td> 
            <span id="pass" style="color:red; font-size: 16px;">
                @error('password')
                    <span class="" >
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </span>
        </td>
      </tr>

      <tr>
        <td> <br> </td>
      </tr>

      <tr>

        <td style="display: flex;">
            <input id="radio" type="radio" class="@error('type') is-invalid @enderror" name="type" value="Teacher"  onclick="usertype(this.value)"> 
            <h2 style = "font-size: 30px;"> <b>Teacher</b> </h2> 
        </td>

      </tr>
      <tr>
        <td style="display: flex;"> 
          <input id="radio" type="radio" class="@error('type') is-invalid @enderror" name="type" value="Student" onclick="usertype(this.value)"> 
            <h2 style = "font-size: 30px;"> <b>Student</b> </h2> 
        </td>
      </tr>
      <tr>
        <td> 
            <span id="type" style="color:red; font-size: 16px;">
                @error('type')
                    <span class="" >
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </span>
        </td>
      </tr>
      <tr>
        <td> <input type="text" name="" id="hide" value="" onchange="isEmpty3"> </td>
      </tr>
      <tr>
        <td> <span id="whologin" style="color:red; font-size: 18px;"></span> </td>
      </tr>

      <tr>
        <td> <br> </td>
      </tr>

      <tr>
        <td><button type="submit" class="signin"  > <b>Sign in</b> </button> </td>
      </tr>

      <tr>
        <td> <h3>Don't have an account? <a href="{{ route('register') }}">Register! </a> </h3> </td>
      </tr>

    </table>
  </form>
</div>

@endsection()