@extends('layouts.tablequizapp')

@section('content')



<div class="container-fluid d-flex flex-column p-0 no-gutters">
	<section class="container page__inner homepage p-0 d-flex align-items-center">
		<div class="row">
			<div class="col-md-6 d-flex order-1 justify-content-center flex-column mt-lg-0 mt-4">
				<h1 class="landing__page pb-3"><span>The easy-to-use</span> customisable<br>quizzing tool!</h1>	
				<div class="row pt-4 pr-lg-5">
					<div class="col-lg-6 mb-3 mb-lg-0">
						<a href="/setup/create/" class="btn btn-primary d-block">Create a quiz</a>
						
						
							@if(count($errors)>0)
								
								
						
								
								@if($errors->first('email')=="These credentials do not match our records.")
									<script>$(document).ready(function($) { $('#publishQuizModal').modal('show');});</script>
								
								@else
									<script>$(document).ready(function($) { $('#modal__login').addClass('d-none');$('#modal__signup').removeClass('d-none');$('#publishQuizModal').modal('show');});</script>
								
								@endif
								
						
						@endif

						<div></div>
					</div>
					<div class="col-lg-6">
						<a href="/play/start-quiz.php" class="btn btn-secondary d-block" data-toggle="modal" data-target="#join_a_quiz">Join a quiz</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 order-0 order-md-1">
				<img src="{{asset('site_design/images/homepage__logo.png')}}" class="homepage__logo" alt="TableQuiz.app logo">
			</div>

		</div>
	</section>

	<section class="homepage__white_section container-fluid">
		<div class="curve">
			{!! file_get_contents('site_design/images/curve.svg') !!}
		</div>
		<div class="container somepage__white_section__inner text-body">
			<div class="row align-items-center">
				<div class="col-lg-6">
					
					<img src="{{asset('site_design/images/homepage__lower.jpg')}}" class="homepage__lower">
				</div>
				<div class="col-lg-6 mt-5 mt-lg-0">
					<h1 class="my-5">Why use TableQuiz.app for your next quiz?</h1>
					<h3>How it works</h3>
					<ol class="mt-3 how-it-works__homepage mb-5">
						<li class="py-3">Create a quiz and add your questions &amp; answers</li>
						<li class="py-3">Copy and share your Quiz link with players</li>
						<li class="py-3">Run and play quizzes across any device</li>
					</ol>

					<a href="/setup/create/" class="d-block d-sm-inline btn btn-primary hasArrow mt-5">Get started</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Modal -->
	<div class="modal" id="join_a_quiz" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
		<div class="modal-content">
		  <div class="modal-header justify-content-center border-0">
			<h1 class="modal-title" id="">Enter quiz name</h1>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <form action="/startquiz" method="post">
		  @csrf
		  <div class="modal-body pt-4 pb-3">
			<div class="form-group row">
				<div class="col-4 d-flex align-items-center pr-3"><label class="d-block text-right m-0 text-body">TableQuiz.app/</label></div>
				<div class="col-8 d-flex align-items-center pr-5 pl-0"><input type="text" class="form-control" name="quiz_name"></div>
			</div>
		  </div>
		  <div class="modal-footer border-0 d-flex justify-content-center">
			  <div class="col-5">
				  <input type="submit" class="btn btn-primary d-block">Join now</input>
			  </div>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
</div>

@endsection

@section('footer_scripts')

@endsection