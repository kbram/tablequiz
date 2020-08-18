@extends('layouts.tablequizapp')

@section('content')
<section class="container page__inner dashboard">
	<div class="row dashboard__wrapper">
		
		<aside class="col-lg-3 dashboard__sidebar d-flex flex-column">
			<h2>Menu</h2>
			<div class="dashboard__container flex-grow-1 d-flex flex-column justify-content-between">
				
				<ul class="list-unstyled m-0 p-0 text-sm-center text-lg-left">
					<li>
						<a href="/admin/home">
							<span><i class="fas fa-home"></i></span>
							Overview
						</a>
					</li>
					<li class="active">
						<a href="#">
							<span><i class="fas fa-briefcase"></i></span>
							Quizzes
						</a>
					</li>
					<li>
						<a href="/admin/users">
							<span><i class="fas fa-users"></i></span>
							Users
						</a>
					</li>
					<li>
						<a href="/admin/financials">
							<span><i class="fas fa-coins"></i></span>
							Financials
						</a>
					</li>
					<li>
						<a href="/admin/categories">
							<span><i class="fas fa-th-large"></i></span>
							Categories
						</a>
					</li>
					<li>
						<a href="/admin/categories">
							<span><i class="fas fa-question-circle"></i></span>
							Questions
						</a>
					</li>
					
				</ul>
				<a href="/quiz/setup" class="btn btn-primary hasPlus d-block">New Quiz</a>
			</div>
		</aside>
		
		<section class="col-lg-9 dashboard__content">
			<div class="row">
				<div class="col-12">
					<div class="row">
						<div class="col-lg-9">
							<h2>Latest Quizzes</h2>
						</div>
						<div class="col-lg-3 d-flex">
							@if(config('usersmanagement.enableSearchUsers'))
								@include('partials.search-quizzes-form')
							@endif
						</div>
						
					</div>
					<div class="dashboard__container flex-grow-1 p-0">
						<table class="table table-striped table-borderless m-0 h-100 my__quizzes">
							<thead>
								<tr>
									<th>Quiz name <span><small><i class="fa fa-angle-down"></i></small></span</th>
									<th>Quiz Link <span><small><i class="fa fa-angle-down"></i></small></span</th>
									<th class="text-center">No Of Participants<span><small><i class="fa fa-angle-down"></i></small></span</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody id="quizzes_table">
								
							@foreach($quizzes as $quiz)
								<tr>
								
								<span id="msg{{$quiz->id}}" class="text-success" ></span>
									<td>{{$quiz -> quiz_name}}</td>
									<td id="quizLink{{$quiz->id}}">{{$quiz -> quiz_link}}</td>
									<td class="text-lg-center">{{$quiz->no_of_participants}}</td>
									<td class="quiz_actions d-flex flex-row justify-content-lg-center">
										<div class="d-flex flex-column pl-0">
											<i class="far fa-eye"></i>
											<a href=""><span>View Qs</span></a>
										</div>
										<div>
											<button class="btn p-0 d-flex flex-column btn-primary-outline share"  id="{{$quiz->id}}" ><i class="fas fa-share-alt"></i>Share
											</button>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-times-circle"></i>
											<span>Block</span>
										</div>
									</td>
									
								</tr>
								@endforeach
								
								
								
							</tbody>
							<tbody id="quizzes_table"></tbody>
							@if(config('usersmanagement.enableSearchUsers'))
								<tbody id="search_results"></tbody>
							@endif
							<tfoot>
								<tr>
									<td colspan="6" class="text-center text-muted">
										<a href="/dashboard/my-quizzes"><small>View all</small></a>
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
@if(config('usersmanagement.enableSearchUsers'))
        @include('scripts.search-quizzes')
@endif
@include('scripts.share-quiz')
@endsection