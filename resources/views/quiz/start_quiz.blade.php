
@extends('layouts.tablequizapp')

@section('content')
<section class="container page__inner dashboard">
	<div class="dashboard__wrapper">
		
		<div class="row" style="height:60px;">
			
			<div class="offset-lg-3 col-lg-9 px-5">
				<div class="progress position-relative">
					<div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
					<div class="rounds position-absolute d-flex justify-content-between">
						<div class="progress_round_label round_1">
							<span>Round 1</span>
						</div>
						<div class="progress_round_label round_2">
							<span>Round 2</span>
						</div>
						<div class="progress_round_label round_3">
							<span>Round 3</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<aside class="col-lg-3 dashboard__sidebar d-flex flex-column order-1 order-md-0">
				<div class="dashboard__container d-flex flex-column align-items-center mb-3">
					<h5>Countdown timer</h5>
					<p class="countdown__time">22</p>
					<div class="countdown__buttons row">
						<div class="col-4">
							<i class="fa fa-play"></i>
						</div>
						<div class="col-4">
							<i class="fa fa-pause"></i>
						</div>
						<div class="col-4">
							<i class="fa fa-stop"></i>
						</div>
					</div>
				</div>

				<div class="dashboard__container mb-3 d-flex flex-grow-1 align-items-center flex-column">
					<h5>Actions</h5>
					<ul class="list-unstyled m-0 d-flex flex-column align-items-center">
						<li><a href="#">Issue Question</a></li>
						<li><a href="#">Edit Question</a></li>
						<li><a href="#">Share Answer</a></li>
						<li class="p-0"><a href="#">Next Question</a></li>
					</ul>
				</div>
			 </aside>
			<div class="col-lg-9 order-0 order-md-1">
				<div class="row">
					<div class="col">


						<div class="quiz__slider">
							<div class="quiz__single_question__container d-flex flex-column align-items-center">
								<h4>Question 1</h4>
								<div class="quiz__single_question__image">
									<img src="../images/mozambique__flag.png">
								</div>
								<div class="quiz__single_question__qa text-center w-100">
									<p class="question"><span>Question:</span> What country's flag is this?</p>
									<p class="answer"><span>Answer:</span> Mozambique</p>
								</div>

							</div>
							<div class="quiz__single_question__container d-flex flex-column align-items-center">
								<h4>Question 2</h4>
								<div class="quiz__single_question__image">
									<img style="height:240px;object-fit:cover;" src="../images/moscow__image.jpeg">
								</div>
								<div class="quiz__single_question__qa text-center w-100">
									<p class="question"><span>Question:</span> What city is this?</p>
									<p class="answer"><span>Answer:</span> Moscow</p>
								</div>

							</div>
						</div>

					</div>
				</div>
				
				
				
			</div>
				 
		</div>
		
			<div class="row">
				<aside class="col-lg-3 dashboard__sidebar d-flex flex-column order-1 order-md-0">
					<div class="dashboard__container mt-2 p-0 d-flex flex-grow-1">
						<table class="table table-striped table-borderless mb-0">
							<thead>
								<tr>
									<th>Leaderboard</th>
									<th>Pts</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>SenanCronin2020</td>
									<td>100</td>
								</tr>
								<tr>
									<td>SenanCronin2020</td>
									<td>100</td>
								</tr>
								<tr>
									<td>SenanCronin2020</td>
									<td>100</td>
								</tr>
								<tr>
									<td>SenanCronin2020</td>
									<td>100</td>
								</tr>

							</tbody>

						</table>

					</div>
				</aside>
				<section class="col-lg-9 order-0 order-md-1">
				
				<div class="row quiz__answers mt-2 no-gutters">
					<div class="col dashboard__container">
						<table class="table table-borderless table-striped quiz__answers__table">
							<thead>
								<tr>
									<th class="pb-0">User</th>
									<th class="pb-0">Answers</th>
									<th class="pb-0" colspan=2>Marking:</th>
								</tr>
								<tr>
									<th></th><th></th>
									<th class="py-0 text-muted">
										<small>Correct</small>
									</th>
									<th class="py-0 text-muted">
										<small>Incorrect</small>
									</th>
								</tr>
							</thead>
							<tbody>


								<tr>
									<td>Senancronin2020</td>
									<td>Madagascar</td>
									<td>
										<input type="radio" name="correct_answer_1" value="correct">
									</td>
									<td>
										<input type="radio" name="correct_answer_1" value="incorrect">
									</td>
								</tr>

								<tr>
									<td>ToppoCoolo88</td>
									<td>Zambia</td>
									<td>
										<input type="radio" name="correct_answer_2" value="correct">
									</td>
									<td>
										<input type="radio" name="correct_answer_2" value="incorrect">
									</td>
								</tr>


								<tr>
									<td>FlameBoy2000</td>
									<td>Mozambique</td>
									<td>
										<input type="radio" name="correct_answer_3" value="correct">
									</td>
									<td>
										<input type="radio" name="correct_answer_3" value="incorrect">
									</td>
								</tr>
								<tr>
									<td>NoFearBriarHill</td>
									<td>Spain</td>
									<td>
										<input type="radio" name="correct_answer_5" value="correct">
									</td>
									<td>
										<input type="radio" name="correct_answer_5" value="incorrect">
									</td>
								</tr>

							</tbody>

						</table>
						<div class="row align-items-center text-white justify-content-center">
							<div class="col-9 col-md-4">
								<a class="d-block btn btn-primary">Save answers</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		
	</div>
</section>


@endsection

@section('footer_scripts')

@endsection