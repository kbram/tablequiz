@extends('layouts.tablequizapp')

@section('content')
<section class="container page__inner dashboard">
	<div class="row dashboard__wrapper">
		
		<aside class="col-lg-3 dashboard__sidebar d-flex flex-column">
			<h2>Menu</h2>
			<div class="dashboard__container flex-grow-1 d-flex flex-column justify-content-between">
				
				<ul class="list-unstyled m-0 p-0 text-sm-center text-lg-left">
					<li>
						<a href="/dashboard/home">
							<span><i class="fas fa-home"></i></span>
							Overview
						</a>
					</li>
					<li class="active">
						<a href="/dashboard/my-quizzes">
							<span><i class="fas fa-briefcase"></i></span>
							My Quizzes
						</a>
					</li>
					<li>
						<a href="/dashboard/settings">
							<span><i class="fas fa-cog"></i></span>
							Settings
						</a>
					</li>
				</ul>
				<a href="/setup/create" class="btn btn-primary hasPlus d-block">New Quiz</a>
			</div>
		</aside>
		
		<section class="col-lg-9 dashboard__content">
			<div class="row h-100">
				<div class="col-12 d-flex flex-column">
					<h2>My Quizzes</h2>
					<div class="dashboard__container flex-grow-1 p-0">
						<table class="table table-striped table-borderless m-0 h-100 my__quizzes">
							<thead>
								<tr>
									<th>Quiz name</th>
									<th>Rounds</th>
									<th>Questions</th>
									<th class="d-none">Quiz Link</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody id="users">
							@foreach($quizzes as $quiz)

							<tr>
                                    
									 <td>{{$quiz->quiz__name}}</td>
									 <td>{{$roundCount[$quiz->id]}}</td>
 									 <td>{{$questionCounts[$quiz->id]}}</td>
									  <td class="d-none" id="quizLink{{$quiz->id}}">{{$quiz ->quiz_link}}</td>
 
									<td class="quiz_actions d-flex flex-row justify-content-lg-center">
										<a href="quizzes/{{$quiz->id}}/edit">			
										<div class="d-flex flex-column pl-0 pl-md-4">
											<i class="fas fa-edit"></i>
											<span>Edit</span>
										</div></a>
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span class="share" id="{{$quiz->id}}">Share</span>
										</div>
										<a href="/quiz/start_quiz">
											<div class="d-flex flex-column">
												<i class="fas fa-play"></i>
												<span>Start</span>
											</div>
										</a>
										</td>
										@endforeach
								</tr>
								
						</table>
						
					</div>
					</div>
			</div>
		</section>
	</div>
</section>
<style>
.row dashboard__wrapper{
	margin-bottom:50px;
}
</style>
@endsection
@section('footer_scripts')
@include('scripts.share-quiz')
@endsection

