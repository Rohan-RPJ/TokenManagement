@extends('layouts.main')

@section('content')

<script type="text/javascript">
  
</script>
<div class="notifications" style="margin: 10px;margin-top: 100px;">
	{{-- @for($i=0;$i < count($notifications); $i++)
		<p>👋 Professor <b>{{ $submissions[$i]['teacher_name'] }}</b> called you for <b>{{ $submissions[$i]['subject_name'] }}</b> submission</p>
	@endfor --}}
	<p>👋 No notifications here.</p>
</div>
@endsection