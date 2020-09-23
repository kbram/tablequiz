@extends('layouts.tablequizapp')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

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
				<h5>Que No:<span id="que" class="question_number2"></span></h5> 
					<h5>Countdown timer</h5>
					<p class="countdown__time " id="timer" style="font-size:300%;"></p>
					<div class="countdown__buttons row">
						<div class="col-4">
							<form action="/quiz/run_quiz" id="push-submit-form" method="post" class="col-4 pt-2">
								<button type="submit" id="push-submit" style="border:none;" onclick="play()"><i class="fa fa-play"></i></button>
								{{csrf_field()}}
							</form>
						</div>
						<div class="col-4">
							<form action="/quiz/pause_quiz" method="post" class="col-4 push-submit-pause-form pt-2">
								<input type="hidden" name="quizId" value={{$quiz_id}}>
								<button type="submit" id="push-submit-pause" style="border:none;" onclick="pause()"><i class="fa fa-pause"></i></button>
								{{csrf_field()}}
							</form>
						</div>
						<div class="col-4">
							<form action="/quiz/stop_quiz" method="post" class="col-4 push-submit-stop-form pt-2">
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
						<li><a href="#" id="issue">Issue Question</a></li>
						<li><a href="#" id="edit_question">Edit Question</a></li>
						<li><a href="#">Share Answer</a></li>
						<li class="p-0"><a href="#">Next Question</a></li>
					</ul>
				</div>
			</aside>
			<div class="col-lg-9 order-0 order-md-1">
				<div class="row">
					<div class="col">


						<div class="quiz__slider">
						@php
						$i=1
						@endphp

							@foreach($rounds as $round)
							 @foreach($questions[$round->id] as $question)
							<div class="quiz__single_question__container d-flex flex-column align-items-center">
								<h4>Question No: <span class="question_number">{{$i++}}</span></h4>
								<p style="text-align:right;float:right; margin-right:0px;" align="right" >Time  :  {{isset($question->time_limit)? $question->time_limit.' sec' : 'Not set' }}</p>	
								@if (count($medias[$question->id])>0) 

<div class="quiz__single_question__image">

@foreach($medias[$question->id] as $media)
@if($media->media_type == 'image')

	<img src="{{asset($media->public_path)}}" height='250px'>
@endif
@if($media->media_type == 'audio')
<audio controls>
	<source src="{{asset($media->public_path)}}" type="audio/mpeg">
</audio>
@endif
@if($media->media_type == 'video')

<video controls>
	<source src="{{asset($media->public_path)}}" type="video/mp4">
</video>
@endif
@endforeach

</div>

@else

							
								<div class="quiz__single_question__image">
									<img src="{{asset('site_design/images/homepage__logo.png')}}" height='170px'>
								</div>

								@endif
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
						@foreach($teams as $team)
							<tr>
								<td>{{$team}}</td>
								<td>{{$points[$team]}}</td>
							</tr>
						@endforeach
						</tbody>

					</table>

				</div>
			</aside>
			<section class="col-lg-9 order-0 order-md-1">

				<div class="row quiz__answers mt-2 no-gutters">
					<div class="col dashboard__container">
						<div class="table table-borderless table-striped quiz__answers__table">
							<!-- <thead>
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
							</thead> -->

							<div class="row container align-items-center justify-content-center">
								<div class="col-md-4 pb-0 text-center"><strong>User</strong></div>
								<div class="col-md-4 pb-0 text-center"><strong>Answers</strong></div>

								<div class="col-md-4 pb-0 text-center pt-3"><strong>Marking</strong>

									<div class="row d-flex">
											<div class="col-md-6 py-0 text-muted text-center"><small>Correct</small></div>
											<div class="col-md-6 py-0 text-muted text-center"><small>Incorrect</small></div>
								    </div>

								</div>
							</div>
							<form id="answer_submit_form"  class="pt-0">


						<div id="all-answer_submit">

								

							

						</div>

<br>
						<div class="row align-items-center text-white justify-content-center">
							<div class="col-9 col-md-4">
								<a id="save_answer_button" class="d-block btn btn-primary">Save answers</a>
							</div>
						</div>
						</form>

					</div>
				</div>
			</section>
		</div>

	</div>
</section>

