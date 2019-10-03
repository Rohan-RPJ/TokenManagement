@extends('layouts.main')

@section('content')

<script type="text/javascript">
  var notifications = {!! json_encode($notifications, JSON_HEX_TAG) !!};
  var submissions = {!! json_encode($submissions, JSON_HEX_TAG) !!};
  //console.log(notifications,submissions); 
</script>
<div class="notifications" style="margin: 10px;margin-top: 100px;">
	@for($i=0;$i < count($notifications); $i++)
		<p>👋 Professor <b>{{ $submissions[$i]['teacher_name'] }}</b> called you for <b>{{ $submissions[$i]['subject_name'] }}</b> submission</p>
	@endfor
</div>
@endsection