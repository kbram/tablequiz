@extends('layouts.tablequizapp')

@section('template_linked_css')

<style>
.small{
	color:#5A37BA;
}
.break {
  flex-basis: 100%;
  height: 0;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
	$(document).ready(function(){
		$(".timer").html("Wait.....");
		
	});	

	// Enable pusher logging - don't include this in production
	Pusher.logToConsole = true;

	var pusher = new Pusher('87436df86baf66b2192a', {
	cluster: 'ap2'
	});

	var channel = pusher.subscribe('my-channel');
	channel.bind('form-submitted', function(data) {
		//alert(JSON.stringify(data));
		var message = JSON.stringify(data);
		var m0 = message.replace('{"text":"','');
		var m0 = m0.replace('"}','');
		var m0 = m0+"#^10";
		var m=m0.split("#^");
		console.log(m);
		var questionno=m[0];
		var issueq=sessionStorage.getItem("issuequestion");
		issueq=issueq+"@*"+m0;
		sessionStorage.setItem("issuequestion", issueq);
		
		
		$('h4.questionno').text(questionno);
		$('h4.notification').text('');
		//$('h4.ans').text(m[2]);
		var med = m[8];
		//$('div.med').text(med);
		m[1] = m[1].slice(0, -1);
		var answer=m[1].split("/");
		m[3] = m[3].slice(0, -1);
		var answerId=m[3].split("/");
        console.log(answerId);
		var questionId=m[4];
		var roundId=m[5];
		var quizId=m[7];
		m[1] = m[1].slice(0, -1);
         var type=m[2].split("/");
		var text0="<div id='resub2' class='justify-content-center row'>";
		for (var i = 0; i < answer.length; i++) {
			text0 += "<form action='/playquiz/answer' method='post' name='form' id='"+answerId[i]+"' class='col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers '>"+
			"<input name='_token' value='{{ csrf_token() }}' type='hidden'>"+
			"<input type='text' name='answer' hidden value='"+answerId+"'/>"+
			"<input type='text' name='question' hidden value='"+questionId+"'/>"+
			"<input type='text' name='round' hidden value='"+roundId+"'/>"+
			"<input type='text' name='quiz' hidden value='"+quizId+"'/>"+
			"<p>"+answer[i]+"</p>"+ 
			"</form>";	
		} 
		text0 += "</div> <div class='break'></div>"+
		"<div id='resub1' class='justify-content-center row'>"+
			"<div class='' id='resub' >"+
				"<br><a class='btn btn-primary d-block d-lg-inline-block card__from__modal' onclick='document.getElementById("+answerId[i]+").submit()'>Submit Answer</a>"+
			"</div>"+
		"</div>";
		$('#all-answer').empty();
		$('#all-answer').append(text0);
		document.getElementById("demo").innerHTML=issueq;


		//var x=1;
		var y=10;
		var sec= y,
		countDiv    = document.getElementById("timer"),
		secpass,
		countDown   = setInterval(function () {
			'use strict';
			secpass();
		}, 1000);

		function secpass() {
			'use strict';
			
			var min     = Math.floor(sec / 60),
				remSec  = sec % 60;
			
			if (remSec < 10) {
				
				remSec = '0' + remSec;
			
			}
			if (min < 10) {
				
				min = '0' + min;
			
			}
			
			$(".timer").html(min + ":" + remSec);
			
			if (sec > 0) {
				
				sec = sec - 1;
				
			} else {
				
				clearInterval(countDown);
				$(".timer").html("Time Out");
				//$("#resub").css("display", "none");
				//tyle="opacity: 0.4;
				//

				$('#resub').css('cursor','not-allowed');
				$("#resub").css("pointer-events", "none");
				$('#resub').css('opacity','0.4');
			}
		}
		
		var channel1 = pusher.subscribe('my-channel1');
		channel1.bind('form-submitted1', function(data) {
			alert("Teacher Stoped your Submition");
			$('#resub').css('cursor','not-allowed');
			$("#resub").css("pointer-events", "none");
			$('#resub').css('opacity','0.4');
			$(".timer").html("Teacher Stoped");
			clearInterval(countDown);
		});
		var channel1 = pusher.subscribe('my-channel2');
		channel1.bind('form-submitted2', function(data) {
			alert("Teacher Paused");
			$('#resub').css('cursor','not-allowed');
			$("#resub").css("pointer-events", "none");
			$('#resub').css('opacity','0.4');
			$(".timer").html("Teacher Paused");

			$("#resub").css('display','none');
			$("#resub2").css('display','none');
			$("#resub3").css('display','none');

			//$('#all-answer').empty();
			var text11="<h1>Quiz is Paused ,Please Wait!!!</h1>";
			$('#resub1').empty();
			$('#resub1').append(text11);
			clearInterval(countDown);
		});
	});

	
	
</script>
@endsection
@section('content')

<!-- <section class="container page__inner"> -->
<!--
	<div class="row mb-3">
		<div class="col">
			<h2 class="text-white text-center bernhard">MadDog's Geography Quiz</h2>
		</div>
	</div>
-->
	<div class="row">
		<div class="col-12 d-flex justify-content-between">
			<p class="text-white" style="min-width:13vw !important;">{{$quiz->quiz__name}}</p>
			<p><a href="#" class="text-white"><small>Exit quiz</small></a></p>
		</div>
		<article class="col-12 pb-5">

		<div class="col-12 d-flex justify-content-between">

		<p ><a href="#" class="text-white"><small class="small">previous quiz</small></a></p>
		<p><a href="#" class="text-white"><small class="small">next quiz</small></a></p>

		</div>   


			<div class="row border-bottom pb-2 mb-5">
				<div class="col-12 d-flex justify-content-center flex-column">
					<p class="mb-0 text-center"><strong>Round {{$round->id}} of {{$roundCount}}</strong></p>
					<p class="bernhard round__name my-2 text-center">{{$round->round_name}}</p>
				</div>
				<div class="col-12">
					<div>
						<p class=" justify-content-center d-flex align-items-center m-0">Time remaining: <strong class="timer"></strong></p>
					</div>
				</div>
			</div>
			<div id='resub3' class="row question__container">
				<div class="col-12 media__container p-0 mb-5">
					<img src="../images/suir.jpg" >
				</div>
				<div class="col-12 text-center" >
					
					<h4 class="bernhard notification">Not submitted</h4>
				</div>
				<div  class="col-12 the__question text-center mB-2">
					<h4 class="questionno" style="min-width:38vw !important;">  </h4>
				</div>
			</div>
			<div class="med"></div>
@if($question->question_type == 'standard__question')
			<div id="all-answer" class="row answer__options pt-4 justify-content-center flex-wrap">
			
			</div>
@endif

		</article>
		<p id="demo"></p>
	</div>
<!-- </section> -->

<script>

	var correct = {!! json_encode(Session::get("$quiz->id-$round->id-$question->id") ) !!};

    var wrong = {!! json_encode(Session::get("$quiz->id-$question->id") ) !!};
	var allele =  document.getElementsByClassName("answers");
	var all = document.getElementById("all-answer");


	if (correct ){
	var ele = document.getElementById(correct);

	ele.classList.remove("single__answer");
    ele.classList.add("single__answer_correct");
	all.classList.add("cursor_not");


	console.log(correct);

    }

	if (wrong){
	var ele = document.getElementById(wrong);
	ele.classList.remove("single__answer");
    ele.classList.add("single__answer_wrong");
	all.classList.add("cursor_not");


	console.log(worng);
	}


	
</script>

@include('scripts.playquiz')

@endsection
@section('footer_scripts')
@endsection



