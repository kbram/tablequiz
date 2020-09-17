@extends('layouts.tablequizapp')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>

	// Enable pusher logging - don't include this in production
	Pusher.logToConsole = true;

	var pusher = new Pusher('87436df86baf66b2192a', {
	cluster: 'ap2'
	});

	var channel = pusher.subscribe('my-channel0');
	channel.bind('form-submitted0', function(data) {
		//alert(JSON.stringify(data));	
		var message =JSON.stringify(data);	
		var m0 = message.replace('{"text":"','');
		var m0 = m0.replace('"}','');
		var m=m0.split("#^");

		var text="<tr><td>"+m[0]+"</td><td>"+m[1]+"</td><td><input type='radio' name='correct_answer_1' value='correct'></td><td><input type='radio' name='correct_answer_1' value='incorrect'></td></tr>";
		$(text).appendTo($("#all-answer"));
		//$('#all-answer tbody').append(text);
	});
	//var x=1;
	var pl= true;
	var countDown;
	$(document).ready(function(){
		$("#push-submit-pause").css("pointer-events", "none");
		$('#push-submit-pause').css('opacity','0.4');
		$("#push-submit-stop").css("pointer-events", "none");
		$('#push-submit-stop').css('opacity','0.4');
	});	
	function pause() {
		clearInterval(countDown);
		$("#push-submit").css("pointer-events", "auto");
		$('#push-submit').css('opacity','1');
		$("#push-submit-pause").css("pointer-events", "none");
		$('#push-submit-pause').css('opacity','0.4');
		pl=true;
	}

	function stop() {
		clearInterval(countDown);
		$("#push-submit").css("pointer-events", "auto");
		$('#push-submit').css('opacity','1');
		$("#push-submit-pause").css("pointer-events", "none");
		$('#push-submit-pause').css('opacity','0.4');
		$("#push-submit-stop").css("pointer-events", "none");
		$('#push-submit-stop').css('opacity','0.4');
		$("#timer").html("Finshed");
	}
	function play() {
		if(pl==true){
			$("#push-submit-pause").css("pointer-events", "auto");
			$('#push-submit-pause').css('opacity','1');
			$("#push-submit-stop").css("pointer-events", "auto");
			$('#push-submit-stop').css('opacity','1');
			$("#push-submit").css("pointer-events", "none");
			$('#push-submit').css('opacity','0.4');
			pl=false;
		}
		y=document.getElementById("timer").textContent;
		var splity=y.split(":");
		y=parseInt(splity[0])*60+parseInt(splity[1]);

		var sec= y,
		countDiv    = document.getElementById("timer"),
		secpass;
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
			
			$("#timer").html(min + ":" + remSec);
			
			if (sec > 0) {
				
				sec = sec - 1;
				
			} else {
				
				clearInterval(countDown);

				$("#timer").html("Finshed");
				//$("#resub").css("display", "none");
				//tyle="opacity: 0.4;
				//

				///$('#resub').css('cursor','not-allowed');
				//$("#resub").css("pointer-events", "none");
				//$('#resub').css('opacity','0.4');
				
				$("#push-submit").css("pointer-events", "auto");
				$('#push-submit').css('opacity','1');
				pl=true;
			}
		}
	}
