@extends('layouts.main')

@section('content')

@include('student.alerts')
<script type="text/javascript">
  var notifications = {!! json_encode($notifications, JSON_HEX_TAG) !!};
  //var submissions = {!! json_encode($submissions, JSON_HEX_TAG) !!};
//  var tokens={!! json_encode($tokens, JSON_HEX_TAG) !!};
//  console.log(tokens);
  console.log(notifications); 
</script>

<div class="tokens" style="margin: 10px;margin-top: 100px;">
	@foreach($tokens as $token)
		<p>👋 Token <b>#{{ $token->value }}</b> has been allocated to you for <b>{{ $token->submission->subject->name }}</b> of Professor <b> {{$token->submission->teacher->tName}}</b> <span  style="align:right"><i>{{$token['created_at']->diffForHumans()}}</i></span></p>
	@endforeach
</div>

<div class="notifications" style="margin: 10px;margin-top: 10px;">
	@for($i=0;$i < count($notifications); $i++)
		<p>👋 Professor <b>{{ $submissions[$i]['teacher_name'] }}</b> called you for <b>{{ $submissions[$i]['subject_name'] }}</b> submission <span  style="align:right"><i>{{$notifications[$i]['created_at']}}</i></span></p>
	@endfor
</div>

<script type="text/javascript">
	var user = {!! json_encode(Auth::user()->toArray(), JSON_HEX_TAG) !!};
    //console.log(user);
    var unReadNotifCount = 0;
    if (user['type'] == 'Student') {
      this.unReadNotifCount = {!! $unReadNotifCount !!};
      //console.log(this.unReadNotifCount);
    }
    showUnreadNotifCount(unReadNotifCount);
</script>
@endsection