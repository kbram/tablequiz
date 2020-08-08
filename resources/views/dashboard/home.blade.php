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
				<a href="../quiz/setup.php" class="btn btn-primary hasPlus d-block">New Quiz</a>
			</div>
		</aside>
		
		<section class="col-lg-9 dashboard__content">
			<div class="row">
				<div class="col-lg-8 d-flex flex-column latest__results__container">
					<h2>Latest results</h2>
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
									<th class="text-right">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Mad Dog's Geography Quiz</td>
									<td>20</td>
									<td>4</td>
									<td class="quiz_actions d-flex flex-row justify-content-lg-end">
										<div class="d-flex flex-column">
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
										<div class="d-flex flex-column">
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
										<div class="d-flex flex-column">
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
										<div class="d-flex flex-column">
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
										<div class="d-flex flex-column">
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
@endsection