</script>
<section class="container page__inner dashboard">
	<div class="dashboard__wrapper">

		<div class="row" style="height:60px;">

			<div class="offset-lg-3 col-lg-9 px-5">
				<div class="progress position-relative">
					<div id="round-progress" class="progress-bar" role="progressbar" style="" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
					<div class="rounds position-absolute d-flex justify-content-between">
						
					@for($i=0; count($rounds)>$i; $i++)
						<div id="round{{$rounds[$i]->id}}" class="progress_round_label">
							<span>Round {{$i+1}} </span>
						</div>
					@endfor
					
						<!-- <div class="progress_round_label round_1">
							<span>Round 1</span>
						</div>
						<div class="progress_round_label round_2">
							<span>Round 2</span>
						</div>
						<div class="progress_round_label round_3">
							<span>Round 3</span>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<aside class="col-lg-3 dashboard__sidebar d-flex flex-column order-1 order-md-0">
				<div class="dashboard__container d-flex flex-column align-items-center mb-3">
					<h5>Countdown timer</h5>
					<p class="countdown__time" id="timer"></p>
					<div class="countdown__buttons row">
						<div class="col-4">
							<form action="/quiz/run_quiz" id="push-submit-form" method="post" class="col-4">
								<button type="submit" id="push-submit" style="border:none;" onclick="play()"><i class="fa fa-play"></i></button>
								{{csrf_field()}}
							</form>
						</div>
						<div class="col-4">
							<form action="/quiz/pause_quiz" method="post" class="col-4 push-submit-pause-form">
								<input type="hidden" name="quizId" value={{$quiz_id}}>
								<button type="submit" id="push-submit-pause" style="border:none;" onclick="pause()"><i class="fa fa-pause"></i></button>
								{{csrf_field()}}
							</form>
						</div>
						<div class="col-4">
							<form action="/quiz/stop_quiz" method="post" class="col-4 push-submit-stop-form">
								<input type="hidden" name="quizId" value={{$quiz_id}}>
								<button type="submit" id="push-submit-stop" style="border:none;" onclick="stop()"><i class="fa fa-stop"></i></button>
								{{csrf_field()}}
							</form>
						</div>
					</div>
				</div>

				<div class="dashboard__container mb-3 d-flex flex-grow-1 align-items-center flex-column">
					<h5>Actions</h5>
					<ul class="list-unstyled m-0 d-flex flex-column align-items-center">
						<li><a href="#">Issue Question</a></li>
						<li><a href="#">Edit Question</a></li>
						<li><a href="#">Share Answer</a></li>
						<li class="p-0"><a href="#">Next Question</a></li>
					</ul>
				</div>
			</aside>
			<div class="col-lg-9 order-0 order-md-1">
				<div class="row">
					<div class="col">


						<div class="quiz__slider">
						
							@foreach($rounds as $round)
							 @foreach($questions[$round->id] as $question)
							<div class="quiz__single_question__container d-flex flex-column align-items-center">
								<h4>Question</h4>
								<div class="quiz__single_question__image">
									<img src="../images/mozambique__flag.png">
								</div>
								<div class="quiz__single_question__qa text-center w-100">

								
									<p class="question"><span>Question:</span><span>{{$question->question}}</span></p>
									<input type="hidden" class="question-timer" value="{{$question->time_limit}}">
									<input type="hidden" class="question-type" value="{{$question->question_type}}">
									<input type="hidden" class="question-round" value="{{$question->round_id}}">
									<input type="hidden" class="question-user" value="{{$question->user_id}}">
									<input type="hidden" class="question-id" value="{{$question->id}}">
									<input type="hidden" class="quiz-id" value="{{$quiz_id}}">

									@foreach($medias[$question->id] as $media)
									<input type="hidden" class="question-media-type" value="{{$media->media_type}}">
									<input type="hidden" class="question-media-path" value="{{$media->public_path}}">
									<input type="hidden" class="question-media-ink" value="{{$media->media_link}}">

									@endforeach

									@foreach($answers[$question->id] as $answer)
									<p class="answer"><span>Answer:</span><span>{{$answer->answer}}</span></p>
									<input type="hidden" class="answer-id" value="{{$answer->id}}">

									@endforeach
								</div>
							</div>
							@endforeach
							@endforeach
                          
						</div>

					</div>
				</div>



			</div>

		</div>

		<div class="row">
			<aside class="col-lg-3 dashboard__sidebar d-flex flex-column order-1 order-md-0">
				<div class="dashboard__container mt-2 p-0 d-flex flex-grow-1">
					<table class="table table-striped table-borderless mb-0">
						<thead>
							<tr>
								<th>Leaderboard</th>
								<th>Pts</th>
							</tr>
						</thead>
						<tbody >
							<tr>
								<td>SenanCronin2020</td>
								<td>100</td>
							</tr>
							<tr>
								<td>SenanCronin2020</td>
								<td>100</td>
							</tr>
							<tr>
								<td>SenanCronin2020</td>
								<td>100</td>
							</tr>
							<tr>
								<td>SenanCronin2020</td>
								<td>100</td>
							</tr>

						</tbody>

					</table>

				</div>
			</aside>
			<section class="col-lg-9 order-0 order-md-1">

				<div class="row quiz__answers mt-2 no-gutters">
					<div class="col dashboard__container">
						<table class="table table-borderless table-striped quiz__answers__table">
							<thead>
								<tr>
									<th class="pb-0">User</th>
									<th class="pb-0">Answers</th>
									<th class="pb-0" colspan=2>Marking:</th>
								</tr>
								<tr>
									<th></th>
									<th></th>
									<th class="py-0 text-muted">
										<small>Correct</small>
									</th>
									<th class="py-0 text-muted">
										<small>Incorrect</small>
									</th>
								</tr>
							</thead>
							<tbody id="all-answer">
								
							</tbody>

						</table>
						<div class="row align-items-center text-white justify-content-center">
							<div class="col-9 col-md-4">
								<a class="d-block btn btn-primary">Save answers</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

	</div>
</section>


@endsection

@section('footer_scripts')
@include('scripts.push-submit')
@endsection