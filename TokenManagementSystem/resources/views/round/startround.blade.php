@extends('round.base')

@section('title')
<title>Start ROund</title>
@endsection

@section('content')
<div class="container">

	<div class=center-align>
		<h5>
			<span id="start-message"><strong>PLEASE KEEP THIS PAGE OPEN .ROUND WILL BEGIN SOON</strong></span>
		</h5>
	</div>
</div>

<script type="module" src="{{asset('js/app.js')}}"></script>

<script type="module">

	//checks whether a round can be started or not
	
		var result= $.get("./?t="+Math.random(), function(data,status){
			console.log("Data",data.result);
			result=data.result;
			if(result == true)
			{
				console.log("Round can be started");
				$("#start-message").text("ROUND IS  NOW STARTING....");

			}
		
		});
		


	
	
	
	
</script>	

@endsection