<script>
	var time=JSON.parse(sessionStorage.getItem("nowtimeon"));
	
    var timeon=0;
	var p=JSON.parse(sessionStorage.getItem("play"));
	
	var pl= true;
	if(p==null){
		pl= false;
	}else{
		pl=p;
	}
	
	
	var bavarcount;
	$(document).ready(function(){
		$('#issue').click(function(e){
			$("#issue").css("pointer-events", "none");
			$('#issue').css('opacity','0.4');
			$('#timer').removeClass("countdown__time");
			$('#que').removeClass("question_number2");
			play();
		});
		if(time!=null){
			
			
			$("#push-submit-pause").css("pointer-events", "auto");
			$('#push-submit-pause').css('opacity','1');
			$("#push-submit-stop").css("pointer-events", "auto");
			$('#push-submit-stop').css('opacity','1');
			$("#push-submit").css("pointer-events", "none");
			$('#push-submit').css('opacity','0.4');
			
			//pl=false;
			var splity=time.split(":");
			timeon=parseInt(splity[0])*60+parseInt(splity[1]);
			//alert(timeon);
			var y=timeon;
			
			if(pl==true){
				clearInterval(bavarcount);
				$('#timer').removeClass("countdown__time");
				$('#que').removeClass("question_number2");
				$('#timer').html(time);
				//alert(time);
				$("#push-submit-pause").css("pointer-events", "none");
				$('#push-submit-pause').css('opacity','0.4');
				
				$("#push-submit").css("pointer-events", "auto");
				$('#push-submit').css('opacity','1');
				
			}else{
				
			var sec= y,
			countDiv    = document.getElementById("b"),
			secpass;
			bavarcount   = setInterval(function () {
				'use strict';
				secpass1();
			}, 1000);

			function secpass1() {
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
				sessionStorage.setItem("nowtimeon", JSON.stringify(min + ":" + remSec));
				
				if (sec > 0) {
					
					sec = sec - 1;
					
				} else {
					
					clearInterval(bavarcount);
					$("#timer").html("Finished");
					sessionStorage.setItem("nowtimeon", null);
					sessionStorage.setItem("play", true);
					
					//$("#resub").css("display", "none");
					//tyle="opacity: 0.4;
					//
					$("#push-submit").css("pointer-events", "none");
					$('#push-submit').css('opacity','0.4');

					$('#resub').css('cursor','not-allowed');
					$("#resub").css("pointer-events", "none");
					$('#resub').css('opacity','0.4');

					$("#push-submit-pause").css("pointer-events", "none");
					$('#push-submit-pause').css('opacity','0.4');
					$("#push-submit-stop").css("pointer-events", "none");
					$('#push-submit-stop').css('opacity','0.4');
					$("#issue").css("pointer-events", "auto");
					$('#issue').css('opacity','1');
					$('#timer').addClass("countdown__time");
					$('#que').addClass("question_number2");
				}
			}
			}
		}else{
				
				$("#push-submit").css("pointer-events", "none");
				$('#push-submit').css('opacity','0.4');
				$("#push-submit-pause").css("pointer-events", "none");
				$('#push-submit-pause').css('opacity','0.4');
				$("#push-submit-stop").css("pointer-events", "none");
				$('#push-submit-stop').css('opacity','0.4');
			
		}
	});	
	// Enable pusher logging - don't include this in production
	
	Pusher.logToConsole = false;

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
//console.log(m);
var status = m[2];
//console.log(status);
 

var id_correct = m[0]+"1";
var id_wrong = m[0]+"0";

//console.log(status);

		// var text="<tr><td>"+m[0]+"</td><td>"+m[1]+"</td><td><form><input type='radio' id="+id_correct+" name='correct_answer_1' value='correct'><input type='radio' name='correct_answer_1' id="+id_wrong+" value='incorrect'></form></td><td></td></form></tr>";
		
		var text = "<hr> <div class='row container h-25 align-items-center justify-content-center'> <p class='col-md-4 pb-0 text-center'>"+m[0]+"</p> <input  type='text' name='team[]' hidden class='col-md-4 pb-0 text-center' value="+m[0]+"><input  type='text' name='quiz/"+m[0]+"' hidden class='col-md-4 pb-0 text-center' value="+m[4]+"><input  type='text' name='round/"+m[0]+"' hidden class='col-md-4 pb-0 text-center' value="+m[6]+"><input  type='text' name='question/"+m[0]+"' hidden class='col-md-4 pb-0 text-center' value="+m[5]+"> <p class='col-md-4 pb-0 text-center'>"+m[1]+"</p> <div class='col-md-4 pb-0 text-center '> <div class='row d-flex'> <input type='radio' id="+id_correct+" name='status/"+m[0]+"' value=1 class='col-md-6 py-0 text-muted text-center'> <input type='radio' name='status/"+m[0]+"' id="+id_wrong+" value=0 class='col-md-6 py-0 text-muted text-center'> </div> </div> </div>"
		// var id =$('.question-id').val();
		var id;
$('.quiz__slider .quiz__single_question__container').each(function(){
			var current=$(this);
		var hidden=current.attr('aria-hidden');
         if(hidden=="false"){
			id =current.find('.question-id').val(); 
		 }
		 

});
if(id == m[5]){
		$(text).appendTo($("#all-answer_submit"));
	}

