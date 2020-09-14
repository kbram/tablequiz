@extends('layouts.tablequizapp')



@section('content')



<section class="container page__inner dashboard">
	<div class="row dashboard__wrapper">
		
		<aside class="col-lg-3 dashboard__sidebar d-flex flex-column">
			<h2>Menu</h2>
			<div class="dashboard__container flex-grow-1 d-flex flex-column justify-content-between">
				
				<ul class="list-unstyled m-0 p-0 text-sm-center text-lg-left">
					<li class="active">
						<a href="">
							<span><i class="fas fa-home"></i></span>
							Overview
						</a>
					</li>
					<li>
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
			<div class="row">
				<div class="col-lg-8 d-flex flex-column latest__results__container">
					<h2>Latest results</h2>

					@if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

					


					<div class="dashboard__container flex-grow-1 p-0">
						<table class="table table-striped table-borderless latest__results m-0 h-100">
							<thead>
								<tr>
									<th>Quiz name</th>
									<th>Team name</th>
									<th>Position</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>MadDog's Geograph Quiz</td>
									<td>Quzzington F.c.</td>
									<td>11<sup>th</sup></td>
								</tr>
								
								<tr>
									<td>MadDog's Geograph Quiz</td>
									<td>Quzzington F.c.</td>
									<td>1<sup>st</sup>
										<span class="trophy first"><i class="fas fa-trophy"></i>
										</span>
									</td>
								</tr>
								
								<tr>
									<td>MadDog's Geograph Quiz</td>
									<td>Quzzington F.c.</td>
									<td>11<sup>th</sup></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="2"></td>
									<td class="text-right text-muted"><small><a href="#">View more</a></small></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="col-lg-4 d-flex flex-column">
					<h2>Latest stats</h2>
					<div class="dashboard__container flex-grow-1 p-0">
						<table class="table table-striped table-borderless m-0 latest__stats h-100">
							<tbody>
								<tr style="height:0!important"><td class="p-0"></td></tr>
								<tr>
									<td>Quizzes created:</td>
									<td>13</td>
								</tr>
								<tr>
									<td>Quizzes played:</td>
									<td>222</td>
								</tr>
								<tr>
									<td>Last position</td>
									<td>23<sup>rd</sup></td>
								</tr>
								<tr>
									<td>Money earned:</td>
									<td>€0.69</td>
								</tr>
								
							</tbody>
							<tfoot>
								<tr>
									<td>&nbsp;</td>
								</tr>
							</tfoot>
							
						</table>
						
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-12">
					<h2>My Quizzes</h2>




					<div class="dashboard__container flex-grow-1 p-0">
						<table class="table table-striped table-borderless m-0 h-100 my__quizzes">
							<thead>
								<tr>
									<th>Quiz name</th>
									<th>Questions</th>
									<th>Rounds</th>
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
									<td class="quiz_actions d-flex flex-row justify-content-lg-end">
										<a href="{{ URL::to('quizzes/'. $quiz->id .'/edit') }}">			
										<div class="d-flex flex-column pl-0 pl-md-4">
											<i class="fas fa-edit"></i>
											<span>Edit</span>
										</div></a>
							
									
									
							
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span class="share" id="{{$quiz->id}}">Share</span>
										</div>
										<a href="/quiz/start_quiz/{{$quiz->id}}">
											<div class="d-flex flex-column">
												<i class="fas fa-play"></i>
												<span>Start</span>
											</div>
										</a>
									</td>
								</tr>
								@endforeach
								
									
								
								
							</tbody>
							<tfoot>
								<tr>
									<td colspan="4" class="text-right text-muted">
										<a href="my-quizzes.php"><small>View all</small></a>
									</td>
								</tr>
							</tfoot>
						</table>
						
					</div>
				</div>
			</div>
		</section>
	</div>
</section>
@endsection
@section('footer_scripts')
@include('scripts.share-quiz')
@include('scripts.quiz-icon-preview')

@endsection

