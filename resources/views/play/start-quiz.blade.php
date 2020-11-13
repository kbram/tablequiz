@extends('layouts.tablequizapp')

<style>
.pel{
	color:red;
}
</style>
@section('content')


<section class="container page__inner">
	<div class="row">
		<div class="col text-center">
			<img class="rounded-circle" src="{{$image}}" style="width:200px;height:200px;object-fit: cover;">
		</div>
	</div>
	<div class="row ">
		<div class="text-center col">
			<h2 class="bernhard">{{$quiz->quiz__name}}</h2>
			<h4>{{$roundCount}} rounds | {{$questionCounts}} questions</h4>

		</div>	
	</div>

	<div class="row align-items-center justify-content-center ">
		<div class="col-md-7 col-lg-4">
			<form action="/playquiz/{{$quiz->id}}" method="post">
			@csrf
			@if($quiz->quiz_password)
				<input class="form-control mb-2" placeholder="Enter quiz password" type="password" name="quiz__password" >


				@if (Session::has('fail'))
                            <p class="pel">{{ Session::get('fail') }}</p>
                    @endif

				@endif
				<input class="form-control mb-2" placeholder="Enter team name" name="quiz__team" required>
				@if (Session::has('failteam'))
                            <p class="pel">{{ Session::get('failteam') }}</p>
                    @endif
				<input type="submit" value="Ready" class="btn btn-primary d-block"></input>
				

			</form>
		</div>
	</div>
</section>
@endsection

@section('footer_scripts')
@endsection