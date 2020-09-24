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

@endsection
@section('content')

<!-- <section class="container page__inner"> -->

	<div class="row">

		<div class="col-12 d-flex justify-content-between">
			<p id="quizname" class="text-white" style="min-width:13vw !important;">{{$quiz->quiz__name}}</p>
			<p id="quizid"  style="display:none;">{{$quiz->id}}</p>
			<p><a href="#" class="text-white"><small>Exit quiz</small></a></p>
		</div>
		<article class="col-12 pb-5">

		<div class="col-12 d-flex justify-content-between">

		<p ><a href="#" class="text-white" id="pre" ><small class="small">previous quiz</small></a></p>
		<p><a href="#" class="text-white" id="next" ><small class="small">next quiz</small></a></p>

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
			
			<!-- question part apand -->

			<div id="ques" class='row question__container'>

			

			<div class='col-12 text-center'>
			<h4 class='bernhard notification'>Not submitted</h4>
			</div>
			<div  class='col-12 the__question text-center mB-2'>
			<h4 class='questionno' id='' style='min-width:50vw !important;'> Please wait for question ! </h4>
</div>
		</div>         


			<div id="all-answer" class="row answer__options pt-4 justify-content-center flex-wrap">
			



			</div>

		</article>
		<p id="demo"></p>
	</div>
<!-- </section> -->

<!-- <script>

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


	
</script> -->



@include('scripts.playquiz')

@endsection
@section('footer_scripts')
@include('scripts.timer')
@endsection



