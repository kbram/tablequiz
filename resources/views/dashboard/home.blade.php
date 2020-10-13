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
					<br>
					<br>
					<br>
					<br>


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

					@if (Session::has('fail'))
                        <div class="alert alert-danger text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('fail') }}</p>
                        </div>
                    @endif


					<div class="dashboard__container flex-grow-1 p-0">
						<table class="table table-striped table-borderless latest__results m-0 h-100">
							@if(!empty($lastQuiz))
								<thead>
									<tr>
										<th>Quiz name</th>
										<th>Team name</th>
										<th>Position</th>
									</tr>
								</thead>
								<tbody>
									@php $pos = ['st','nd','rd','th','th','th','th','th','th']; $x=1; @endphp
										@foreach($teamNames as $teamName)
										<tr>
											@foreach($quizzes as $quiz)
												@if($quiz->id==$lastQuiz->id)
													<td>{{$quiz->quiz__name}}</td>
												@endif
											@endforeach
											<td>{{$teamName->team_name}}</td>
											@if($x==1)
												<td>{{$x}}<sup>{{$pos[$x-1]}}</sup><span class="trophy first"><i class="fas fa-trophy"></i>
											</span></td>
											@else
												<td>{{$x}}<sup>{{$pos[$x-1]}}</sup></td>
											@endif
											@php $x=$x+1; @endphp
										</tr>
										@endforeach
									
								</tbody>

								<tfoot>
									<tr>
										<td colspan="2"></td>
										<td class="text-right text-muted"><small><a href="/dashboard/results">View more</a></small></td>
									</tr>
								</tfoot>
							@else
							<br>
							<br>
								<h4 class="pt-3 pl-3 text-center">No Result Found</h4>					
								<br><br>
							@endif	
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
									@if(!empty($quizzes))
									<td>{{$quizzes->count()}}</td>
									@else
									<td>0</td>
									@endif
								</tr>
								<tr>
									<td>Quizzes played:</td>
									@if(!empty($quizplayed))
									<td>{{$quizplayed}}</td>
									@else
									<td>0</td>
									@endif
								</tr>
								<tr>
									<td>Last position</td>
									@if(!empty($teamcount))
									<td>{{$teamcount}}<sup>{{$pos[$teamcount%10-1]}}</sup></td>
									@else

									<td>0</td>
									@endif
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
							
						
							<tbody id="users">
							@if(!empty($quizzes))
							<thead>
								<tr>
									<th>Quiz name</th>
									<th>Questions</th>
									<th>Rounds</th>
									<th class="d-none">Quiz Link</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							@foreach($quizzes as $quiz)

							<tr>
                                    
									 <td>{{$quiz->quiz__name}}</td>
									 <td>{{$questionCounts[$quiz->id]}}</td>
									 <td>{{$roundCount[$quiz->id]}}</td>
 									

									<td class="d-none" id="quizLink{{$quiz->id}}">{{$quiz ->quiz_link}}</td>
									<td class="quiz_actions d-flex flex-row justify-content-center">
										<a href="{{ URL::to('quizzes/'. $quiz->id .'/edit') }}">			
										<div class="d-flex flex-column pl-0 pl-md-4">
											<i class="fas fa-edit"></i>
											<span>Edit</span>
										</div></a>
							
									
									
							
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span class="share" id="{{$quiz->id}}">Share</span>
										</div>
										@if($quiz->payment==1)
										<a href="/quiz/start_quiz/{{$quiz->id}}">
											<div class="d-flex flex-column pl-3">
												<i class="fas fa-play"></i>
												<span>Start</span>
											</div>
										</a>
										@else 
										<a class="view-card"  id="{{$quiz->id}}">
											<div class="d-flex flex-column">
												<i class="fas fa-credit-card"></i>
												<span>Unpaid</span>
											</div>
										</a>
										@endif
									</td>
								</tr>
								@endforeach
							
									
								
								
							</tbody>
							@else
							<br>
							<br>

								<h4 class="pt-3 pl-3 text-center">No quizzes to show</h4>
								<!-- <img class="text-center" src="{{asset('site_design/images/homepage__logo.png')}}" height="100px"> -->

								
								<br><br>


							@endif	
							<tfoot>
								<tr>
									<td colspan="4" class="text-right text-muted">
										<br>
										@if(!empty($quizzes))
											<div  class="d-flex justify-content-center">{{$quizzes->links()}}</div>
											<a href="/dashboard/quizzes"><small>View all</small></a>
										@endif	
								
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

