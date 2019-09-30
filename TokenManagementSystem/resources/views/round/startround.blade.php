@extends('round.base')

@section('title')
<title>Start ROund</title>
@endsection

@section('content')
<div class="container">
	<div class="center-align grey lighten-2">
		<h2>{{$submission->subject->name}}</h2>
	</div>

	<div class=center-align>
		<h5>
			<span id="start-message"><strong>PLEASE KEEP THIS PAGE OPEN .ROUND WILL BEGIN SOON</strong></span>
		</h5>
	</div>
</div>

<script type="module" src="{{asset('js/app.js')}}"></script>

<script type="module">

	//checks whether a round can be started or not via a GET request
		var checkroundstatus= null;
		var roundData=null;
		var question_form=null;

		function getRoundStatus(){
					console.log("Executing getRoundStatus");

					var result= $.get("./?t="+Math.random(), function(data,status){
					console.log("Data",data.result);
					result=data.result;
					if(result == true)
					{
						console.log("Round can be started");
						$("#start-message").text("ROUND IS  NOW STARTING....");
						clearInterval(checkroundstatus);
						getRoundData();
						//fetching the round_data now
						console.log("Round data"+roundData);
						console.log(roundData);
						console.log(roundData.q1);
						 //creating an invisible form now
						 question_form = document.createElement('form');
						 question_form.name = "response";


						 createQuestionInput(1,1);

					}
				
				});
	}

	checkroundstatus = window.setInterval(getRoundStatus ,1000);


	function getRoundData(){
			roundData={!! json_encode($round_id->toArray(), JSON_HEX_TAG) !!};
	}

	function createQuestionInput(questionNo,question_id){
		
		var question_description;
		var option1,option2,option3,option4;
		
		var questionData= $.ajax({
									method:"GET", 
									url:"/questions/"+question_id,
									async:false,
									success:function(data){
											question_description=data.question_description;
											option1=data.option1;
											option2=data.option2;
											option3=data.option3;
											option4=data.option4;
											}
								}).done(function(){


									var card_html='<div class="row">\
									    <div class="col s12 m6">\
					      				<div class="card blue-grey darken-1">\
					        					<div class="card-content white-text">\
					          							<span class="card-title"> Question '+questionNo+'</span>\
					          									<p>'+question_description+'</p>\
					        					</div>\
					        					<div class="card-action">\
					          						<a href="#">'+option1+'</a>\
					        					</div>\
					        					<div class="card-action">\
					          						<a href="#">'+option2+'</a>\
					        					</div>\
					        					<div class="card-action">\
					          						<a href="#">'+option3+'</a>\
					        					</div>\
					        					<div class="card-action">\
					          						<a href="#">'+option4+'</a>\
					        					</div>\
					      					  </div>\
					    					</div>\
					  					</div>';

				  						document.getElementById("start-message").innerHTML=card_html;
								});
		
	}

	//createQuestionInput();
//	getRoundData();
	
		
	
</script>	

@endsection