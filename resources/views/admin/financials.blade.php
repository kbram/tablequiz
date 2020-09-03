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
					<li class="active">
						<a href="#">
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
						<a href="/admin/questions">
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
						<div class="col pl-0">
							<h2>Financials</h2>
						</div>
					</div>
					<div class="row">
						<div class="dashboard__container col">
						<div class="d-flex">
						   <h3 class="col-8">Set price band for questions</h3>
								<i class="fa fa-plus-circle col-4 price-band-questions" id="addQuestionPrice"></i>
						</div>							
											

							@foreach($questionCosts as $questionCost)
							<span id="msg{{$questionCost->id ?? ''}}" class="text-success" ></span>
							
							<form class="form-row pt-4 align-items-center mb-0 price-band-financials" action="" method="" >

								<div class="col-4 col-md-1">
								
									<span>From</span>
								</div>
								<div class="col-8 col-md-4 d-flex flex-row align-items-center justify-content-md-center">
									<input id="from{{$questionCost->id}}" maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1" placeholder="{{$questionCost->from}}"> 
										   
									<span>to</span>
									<input id="to{{$questionCost->id}}" maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1" placeholder="{{$questionCost->to}}"> 
									<input id="type{{$questionCost->id}}" hidden name="type" type="text" value="questions costs" >   
								</div>
								<div class="col-4 col-md-3 pt-2 pt-md-0">
								<span style="line-height: 1.1" class="d-block">Question Cost</span>
								</div>
								<div class="col-8 col-md-4 pt-2 pt-md-0">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">&euro;</span>
										</div>
										
										<input id="cost{{$questionCost->id}}" maxlength="3" class="form-control" placeholder="{{$questionCost->cost}}" >
										
										<button type="submit" id="{{ $questionCost->id }}" maxlength="3" class=" form-control ml-1 SavePriceband" value="" ><i class="fa fa-check-circle" style="color:purple"></i></button>
										<button  maxlength="3" class=" form-control ml-1 removePriceband" value="" ><i class="fa fa-trash" style="color:red"></i></button>
								
																		
									</div>
								</div>
									
									
									
							</form>
							
							@endforeach
							<div class="financial-append"></div>

						</div>
					</div>
					<div class="row mt-3">
						<div class="dashboard__container col">
						<div class="d-flex">
						<h3 class="col-8" >Set price band for no. backgrounds</h3>
								<i class="fa fa-plus-circle col-4" id="addBackgroundPrice"></i>
						</div>
							@foreach($backgroundCosts as $backgroundCost)
							<span id="msg{{$backgroundCost->id}}" class="text-success"></span>
							<form class="form-row pt-4 align-items-center mb-0 price-band-financials" action="" method="" id="price__band__backgrounds">
								<div class="col-4 col-md-1">
									<span>From</span>
								</div>
								<div class="col-8 col-md-4 d-flex flex-row align-items-center justify-content-md-center">
									<input id="from{{$backgroundCost->id}}" maxlength="3" class="mr-2 mx-md-2 form-control flex-grow-1" placeholder="{{$backgroundCost->from}}">
									<span>to</span>
									<input id="to{{$backgroundCost->id}}"  maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1" placeholder="{{$backgroundCost->to}}">
									<input id="type{{$backgroundCost->id}}" hidden name="type" type="text" value="backgroundCosts costs" >   

								</div>
								<div class="col-4 col-md-3 pt-2 pt-md-0">
								<span style="line-height: 1.1" class="d-block">Background Cost</span>
								</div>
								<div class="col-8 col-md-4 pt-2 pt-md-0">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">&euro;</span>
										</div>
										<input name="band__costs" maxlength="3" class="form-control" placeholder="{{$backgroundCost->cost}}">
										<button type="submit" id="{{$backgroundCost->id}}" maxlength="3" class=" form-control ml-1 SavePriceband" value="" ><i class="fa fa-check-circle" style="color:purple"></i></button>
										<button maxlength="3" class=" form-control ml-1 removePriceband" value="" ><i class="fa fa-trash" style="color:red"></i></button>

										
									</div>
								</div>
							</form>
							@endforeach
							<div class="financial-append"></div>
						</div>
					</div>
					<div class="row mt-3">
						<div class="dashboard__container col">
						<div class="d-flex">
							<h3 class="col-8">Set price band for no. participants</h3>
								<i class="fa fa-plus-circle col-4" id="addParticipantPrice"></i>
						</div>
							@foreach($participantCosts as $participantCost)
							<span id="msg{{$participantCost->id}}" class="text-success"></span>
							<form class="form-row pt-4 align-items-center mb-0 price-band-financials" action="" method=""">
								<div class="col-4 col-md-1">
									<span>From</span>
								</div>
								<div class="col-8 col-md-4 d-flex flex-row align-items-center justify-content-md-center">
									<input id="from{{$participantCost->id}}" maxlength="3" class="mr-2 mx-md-2 form-control flex-grow-1" placeholder="{{$participantCost->from}}" >
									<span>to</span>
									<input id="to{{$participantCost->id}}" maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1" placeholder="{{$participantCost->to}}">
									<input id="type{{$participantCost->id}}" hidden name="type" type="text" value="participants costs" >   

								</div>
								<div class="col-4 col-md-3 pt-2 pt-md-0">
								<span style="line-height: 1.1" class="d-block">Participant Cost</span>
								</div>
								<div class="col-8 col-md-4 pt-2 pt-md-0">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">&euro;</span>
										</div>
										<input id="cost{{$participantCost->id}}" maxlength="3" class="form-control" placeholder="{{$participantCost->cost}}">
										<button id="{{$participantCost->id}}"  maxlength="3" class=" form-control ml-1 SavePriceband" value="" ><i class="fa fa-check-circle" style="color:purple"></i></button>
										<button   maxlength="3" class=" form-control ml-1 removePriceband" value="" ><i class="fa fa-trash" style="color:red"></i></button>

											
									</div>
								</div>
							</form>
							@endforeach
							<div class="financial-append"></div>

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