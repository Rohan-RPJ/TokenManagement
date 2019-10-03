@extends('layouts.main')

@section('content')

<script type="text/javascript">
  var notifications = {!! json_encode($notifications, JSON_HEX_TAG) !!};
  var submissions = {!! json_encode($submissions, JSON_HEX_TAG) !!};
//  var tokens={!! json_encode($tokens, JSON_HEX_TAG) !!};
//  console.log(tokens);
  //console.log(notifications,submissions); 
</script>

<div class="tokens" style="margin: 10px;margin-top: 100px;">
	@foreach($tokens as $token)
		<p>👋 Token <b>#{{ $token->value }}</b> has been allocated to you for <b>{{ $token->submission->subject->name }}</b> of Professor <b> {{$token->submission->teacher->tName}}</b> <span  style="align:right"><i>{{$token['created_at']->diffForHumans()}}</i></span></p>
	@endforeach
</div>

<div class="notifications" style="margin: 10px;margin-top: 10px;">
	@for($i=0;$i < count($notifications); $i++)
		<p>👋 Professor <b>{{ $submissions[$i]['teacher_name'] }}</b> called you for <b>{{ $submissions[$i]['subject_name'] }}</b> submission <span  style="align:right"><i>{{$submissions[$i]['created_at']->diffForHumans()}}</i></span></p>
	@endfor
</div>


@endsection