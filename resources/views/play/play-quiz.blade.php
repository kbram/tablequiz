@extends('layouts.tablequizapp')

@section('template_linked_css')

<style>
.small{
	color:#5A37BA;
}
</style>

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
						<p class=" justify-content-center d-flex align-items-center m-0">Time remaining: <strong class="pl-2">28</strong></p>
					</div>
				</div>
			</div>
			<div class="row question__container">
				<div class="col-12 media__container p-0 mb-5">
					<img src="../images/suir.jpg" >
				</div>
				<div class="col-12 text-center">
					<h4 class="bernhard">Question {{$question->id}}</h4>
				</div>
				<div class="col-12 the__question text-center mB-2">
					<h4 class="" style="min-width:38vw !important;"> {{$question->question}} </h4>
				</div>
			</div>


@if($question->question_type == 'standard__question')
			<div id="all-answer" class="row answer__options pt-4 justify-content-center flex-wrap">

			@foreach($answers as $answer)

			 <form action="/playquiz/answer" method="post" name="form" id="disable" class="col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers ">

				@csrf
				<input type="text" name="answer" hidden value="{{$answer->id}}"/>
				<input type="text" name="question" hidden value="{{$question->id}}"/>
				<input type="text" name="round" hidden value="{{$round->id}}"/>
				<input type="text" name="quiz" hidden value="{{$quiz->id}}"/>

				<p>{{$answer->answer}}</p> 

				</form>
				@endforeach

				
			</div>
@endif



	
@if($question->question_type == 'standard__question')
			<div id="all-answer" class="row answer__options pt-4 justify-content-center flex-wrap">

			
			<form action="/playquiz/answer" method="post" name="form" id="answer" class="col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers ">

				@csrf
				<input type="text" name="question" hidden value="{{$question->id}}"/>
				<input type="text" name="round" hidden value="{{$round->id}}"/>
				<input type="text" name="quiz" hidden value="{{$quiz->id}}"/>

				<input class="form-control form-control-lg" type="text" name="answer" placeholder="Enter Answer"  value=""/>

				</form>

				
			</div>
@endif

@if($question->question_type == 'standard__question')
			<div id="all-answer" class="row answer__options pt-4 justify-content-center flex-wrap">

			
			<form action="/playquiz/answer" method="post" name="form" id="answer" class="col-md-3 single__answer bg-white  mb-md-3 px-3 py-4 text-center mx-2 answers ">

				@csrf
				<input type="text" name="question" hidden value="{{$question->id}}"/>
				<input type="text" name="round" hidden value="{{$round->id}}"/>
				<input type="text" name="quiz" hidden value="{{$quiz->id}}"/>

				<input class="form-control form-control-lg" type="number" name="answer" placeholder="Enter Answer"  value=""/>

				</form>

				
			</div>
@endif
<br>
<div class="justify-content-center row">
<div class="col-5">
<a   class="btn btn-primary d-block d-lg-inline-block card__from__modal" onclick="document.getElementById('answer').submit()">Submit Answer</a>
</div> 
</div>
	
		</article>
		
	</div>
<!-- </section> -->
<!-- 
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

</script> -->
<!-- 
<script>


$(function() {
    $('.single__answer').click(function() {
		$(this).attr('id', 'answer');
		console.log("change");
    });
});
</script> -->

@include('scripts.playquiz')

@endsection
@section('footer_scripts')
@endsection



