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
@if(Session::has('teamname'))


	<div class="row">

		<div class="col-12 d-flex justify-content-between">
			<p id="quizname" class="text-white" style="min-width:13vw !important;">{{$quiz->quiz__name}}</p>
			<p id="quizid"  style="display:none;">{{$quiz->id}}</p>
			<p id="exit" ><a href="#" class="text-white"><small>Exit quiz</small></a></p>
		</div>
		<article class="col-12 pb-5">

		<div class="col-12 d-flex justify-content-between">

		<p ><a href="#" class="text-white" id="pre" ><small class="small">previous quiz</small></a></p>
		<p><a href="#" class="text-white" id="next" ><small class="small">next quiz</small></a></p>

		</div>   


			<div class="row border-bottom pb-2 mb-5">
				<div class="col-12 d-flex justify-content-center flex-column">
					<p class="mb-0 text-center"><strong>Round  of </strong></p>
					<p class="bernhard round__name my-2 text-center"></p>
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



@include('scripts.playquiz')

@else


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container page__inner">
            <div class="text-center col">
            <h1 class="bernhard ">OOPS !</h1>

            <img class="q-img mb-3" src="{{asset('site_design/images/homepage__logo.png')}}" height="300px">
            <h1 class="bernhard ">404</h1>

            <h1 class="bernhard ">PAGE NOT FOUND !</h1>

            <h1 class="bernhard "></h1>


        </div>

                <div class="modal-body ">
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@endif

@endsection
@section('footer_scripts')
@include('scripts.timer')
@endsection