if(status){
		if(Number(status) == 1){
$('#'+id_correct).prop("checked", true);
			//console.log("correct");
		}
		else if(Number(status) == 0){
			$('#'+id_wrong).prop("checked", true);

			//console.log("not correct");
		}
	}
		
		//$('#all-answer tbody').append(text);
	});
	//var x=1;
	
	
	function pause() {
		if(pusher.connection.state=="connected"){
			clearInterval(bavarcount);
			//sessionStorage.setItem("play", true);
			$("#push-submit").css("pointer-events", "auto");
			$('#push-submit').css('opacity','1');
			$("#push-submit-pause").css("pointer-events", "none");
			$('#push-submit-pause').css('opacity','0.4');
			//pl=true;
		}else{
			alert("Check your connection...!",'Please check your internet connection')
		}
	}

	function stop() {
		if(pusher.connection.state=="connected"){
			clearInterval(bavarcount);
			//sessionStorage.setItem("play", true);
			
			//sessionStorage.setItem("nowtimeon", null));
			$('#timer').addClass("countdown__time");
			$('#que').addClass("question_number2");
			$("#push-submit").css("pointer-events", "none");
			$('#push-submit').css('opacity','0.4');
			$("#push-submit-pause").css("pointer-events", "none");
			$('#push-submit-pause').css('opacity','0.4');
			$("#push-submit-stop").css("pointer-events", "none");
			$('#push-submit-stop').css('opacity','0.4');
			$("#issue").css("pointer-events", "auto");
			$('#issue').css('opacity','1');
			//$("#timer").html(sessionStorage.getItem("nowtimeon"));
			sessionStorage.setItem("nowtimeon", null);
			
			$("#timer").html("Stoped");
			swal("Question stoped!",'articipants can not submit..', "warning")
			//pl=true;
		}
		else{
			alert("Check your connection...!",'Please check your internet connection')
		}
	}

	
	function play() {
		if(pusher.connection.state=="connected"){
			
			$("#push-submit-pause").css("pointer-events", "auto");
			$('#push-submit-pause').css('opacity','1');
			$("#push-submit-stop").css("pointer-events", "auto");
			$('#push-submit-stop').css('opacity','1');
			$("#push-submit").css("pointer-events", "none");
			$('#push-submit').css('opacity','0.4');
			sessionStorage.setItem("play", false);
			//pl=false;
			
			y=document.getElementById("timer").textContent;
			//alert(y);
			var x=document.getElementById("timer").textContent;
			var splity=y.split(":");
			y=parseInt(splity[0])*60+parseInt(splity[1]);

			var sec= y,
			countDiv    = document.getElementById("timer"),
			secpass;
			bavarcount   = setInterval(function () {
				'use strict';
				secpass();
			}, 1000);
		}
		else{
			alert("Check your connection...!",'Please check your internet connection')
		}
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
				sessionStorage.setItem("nowtimeon", JSON.stringify(min + ":" + remSec));
				if (sec > 0) {
					
					sec = sec - 1;
					
				} else {
					
					clearInterval(bavarcount);
					sessionStorage.setItem("nowtimeon", null);
					sessionStorage.setItem("play", true);
					//var t =current.find('.question-timer').val();
					$("#issue").css("pointer-events", "auto");
					$('#issue').css('opacity','1');
					if(x!="00:00"){
						
						$("#timer").html("Finished");
						swal("Time finished!",'time of the question finished', "warning")
						$("#push-submit").css("pointer-events", "none");
						$('#push-submit').css('opacity','0.4');
						$("#push-submit-pause").css("pointer-events", "none");
						$('#push-submit-pause').css('opacity','0.4');
						$("#push-submit-stop").css("pointer-events", "none");
						$('#push-submit-stop').css('opacity','0.4');
						$('#timer').addClass("countdown__time");
						$('#que').addClass("question_number2");
					}else{
						$('#timer').removeClass("countdown__time");
						$('#que').removeClass("question_number2");
						$("#timer").html("Not set");
						$("#push-submit").css("pointer-events", "none");
						$('#push-submit').css('opacity','0.4');
						$("#push-submit-pause").css("pointer-events", "none");
						$('#push-submit-pause').css('opacity','0.4');
						$("#push-submit-stop").css("pointer-events", "auto");
						$('#push-submit-stop').css('opacity','1');
						$("#issue").css("pointer-events", "none");
						$('#issue').css('opacity','0.4');
					}
					
					//$("#resub").css("display", "none");
					//tyle="opacity: 0.4;
					//

					///$('#resub').css('cursor','not-allowed');
					//$("#resub").css("pointer-events", "none");
					//$('#resub').css('opacity','0.4');
					
					
					
				}
			}
		
	}
</script>




@endsection

@section('footer_scripts')
@include('scripts.push-submit')
@include('scripts.answer-save')
@include('scripts.result')
@endsection