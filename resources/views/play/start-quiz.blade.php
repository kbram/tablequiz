@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col text-center">
			<img class="rounded-circle" src="../images/quiz_bg.jpg" style="width:200px;height:200px;object-fit: cover;">
		</div>
	</div>
	<div class="row mt-3">
		<div class="text-center col">
			<h2 class="bernhard">MadDog's Geography Quiz!</h2>
			<h4>6 rounds | 60 questions</h4>
		</div>	
	</div>
	<div class="row align-items-center justify-content-center mb-3">
		<div class="col-md-7 col-lg-4">
			<form action="play-quiz.php" method="post">
				<input class="form-control mb-2" placeholder="Enter quiz password" type="password" name="quiz__password">
				<input class="form-control mb-2" placeholder="Enter team name" name="quiz__team__password">
				<button class="btn btn-primary d-block">Ready!</button>
			</form>
		</div>
	</div>
	@endsection
@section('footer_scripts')
@endsection