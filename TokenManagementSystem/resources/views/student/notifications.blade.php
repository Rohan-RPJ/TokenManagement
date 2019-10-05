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

<style type="text/css">
  
.header li .notif{
  background-color: #242424;
}
h1{
  margin-top: 50px;
}
</style>
<h1>Tokens Alloted</h1>
<div class="tokens" style="margin: 10px;margin-top: 10px;">
  @if(count($tokens) == 0)
    <p id="no-token">👋 No tokens alloted</p>
  @endif
	@foreach($tokens as $token)
		<p>👋 Token <b>#{{ $token->value }}</b> has been allocated to you for <b>{{ $token->submission->subject->name }}</b> of Professor <b> {{$token->submission->teacher->tName}}</b> <span  style="align:right"><i>{{$token['created_at']->diffForHumans()}}</i></span></p>
	@endforeach
</div>

<h1>Submission Calls</h1>
<div class="notifications" id="notifications-id" style="margin: 10px;">
  @if(count($notifications) == 0)
    <p id="no-submission">👋 No submission calls</p>
  @endif
	@for($i=count($notifications)-1;$i >= 0; $i--)
		<p>👋 Professor <b>{{ $submissions[$i]['teacher_name'] }}</b> called you for <b>{{ $submissions[$i]['subject_name'] }}</b> submission <span  style="align:right"><i>{{Carbon\Carbon::parse($notifications[$i]['created_at'])->diffForHumans()}}</i></span></p>
	@endfor
</div>

<script type="text/javascript">
	var user = {!! json_encode(Auth::user()->toArray(), JSON_HEX_TAG) !!};
  //console.log(user);
  if (user['type'] == 'Student') {
    var notifications = setInterval(function() {
      $.ajax({
        type:'GET',
        url:'/student/sendUnreadNotifications',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data) {
          var unReadNotifications = data.notifications;
          console.log(data.notifications.length);
          var submissions = data.submissions;
          sub_calls_innerHtml = "";
          for (var i = 0; i < data.notifications.length; i++) {
            sub_calls_innerHtml += "<p>👋 Professor <b>"+ submissions[i]['teacher_name'] + "</b> called you for <b>" + submissions[i]['subject_name'] + "</b> submission <span  style='align:right'><i>"+unReadNotifications[i]['createdAt']+"</i></span></p>";
          }
          sub_calls_innerHtml += document.getElementById('notifications-id').innerHTML;
          document.getElementById('notifications-id').innerHTML = sub_calls_innerHtml;
        }
      });  
    }, 5000);
  }
</script>
@endsection