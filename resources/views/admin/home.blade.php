@extends('layouts.tablequizapp')

@section('content')
<section class="container page__inner dashboard">
	<div class="row dashboard__wrapper">

		<aside class="col-lg-3 dashboard__sidebar d-flex flex-column">
			<h2>Menu</h2>
			<div class="dashboard__container flex-grow-1 d-flex flex-column justify-content-between">

				<ul class="list-unstyled m-0 p-0 text-sm-center text-lg-left">
					<li class="active">
						<a href="#">
							<span><i class="fas fa-home"></i></span>
							Overview
						</a>
					</li>
					<li>
						<a href="/admin/quizzes">
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
				<a href="../quiz/setup" class="btn btn-primary hasPlus d-block">New Quiz</a>
			</div>
		</aside>

		<section class="col-lg-9 dashboard__content">
			<div class="row">
				<div class="col-12">
					<h2>Latest Stats</h2>
				</div>
				<div class="col-4 px-2">
					<div class="dashboard__container row align-items-center no-gutters">
						<div class="col-lg-5 justify-content-center justify-content-lg-start d-flex">
							<span class="admin_home__icon">
								<i class="fas fa-question-circle"></i>
							</span>
						</div>
						<div class="col-lg-7 d-flex flex-column admin_home__details justify-content-center justify-content-md-start">
							<p class="number mb-0 mb-lg-3 d-flex justify-content-center justify-content-lg-start"><strong>{{$cquzzes}}</strong></p>
							<p class="d-flex justify-content-center justify-content-lg-start text-center text-lg-left">Quizzes created</p>
						</div>
					</div>
				</div>

				<div class="col-4 px-2">
					<div class="dashboard__container row align-items-center no-gutters">
						<div class="col-lg-5 justify-content-center justify-content-lg-start d-flex">
							<span class="admin_home__icon">
								<i class="fas fa-user-friends"></i>
							</span>
						</div>
						<div class="col-lg-7 d-flex flex-column admin_home__details justify-content-center justify-content-md-start">
							<p class="number mb-0 mb-lg-3 d-flex justify-content-center justify-content-lg-start"><strong>{{$cusers}}</strong></p>
							<p class="d-flex justify-content-center justify-content-lg-start text-center text-lg-left">Users registered</p>
						</div>
					</div>
				</div>
				<div class="col-4 px-2">
					<div class="dashboard__container row align-items-center no-gutters">
						<div class="col-lg-5 justify-content-center justify-content-lg-start d-flex">
							<span class="admin_home__icon">
								<i class="fas fa-coins"></i>
							</span>
						</div>
						<div class="col-lg-7 d-flex flex-column admin_home__details justify-content-center justify-content-md-start">
							<p class="number mb-0 mb-lg-3 d-flex justify-content-center justify-content-lg-start"><strong>€0.04</strong></p>
							<p class="d-flex justify-content-center justify-content-lg-start text-center text-lg-left">Money earned</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-12">
					<h2>Latest Quizzes</h2>
					<div class="dashboard__container flex-grow-1 p-0">
						<table class="table table-striped table-borderless m-0 h-100 my__quizzes">
							<thead>
								<tr>
									<th>Quiz name</th>
									<th>Quiz link</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>

								@foreach($quizzes as $quiz)

								@if ($quiz->is_blocked)
								<tr>
									<td>{{$quiz -> quiz_name}}</td>
									<td id="quizLink{{$quiz -> id}}">{{$quiz -> quiz_link}}</td>
									<td class="quiz_actions db d-flex flex-row justify-content-lg-center">
										<div class="d-flex flex-column"  style=" pointer-events: none;opacity: 0.4;">
											<i class="far fa-eye"></i>
											<a href="/admin/home/view/{{$quiz->id}}"><span class="view-qz" id="view-qz{{$quiz->id}}">View Qs</span></a>
										</div>
										<div class="d-flex flex-column "  style=" pointer-events: none;opacity: 0.4;">
											<i class="fas fa-share-alt"></i><span class="share" id="{{$quiz->id}}">Share</span>

										</div>
									
										<form method="POST" action="/admin/home/un-block/{{$quiz->id}}" class="p-0">
										      @csrf
											<div class="d-flex flex-column" >
												<i class="fas fa-times-circle"></i>
												<span class="block" id="block{{$quiz->id}}">un-block</span>
											</div>
										</form>
									
										<div class="d-flex flex-column"  style=" pointer-events: none;opacity: 0.4;">
											<i class="fas fa-envelope"></i><span>Message</span>

										</div>
									</td>
								</tr>
								@else
								<tr>
									<td>{{$quiz->quiz_name}}</td>
									<td id="quizLink{{$quiz -> id}}">{{$quiz -> quiz_link}}</td>
									<td class="quiz_actions db d-flex flex-row justify-content-lg-center">
										<div class="d-flex flex-column">
											<i class="far fa-eye"></i>
											<a href="/admin/home/view/{{$quiz->id}}"><span class="view-qz" id="view-qz{{$quiz->id}}">View Qs</span></a>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i><span class="share" id="{{$quiz->id}}">Share</span>

										</div>
									
										<form method="POST" action="/admin/home/block/{{$quiz->id}}" class="p-0">
										             @csrf
											<div class="d-flex flex-column">
												<i class="fas fa-times-circle"></i>
												<span class="block" id="block{{$quiz->id}}">block</span>
											</div>
										</form>
									
										<div class="d-flex flex-column">
											<i class="fas fa-envelope"></i><span>Message</span>

										</div>
									</td>
								</tr>
								@endif
								@endforeach
								<!-- <tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>SenanCronin2020</td>
									<td class="quiz_actions db d-flex flex-row justify-content-lg-center">
										<div class="d-flex flex-column">
											<i class="far fa-eye"></i>
											<span>View Qs</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-times-circle"></i>
											<span>Block</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-envelope"></i>
											<span>Message</span>
										</div>
									</td>
								</tr>
								
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>SenanCronin2020</td>
									<td class="quiz_actions db d-flex flex-row justify-content-lg-center">
										<div class="d-flex flex-column">
											<i class="far fa-eye"></i>
											<span>View Qs</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-times-circle"></i>
											<span>Block</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-envelope"></i>
											<span>Message</span>
										</div>
									</td>
								</tr>
								
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>SenanCronin2020</td>
									<td class="quiz_actions db d-flex flex-row justify-content-lg-center">
										<div class="d-flex flex-column">
											<i class="far fa-eye"></i>
											<span>View Qs</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-times-circle"></i>
											<span>Block</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-envelope"></i>
											<span>Message</span>
										</div>
									</td>
								</tr>
								
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>SenanCronin2020</td>
									<td class="quiz_actions db d-flex flex-row justify-content-lg-center">
										<div class="d-flex flex-column">
											<i class="far fa-eye"></i>
											<span>View Qs</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-times-circle"></i>
											<span>Block</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-envelope"></i>
											<span>Message</span>
										</div>
									</td>
								</tr>
								
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>SenanCronin2020</td>
									<td class="quiz_actions db d-flex flex-row justify-content-lg-center">
										<div class="d-flex flex-column">
											<i class="far fa-eye"></i>
											<span>View Qs</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-times-circle"></i>
											<span>Block</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-envelope"></i>
											<span>Message</span>
										</div>
									</td>
								</tr>
								
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>SenanCronin2020</td>
									<td class="quiz_actions db d-flex flex-row justify-content-lg-center">
										<div class="d-flex flex-column">
											<i class="far fa-eye"></i>
											<span>View Qs</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-times-circle"></i>
											<span>Block</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-envelope"></i>
											<span>Message</span>
										</div>
									</td>
								</tr> -->



							</tbody>
							<tfoot>
								<tr>
									<td colspan="4" class="text-right text-muted">
										<a href="../admin/quizzes"><small>View all</small></a>
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
@include('scripts.message')
@include('scripts.block-quiz')
@endsection