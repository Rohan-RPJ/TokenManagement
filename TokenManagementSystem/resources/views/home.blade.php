@extends('layouts.main')

{{--
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
--}}

@section('content')

    <div class="inner-elements">
        <div class="">
          <!-- <div class="dept"> -->
              <h3 style="text-align: center;">Department: <span class="dept" > </span> </h3>
          <!-- </div> -->

          <h1>WELCOME TO FILE SUBMISSION!. <br> USING TOKEN MANAGEMENT SYSTEM.</h1>
          <br>
          <h3>A token management system is used to control queues.<br> Queues of people form in various situations and locations in a queue area.</h3>
        </div>
    </div>

@endsection
