@extends('layouts.tablequizapp')

@section('content')
<section class="container page__inner dashboard">
	<div class="row dashboard__wrapper">
		
		<aside class="col-lg-3 dashboard__sidebar d-flex flex-column">
			<h2>Menu</h2>
			<div class="dashboard__container flex-grow-1 d-flex flex-column justify-content-between">
				
				<ul class="list-unstyled m-0 p-0 text-sm-center text-lg-left">
					<li>
						<a href="../admin/home.php">
							<span><i class="fas fa-home"></i></span>
							Overview
						</a>
					</li>
					<li>
						<a href="../admin/quizzes.php">
							<span><i class="fas fa-briefcase"></i></span>
							Quizzes
						</a>
					</li>
					<li>
						<a href="../admin/users.php">
							<span><i class="fas fa-users"></i></span>
							Users
						</a>
					</li>
					<li class="active">
						<a href="../admin/financials.php">
							<span><i class="fas fa-coins"></i></span>
							Financials
						</a>
					</li>
					<li>
						<a href="../admin/categories.php">
							<span><i class="fas fa-th-large"></i></span>
							Categories
						</a>
					</li>
					<li>
						<a href="../admin/questions.php">
							<span><i class="fas fa-question-circle"></i></span>
							Questions
						</a>
					</li>
					
				</ul>
				<a href="../quiz/setup.php" class="btn btn-primary hasPlus d-block">New Quiz</a>
			</div>
		</aside>
		
		<section class="col-lg-9 dashboard__content">
			<div class="row">
				<div class="col-12">
					<div class="row">
						<div class="col pl-0">
							<h2>Financials</h2>
						</div>
					</div>
					<div class="row">
						<div class="dashboard__container col">
							<h3>Set price band for questions</h3>
							@foreach($questionCosts as $questionCost)
							<form class="form-row pt-4 align-items-center mb-0" action="" method="" id="price__band__questions">
								<div class="col-4 col-md-1">
									<span>From</span>
								</div>
								<div class="col-8 col-md-4 d-flex flex-row align-items-center justify-content-md-center">
									<input id="from{{$questionCost->id}}" maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1" 
										   placeholder="{{$questionCost->from}}">
									<span>to</span>
									<input id="to{{$questionCost->id}}" maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1" 
										   placeholder="{{$questionCost->to}}">
								</div>
								<div class="col-4 col-md-3 pt-2 pt-md-0">
								<span style="line-height: 1.1" class="d-block  ">{{$questionCost->band_type}}</span>
								</div>
								<div class="col-8 col-md-4 pt-2 pt-md-0">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">&euro;</span>
										</div>
										<input id="cost{{$questionCost->id}}" maxlength="3" class="form-control" placeholder="{{$questionCost->cost}}">
										
										<button id="{{$questionCost->id}}"  maxlength="3" class=" form-control ml-1" value="" ><i class="fa fa-check-circle" style="color:purple"></i></button>
									</div>
								</div>
							</form>
							@endforeach
						</div>
					</div>
					<div class="row mt-3">
						<div class="dashboard__container col">
							<h3>Set price band for no. backgrounds</h3>
							@foreach($backgroundCosts as $backgroundCost)
							<form class="form-row pt-4 align-items-center mb-0" action="" method="" id="price__band__questions">
								<div class="col-4 col-md-1">
									<span>From</span>
								</div>
								<div class="col-8 col-md-4 d-flex flex-row align-items-center justify-content-md-center">
									<input id="from{{$backgroundCost->id}}" maxlength="3" class="mr-2 mx-md-2 form-control flex-grow-1"  placeholder="{{$backgroundCost->from}}">
									<span>to</span>
									<input id="to{{$backgroundCost->id}}"  maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1" placeholder="{{$backgroundCost->to}}">
								</div>
								<div class="col-4 col-md-3 pt-2 pt-md-0">
								<span style="line-height: 1.1" class="d-block  ">{{$backgroundCost->band_type}}</span>
								</div>
								<div class="col-8 col-md-4 pt-2 pt-md-0">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">&euro;</span>
										</div>
										<input id="cost{{$backgroundCost->id}}" maxlength="3" class="form-control" placeholder="{{$backgroundCost->cost}}">
										<button id="{{$backgroundCost->id}}"  maxlength="3" class=" form-control ml-1" value="" ><i class="fa fa-check-circle" style="color:purple"></i></button>
									</div>
								</div>
							</form>
							@endforeach
						</div>
					</div>
					<div class="row mt-3">
						<div class="dashboard__container col">
							<h3>Set price band for no. participants</h3>
							@foreach($participantCosts as $participantCost)
							<form class="form-row pt-4 align-items-center mb-0" action="" method="" id="price__band__questions">
								<div class="col-4 col-md-1">
									<span>From</span>
								</div>
								<div class="col-8 col-md-4 d-flex flex-row align-items-center justify-content-md-center">
									<input id="from{{$participantCost->id}}" maxlength="3" class="mr-2 mx-md-2 form-control flex-grow-1"  placeholder="{{$participantCost->from}}">
									<span>to</span>
									<input id="to{{$participantCost->id}}" maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1" placeholder="{{$participantCost->to}}">
								</div>
								<div class="col-4 col-md-3 pt-2 pt-md-0">
								<span style="line-height: 1.1" class="d-block  ">{{$participantCost->band_type}}</span>
								</div>
								<div class="col-8 col-md-4 pt-2 pt-md-0">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">&euro;</span>
										</div>
										<input id="cost{{$participantCost->id}}" maxlength="3" class="form-control" placeholder="{{$participantCost->cost}}">
										<button id="{{$participantCost->id}}"  maxlength="3" class=" form-control ml-1" value="" ><i class="fa fa-check-circle" style="color:purple"></i></button>
									</div>
								</div>
							</form>
							@endforeach
						</div>
					</div>
					
				</div>
			</div>
		</section>
	</div>
</section>

@endsection

@section('footer_scripts')
@if(config('usersmanagement.enableSearchUsers'))
@include('scripts.financials');
@endif
@endsection