@extends('round.base')

@section('title')
<title>Loading....</title>
@endsection

@section('content')

<style>
.content {
        width: 200px;
        height: 600px;
        

        position:absolute; /*it can be fixed too*/
        left:0; right:0;
        top:0; bottom:0;
        margin:auto;

        /*this to solve "the content will not be cut when the window is smaller than the content": */
        max-width:100%;
        max-height:100%;
        overflow:auto;
    }
</style>

<div class="container">
<div id="loading" class="center-align">
	
	<div class="content">
	<i class="fa fa-circle-o-notch fa-spin" style="font-size:144px"></i>

	</div>
</div>
</div>

<script type="module" defer>
	var t;

	function checkToken(){
			console.log("inside checkToken");
			$.ajax({ method:"GET", url:"/tokens/{{$participant->id}}/{{$round_id->round_id}}/?t="+Math.random(), async:false,success: function(data){
    				console.log(data);
      				var result=data;
    				if(result.result){
    					clearInterval(t);
    					console.log("Token allocated with "+result.token.value);
    					document.location.href="/tokens/redirect/{{$participant->id}}/{{$round_id->round_id}}";

    					}
					}
				}
			);
		}
	
	$(document).ready(function(){
		t= setInterval(checkToken,1000);
		//manually call the token allocation if 1.25 minute is over
		var x=setTimeout(function(){
			clearTimeout(x);
			console.log("Force submitting...");
			$.get("/rounds/{{$submission->id}}/{{$round_id->round_id}}/{{$participant->id}}/forcesubmit");
		}, 1.25*60*1000); //1.25 minutes
	})
</script>
@endsection
