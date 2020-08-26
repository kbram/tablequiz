@extends('layouts.tablequizapp')

@section('content')
<section class="container page__inner dashboard">
	<div class="row dashboard__wrapper">
		
		<aside class="col-lg-3 dashboard__sidebar d-flex flex-column">
			<h2>Menu</h2>
			<div class="dashboard__container flex-grow-1 d-flex flex-column justify-content-between">
				
				<ul class="list-unstyled m-0 p-0 text-sm-center text-lg-left">
					<li>
						<a href="../admin/home">
							<span><i class="fas fa-home"></i></span>
							Overview
						</a>
					</li>
					<li class="active">
						<a href="../admin/quizzes">
							<span><i class="fas fa-briefcase"></i></span>
							Quizzes
						</a>
					</li>
					<li>
						<a href="../admin/users">
							<span><i class="fas fa-users"></i></span>
							Users
						</a>
					</li>
					<li>
						<a href="../admin/financials">
							<span><i class="fas fa-coins"></i></span>
							Financials
						</a>
					</li>
					<li>
						<a href="../admin/categories">
							<span><i class="fas fa-th-large"></i></span>
							Categories
						</a>
					</li>
					<li>
						<a href="../admin/categories">
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
					<div class="row">
						<div class="col-lg-9">
							<h2>Latest Quizzes</h2>
						</div>
						<div class="col-lg-3">
							<form action="" method="" class="p-0">
								<input type="text" list="quizzes" name="quiz" placeholder="Search..." class="form-control mb-2">
							</form>
						</div>
					</div>
					<div class="dashboard__container flex-grow-1 p-0">
						<table class="table table-striped table-borderless m-0 h-100 my__quizzes">
							<thead>
								<tr>
									<th>Quiz name <span><small><i class="fa fa-angle-down"></i></small></span</th>
									<th>Created by <span><small><i class="fa fa-angle-down"></i></small></span</th>
									<th>Rounds <span><small><i class="fa fa-angle-down"></i></small></span</th>
									<th class="text-center">Questions <span><small><i class="fa fa-angle-down"></i></small></span</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								
							@foreach($quizzes as $quiz)						
								<tr>
									<td>{{ $quiz->quiz__name }}</td>
									<td>{{ $user[$quiz->id]}}</td>
									<td class="text-lg-center">{{$roundCount[$quiz->id]}}</td>
									<td class="text-lg-center">{{$questionCounts[$quiz->id]}}</td>
									<td class="quiz_actions d-flex flex-row justify-content-lg-center">
										<div class="d-flex flex-column pl-0">
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
									</td>
								</tr>
								@endforeach
								
								
							</tbody>
							<tfoot>
								<tr>
									<td colspan="6" class="text-center text-muted">
										<a href="../dashboard/my-quizzes.php"><small>View all</small></a>
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

@endsection