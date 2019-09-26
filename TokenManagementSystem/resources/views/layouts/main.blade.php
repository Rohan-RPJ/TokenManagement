<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Welcome to File Submission</title>

  <!---Fonts--->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="http://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/teacher/submissions.css') }}">
  <link rel="stylesheet" href="{{ asset('css/teacher/createsubmissions.css') }}">
  <link rel="stylesheet" href="{{ asset('css/student/submissions.css') }}">

  <!---Scripts--->
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
  <script src="{{ asset('js/teacher/submissions.js') }}"></script>

  <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

  <script src="{{ asset('js/teacher/createsubmissions.js') }}"></script>
  {{-- <script src="{{ asset('js/student/submissions.js') }}"></script> --}}

  <script type="text/javascript">
    var user = {!! json_encode(Auth::user()->toArray(), JSON_HEX_TAG) !!};
    function showCreate(){
      console.log(user['type']);
      if (user['type'] === 'Teacher') {
        document.getElementById('create-nav-btn').style.display = 'inherit';
      }
    }
  </script>

</head>
<body onload="showCreate();">
  <header class="header">
    <a href="#" class="logo" style="color: #ddbcff;"><b>FILE SUBMISSION</b></a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
      <li><a href="{{ url('/home') }}" class="home">Home</a></li>
      <li><a href="{{ Auth::user()->type === 'Teacher' ? route('teacher.submissions') : route('student.submissions') }}"
      onclick="" class="events">Submissions</a></li>
      <li><a id="create-nav-btn" href="{{ route('teacher.create.submissions') }}" class="create">Create</a></li>
      <li><a href="#" class="notif">Notifications</a></li>
      <li><a href="#">Profile</a></li>
      <li><a href="#">History</a></li>
      @guest
        <li>
          <a href="">Login</a>
        </li>
        @if (Route::has('register'))
          <li class="nav-item">
            <a href="{{ route('register') }}">Register</a>
          </li>
        @endif
      @else
        <li>
          <div>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      @endguest
    </ul>
  </header>
  <main class="main">
    <div class="section">

      <div class="" id="showContent">
        @yield('content')
      </div>
    </div>
  </main>
</body>
</html>
