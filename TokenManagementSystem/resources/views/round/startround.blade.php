@extends('round.base')

@section('title')
<title>Start Round</title>
@endsection

@section('content')
<div class="container">
	<div class="center-align grey lighten-2">
		<h2>{{$submission->subject->name}}</h2>
	</div>

	<div class="timer" >
		<span id="iTimeShow"  >Time Remaining: </span><br><span id='timer' style="font-size:25px;"></span></h4>
{{--
		<div id="myProgress" >
  <div id="myBar"></div>
		</div> --}}

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
	// move();
	// timedCount();

</script>

<script type="module">

	//checks whether a round can be started or not via a GET request
		var queslength=0;
		var questionsLength;
		var count=0;
		var t=null;
		var checkroundstatus= null;
		var roundData=null;
		var question_form=null;
		var participant_id= {{$participant->id}};
		var form_id="response_"+participant_id;
		var timer_sec=5;
		var submit_url="{{url()->current()}}";
		submit_url=submit_url.replace("/startRound","/");

		var csrf_tag= document.createElement('meta'); //<meta name="csrf-token" content="{{ csrf_token() }}">
		csrf_tag.name="csrf_token";
		csrf_tag.content="{{ csrf_token() }}";
		console.log(csrf_tag);

		// var participant_tag=document,createElement("input");
		// participant_tag.type="hidden";
		// participant_tag.value=participant_id;
		// participant_tag.name="participant_id";
		// console.log(participant_tag);

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
						 question_form.id=form_id;
						 console.log("Question form id "+question_form.id);
						 question_form.name = "question_response";
						 question_form.method= "POST";
						 question_form.action= submit_url;
						 console.log("Submit url:"+question_form.action);
						 question_form.appendChild(csrf_tag);
						 //question_form.appendChild(participant_tag);

						 // for(var i=1;questionsIterator(i,roundData);i++){
						 // 		var q="q"+i;
							// 	 createQuestionInput(i,roundData[q]);
						 // }
						 var q="q",i=1, questionsLength=getQuestionsLength(roundData);

						 var x=setInterval(function(){
						 							//hide previous question
						 						if(i>1){
						 							var j=i-1;
						 							console.log("i:"+i+"Hiding "+"question_"+roundData[q+j]);
						 							var qtn=document.getElementById("question_"+roundData[q+j])
						 							qtn.style.display="none";

						 							question_form.appendChild(qtn);
						 						}


						 							createQuestionInput(i,roundData[q+i])
						 							i=i+1;

						 							if(!questionsIterator(i,roundData))
						 								{clearInterval(x);}
						 				},timer_sec*1000);

						 //Hiding last question
						 setTimeout(function(){
						 	i=i-1;
						 	console.log("i:"+i+"Hiding "+"question_"+roundData[q+i]);
						 	var qtn=document.getElementById("question_"+roundData[q+i])
						 	qtn.style.display="none";

						 	question_form.appendChild(qtn);

						 	console.log("Round is over");
							$("#start-message").text("ROUND IS  NOW OVER....SUBMITTING");
							document.body.appendChild(question_form);
							question_form.submit();

						 }, (questionsLength+1)*timer_sec*1000);
						 //createQuestionInput(1,1);

					}

				});
	}

	checkroundstatus = window.setInterval(getRoundStatus ,1000);

	function getQuestionsLength(data){
			var count=1;
			while(questionsIterator(count,data)){
				count++;
			}

			count-=1;
			console.log("Number of question is:"+count);

			return count;

	}
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


		// move();
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

											t= setInterval(timedCount,1000);
								});

	}

function makeOptionDiv(question_id,option,option_no){
	var inputdiv=`<label><input type="radio" value=${option_no} name="answer_${question_id}" /><span>${option}</span></label>`;
	var optiondiv= '<div class="card-action">'+inputdiv+'</div>';

	return optiondiv;
}
//	getRoundData();

var c=timer_sec-1;
var queslength = 3;
function timedCount()
	{console.log("inside time");
		// if(c == timer_sec)
		// {
		// 	return true;
		// }
			// c=c*3;
		var hours = parseInt( c / 3600 ) % 24;
		var minutes = parseInt( c / 60 ) % 60;
		var seconds = c % 60;
		var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);
		$('#timer').html(result);
// console.log("result"+result);
		if(c == 0 )
		{

					console.log("question length:"+queslength);
					console.log("count:"+count);

					// this.displayScore();
					// $('#iTimeShow').html('Quiz Time Completed!');
					// $('#timer').html("You scored: " + correctAnswers + " out of: " + questions.length);
				if (count <= queslength) {
					console.log('inside if');
					count+=1;
					queslength-=1;
					c=timer_sec-1;
					clearInterval(t);

				}
				else {

					return false;
				}


					// $(document).find(".preButton").text("View Answer");
					// $(document).find(".nextButton").text("Play Again?");
					// quizOver = true;
					// return false;

		}
		else{
			c = c - 1;
		}

		// var t = setTimeout(function()
		// {
		// 	timedCount()
		// },1000);
	}

	//
	// function move() {
	// 	// alert("started");
	//   var elem = document.getElementById("myBar");
	//   var width = 1;
	//   var id = setInterval(frame, 3000);
	//   function frame() {
	//     if (width >= 100) {
	//       clearInterval(id);
	//     } else {
	//       width++;
	//       elem.style.width = width + '%';
	//     }
	//   }
	// }

</script>
{{--
<style media="screen">
	#myBar{
		width: 1%;
		height: 30px;
		background-color: red;
	}
	#myProgress{
		width: 100%;
		background-color: aqua;
	}
</style> --}}

@endsection
