@extends('round.base')

@section('title')
<title>Start ROund</title>
@endsection

@section('content')
<div class="container">
	<div class="center-align grey lighten-2">
		<h2>{{$submission->subject->name}}</h2>
	</div>

	<div class="timer">	

	</div>

	<div class=center-align>
		<h5>
			<span id="start-message"><strong>PLEASE KEEP THIS PAGE OPEN .ROUND WILL BEGIN SOON</strong></span>
		</h5>
		<h5>
			<div id="question_display"></div>
		</h5>
		
	</div>
</div>

<script type="module" src="{{asset('js/app.js')}}"></script>

<script type="module">

	//checks whether a round can be started or not via a GET request
		var checkroundstatus= null;
		var roundData=null;
		var question_form=null;

		var timer_sec=5;

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
						
						console.log(roundData.q2);
						 //creating an invisible form now
						 question_form = document.createElement('form');
						 question_form.name = "response";


						 // for(var i=1;questionsIterator(i,roundData);i++){
						 // 		var q="q"+i;
							// 	 createQuestionInput(i,roundData[q]);
						 // }
						 var q="q",i=1;

						 var x=setInterval(function(){
						 							createQuestionInput(i,roundData[q+i])
						 							i=i+1;
						 							if(!questionsIterator(i,roundData))
						 								{clearInterval(x);}
						 				},timer_sec*1000);
						 //createQuestionInput(1,1);

					}
				
				});
	}

	checkroundstatus = window.setInterval(getRoundStatus ,1000);

	function questionsIterator(i,data){
			var q="q"+i;
			if (q in data){return true;}
			return false;
	}

	function getRoundData(){
			roundData={!! json_encode($round_id->toArray(), JSON_HEX_TAG) !!};
	}

	function uncheck(){
		var parent=this;
		console.log(parent);
		console.log("Parent id:"+parent.id);
		var radiogroup	= parent.id.split("_")[1];
		
		radiogroup = document.getElementsByName("answer_"+radiogroup);
		console.log(radiogroup);

		for(var i=0;i<radiogroup.length;i++)
			{
				if(radiogroup[i].checked){
					radiogroup[i].checked=false;
					console.log("Changed checked to false for option"+(i+1));
					break;

				}
			}
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


									var card_html='<div class="row" id="question_'+question_id+'">\
									    <div class="col s12 m6 l12">\
					      				<div class="card blue-grey darken-1">\
					        					<div class="card-content white-text">\
					          							<span class="card-title"> Question '+questionNo+'</span>\
					          									<p>'+question_description+'</p>\
					        					</div>'
					        					+makeOptionDiv(question_id,option1,1)
					        					+makeOptionDiv(question_id,option2,2)
					        					+makeOptionDiv(question_id,option3,3)
					        					+makeOptionDiv(question_id,option4,4)
					        					+'<div class="card-action"><a class="btn-flat waves-teal wave-effect"  id="clear_'+question_id+'">CLEAR</a></div>'+
					      					  '</div>\
					    					</div>\
					  					</div>';

				  						//document.getElementById("question_display").innerHTML+=card_html;
				  						document.getElementById("question_display").insertAdjacentHTML('afterend',card_html);
				  						var clr_btn=document.getElementById("clear_"+question_id);
				  						clr_btn.addEventListener("click",uncheck,false);
								});
		
	}

function makeOptionDiv(question_id,option,option_no){
	var inputdiv=`<label><input type="radio" value=${option_no} name="answer_${question_id}" /><span>${option}</span></label>`;
	var optiondiv= '<div class="card-action">'+inputdiv+'</div>';

	return optiondiv;
}
//	getRoundData();

</script>	

@endsection