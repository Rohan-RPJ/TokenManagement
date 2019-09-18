{{--
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
--}}


{{-----------------------------------------------   Without Bootstrap  ------------------------------------------------}}

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>TokenManagement</title>
  <link rel="stylesheet" href="{{ asset('css/base.css') }}">

  <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js">
  </script>
</head>
<body>

  <!-- -------------------------------------------------------------------------------------- HOME PAGE ------------------------------------------------------------------------------------------------ -->

 <div class="main">

    <div class="nav-header" >
        <div class="f-s" style="color: #ddbcff;" ><h1>FILE SUBMISSION</h1></div>
        @if (Route::has('login'))
            @auth
                <div class=""><a href="{{ url('/home') }}"><h2  class="home" >Home</h2></a></div>
                <div class=""><a href="#"><h2 class="events" >Events</h2></a></div>
            @else
                <div class="login"><a href="{{ route('login') }}"><h2 class="nav-link">Login</h2></a></div>
                @if (Route::has('register'))
                    <div class="register"><a href="{{ route('register') }}"><h2 class="nav-link">Register</h2></a></div>
                @endif  
            @endauth
        @endif
    </div>

    <div class="inner-elements">
        <div class="">
          <h1>WELCOME TO FILE SUBMISSION!. <br> USING TOKEN MANAGEMENT SYSTEM.</h1>
          <br>
          <h3>A token management system is used to control queues.<br> Queues of people form in various situations and locations in a queue area.</h3>
        </div>
    </div>
 </div>
</body>
</html>