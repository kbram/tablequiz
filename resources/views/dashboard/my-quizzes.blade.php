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
						<a href="">
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
				<a href="../quiz/setup.php" class="btn btn-primary hasPlus d-block">New Quiz</a>
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
									<th>Questions</th>
									<th>Rounds</th>
									<th class="text-right">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>20</td>
									<td>4</td>
									<td class="quiz_actions d-flex flex-row justify-content-lg-end">
										<div class="d-flex flex-column pl-0 pl-md-4">
											<i class="fas fa-edit"></i>
											<span>Edit</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										<a href="../quiz/start-quiz.php">
											<div class="d-flex flex-column">
												<i class="fas fa-play"></i>
												<span>Start</span>
											</div>
										</a>
									</td>
								</tr>
								
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>20</td>
									<td>4</td>
									<td class="quiz_actions d-flex flex-row justify-content-lg-end">
										<div class="d-flex flex-column pl-0 pl-md-4">
											<i class="fas fa-edit"></i>
											<span>Edit</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										<a href="../quiz/start-quiz.php">
											<div class="d-flex flex-column">
												<i class="fas fa-play"></i>
												<span>Start</span>
											</div>
										</a>
									</td>
								</tr>
								
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>20</td>
									<td>4</td>
									<td class="quiz_actions d-flex flex-row justify-content-lg-end">
										<div class="d-flex flex-column pl-0 pl-md-4">
											<i class="fas fa-edit"></i>
											<span>Edit</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										<a href="../quiz/start-quiz.php">
											<div class="d-flex flex-column">
												<i class="fas fa-play"></i>
												<span>Start</span>
											</div>
										</a>
									</td>
								</tr>
								
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>20</td>
									<td>4</td>
									<td class="quiz_actions d-flex flex-row justify-content-lg-end">
										<div class="d-flex flex-column pl-0 pl-md-4">
											<i class="fas fa-edit"></i>
											<span>Edit</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										<a href="../quiz/start-quiz.php">
											<div class="d-flex flex-column">
												<i class="fas fa-play"></i>
												<span>Start</span>
											</div>
										</a>
									</td>
								</tr>
								
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>20</td>
									<td>4</td>
									<td class="quiz_actions d-flex flex-row justify-content-lg-end">
										<div class="d-flex flex-column pl-0 pl-md-4">
											<i class="fas fa-edit"></i>
											<span>Edit</span>
										</div>
										<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										<a href="../quiz/start-quiz.php">
											<div class="d-flex flex-column">
												<i class="fas fa-play"></i>
												<span>Start</span>
											</div>
										</a>
									</td>
								</tr>
								
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>20</td>
									<td>4</td>
									<td class="quiz_actions d-flex flex-row justify-content-lg-end">
										<div class="d-flex flex-column pl-0 pl-md-4">
											<i class="fas fa-edit"></i>
											<span>Edit</span>
										</div>									<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										
										<a href="../quiz/start-quiz.php">
											<div class="d-flex flex-column">
												<i class="fas fa-play"></i>
												<span>Start</span>
											</div>
										</a>
									</td>
								</tr>
								
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>20</td>
									<td>4</td>
									<td class="quiz_actions d-flex flex-row justify-content-lg-end">
										<div class="d-flex flex-column pl-0 pl-md-4">
											<i class="fas fa-edit"></i>
											<span>Edit</span>
										</div>									<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										<a href="../quiz/start-quiz.php">
											<div class="d-flex flex-column">
												<i class="fas fa-play"></i>
												<span>Start</span>
											</div>
										</a>
									</td>
								</tr>
								
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>20</td>
									<td>4</td>
									<td class="quiz_actions d-flex flex-row justify-content-lg-end">
										<div class="d-flex flex-column pl-0 pl-md-4">
											<i class="fas fa-edit"></i>
											<span>Edit</span>
										</div>									<div class="d-flex flex-column">
											<i class="fas fa-share-alt"></i>
											<span>Share</span>
										</div>
										<a href="../quiz/start-quiz.php">
											<div class="d-flex flex-column">
												<i class="fas fa-play"></i>
												<span>Start</span>
											</div>
										</a>
									</td>
								</tr>
								
							</tbody>
							<tfoot>
								<tr>
									
									<td colspan="4" class="text-center text-muted"><small><a href="#">View more</a></small></td>
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

<<<<<<< HEAD:resources/views/dashboard/my-quizzes.blade.php
@section('footer_scripts')

@endsection
=======
>>>>>>> 21feccafa3ad9d8ac5038c83b85332745f377fe1:resources/views/dashboard/my-quizzes.blade.php
