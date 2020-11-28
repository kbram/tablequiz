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
				<a href="/setup/create" class="btn btn-primary hasPlus d-block">New Quiz</a>

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
						   <h3 class="col-8">Set price band for no. questions</h3>
						</div>							
							@if(@isset($questionCosts))
							@if( $questionCosts->count() > 0)
							@php
								$c = 0; 
								$count = $questionCosts->count();
							@endphp
							@foreach($questionCosts as $questionCost)
							@php
								$c += 1;
							@endphp
							<span id="msg{{$questionCost->id ?? ''}}" class="text-success" ></span>
							
							<form class="form-row pt-4 align-items-center mb-0 price-band-financials" action="" method="" >

								<div class="col-4 col-md-1">
								
									<span>From</span>
								</div>
								<div class="col-8 col-md-4 d-flex flex-row align-items-center justify-content-md-center">
									<input id="from{{$questionCost->id}}" maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1" placeholder="{{$questionCost->from}}" value="{{$questionCost->from}}"> 
										   
									<span>to</span>
									<input id="to{{$questionCost->id}}" maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1" placeholder="{{$questionCost->to}}" value="{{$questionCost->to}}"> 
									<input id="type{{$questionCost->id}}" hidden name="type" type="text" value="{{Config::get('priceband.type.question_band_type')}}" >   
								</div>
								<div class="col-4 col-md-3 pt-2 pt-md-0">
								<span style="line-height: 1.1" class="d-block">Question Cost</span>
								</div>
								<div class="col-8 col-md-4 pt-2 pt-md-0">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">&euro;</span>
										</div>
										
										<input id="cost{{$questionCost->id}}" maxlength="10" class="form-control" placeholder="{{$questionCost->cost}}" value="{{$questionCost->cost}}">
										
										<button type="submit" id="{{ $questionCost->id }}" maxlength="3" class=" form-control ml-1 SavePriceband" value="" name="old"><i class="fa fa-check-circle" style="color:blue"></i></button>
										
										@if($c==1 && $c==$count)
											<button  maxlength="3" class=" form-control ml-1 removePriceband" value="" id="question"><i class="fa fa-trash" style="color:grey"></i></button>
											<i class="fa fa-plus-circle col-2 price-band-questions mt-4" id="addQuestionPrice1"></i>
											<i class="col-2 pl"style="display:none;" id="addQuestionPricesp1"></i>
										@elseif($c==1)
											<button  maxlength="3" class=" form-control ml-1 removePriceband" value="" id="question" ><i class="fa fa-trash" style="color:grey"></i></button>
											<i class="col-2 pl" ></i>
										@elseif($c==$count)
											<button  maxlength="3" class=" form-control ml-1 removePriceband" value="" ><i class="fa fa-trash" style="color:grey"></i></button>
											<i class="fa fa-plus-circle col-2 price-band-questions mt-4" id="addQuestionPrice1"></i>
											<i class="col-2 pl"style="display:none;" id="addQuestionPricesp1"></i>
										@else
											<button  maxlength="3" class=" form-control ml-1 removePriceband" value="" ><i class="fa fa-trash" style="color:grey"></i></button>
											<i class="col-2 pl" ></i>
										@endif
										
																		
									</div>
								</div>
									
									
									
							</form>
							
							@endforeach
							@else
							<div class="row d-flex">
							<span class="col-9">
							<p id="noq"> No Questions Cost created yet! </p>
							</span>
							<span class="col-3">
							<i class="fa fa-plus-circle price-band-questions " id="addQuestionPrice1"></i>
							<i class="pl"style="display:none;" id="addQuestionPricesp1"></i>
							<span>
							</div>							
							 				
								@endif
											@endif
							
							<i class="fa fa-plus-circle  price-band-questions mt-4 " id="dem1" style="margin-top:-50%;float:right;display:none;" ></i>
							<div class="financial-append">
							
							</div>

						</div>
					</div>
					<div class="row mt-3">
						<div class="dashboard__container col">
						<div class="d-flex">
						<h3 class="col-8" >Set price band for no. backgrounds</h3>
								
						</div>
						@if(@isset($backgroundCosts))
						@if( $backgroundCosts->count() > 0)

							@php
								$c = 0; 
								$count = $backgroundCosts->count();
							@endphp
							@foreach($backgroundCosts as $backgroundCost)
							@php
								$c += 1;
							@endphp
							<span id="msg{{$backgroundCost->id}}" class="text-success"></span>
							<form class="form-row pt-4 align-items-center mb-0 price-band-financials" action="" method="" >
								<div class="col-4 col-md-1">
									<span>From</span>
								</div>
								<div class="col-8 col-md-4 d-flex flex-row align-items-center justify-content-md-center">
									<input id="from{{$backgroundCost->id}}" maxlength="3" class="mr-2 mx-md-2 form-control flex-grow-1" placeholder="{{$backgroundCost->from}}"  value="{{$backgroundCost->from}}">
									<span>to</span>
									<input id="to{{$backgroundCost->id}}"  maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1" placeholder="{{$backgroundCost->to}}" value="{{$backgroundCost->to}}">
									<input id="type{{$backgroundCost->id}}" hidden name="type" type="text" value="{{Config::get('priceband.type.background_band_type')}}" >   

								</div>
								<div class="col-4 col-md-3 pt-2 pt-md-0">
								<span style="line-height: 1.1" class="d-block">Background Cost</span>
								</div>
								<div class="col-8 col-md-4 pt-2 pt-md-0">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">&euro;</span>
										</div>
										<input id="cost{{$backgroundCost->id}}" name="band__costs" maxlength="10" class="form-control" placeholder="{{$backgroundCost->cost}}" value="{{$backgroundCost->cost}}">
										<button type="submit" id="{{$backgroundCost->id}}" maxlength="3" class=" form-control ml-1 SavePriceband" value="" name="old"><i class="fa fa-check-circle" style="color:blue"></i></button>
										
										@if($c==1 && $c==$count)
											<button  maxlength="3" class=" form-control ml-1 removePriceband" value="" id="background"><i class="fa fa-trash" style="color:grey"></i></button>
											<i class="fa fa-plus-circle col-2 addBackgroundPrice mt-4" id="addBackgroundPrice1"></i>
											<i class="col-2 pl"style="display:none;" id="addBackgroundPricesp1"></i>
										@elseif($c==1)
											<button  maxlength="3" class=" form-control ml-1 removePriceband" value="" id="background" ><i class="fa fa-trash" style="color:grey"></i></button>
											<i class="col-2 pl" ></i>
										@elseif($c==$count)
											<button  maxlength="3" class=" form-control ml-1 removePriceband" value="" ><i class="fa fa-trash" style="color:grey"></i></button>
											<i class="fa fa-plus-circle col-2 addBackgroundPrice mt-4" id="addBackgroundPrice1"></i>
											<i class="col-2 pl"style="display:none;" id="addBackgroundPricesp1"></i>
										@else
											<button  maxlength="3" class=" form-control ml-1 removePriceband" value="" ><i class="fa fa-trash" style="color:grey"></i></button>
											<i class="col-2 pl" ></i>
										@endif
										
										@if($c==$count)
											
										@else
											
										@endif
										
										
									</div>
								</div>
							</form>
							@endforeach
							@else

							<div class="row d-flex">
							<span class="col-9">
							<p id="nob"> No Background Cost created yet! </p>
							</span>
							<span class="col-3">
							<i class="fa fa-plus-circle addBackgroundPrice " id="addBackgroundPrice1"></i>
							<i class=""style="display:none;" id="addBackgroundPricesp1"></i>
							<span>
							</div>	


							
						
						@endif					
						@endif
						<i class="fa fa-plus-circle addBackgroundPrice  mt-4 dem" id="dem2" style="margin-top:-50%;float:right;display:none;" ></i>
							<div class="financial-append"></div>
						</div>
					</div>
					<div class="row mt-3">
						<div class="dashboard__container col">
						<div class="d-flex">
							<h3 class="col-8">Set price band for no. participants</h3>
							
						</div>
							@if(@isset($participantCosts))
							@if( $participantCosts->count() > 0)

							@php
								$c = 0; 
								$count = $participantCosts->count();
							@endphp
							@foreach($participantCosts as $participantCost)
							@php
								$c += 1;
							@endphp
							<span id="msg{{$participantCost->id}}" class="text-success"></span>
							<form class="form-row pt-4 align-items-center mb-0 price-band-financials" action="" method="">
								<div class="col-4 col-md-1">
									<span>From</span>
								</div>
								<div class="col-8 col-md-4 d-flex flex-row align-items-center justify-content-md-center">
									<input id="from{{$participantCost->id}}" maxlength="3" class="mr-2 mx-md-2 form-control flex-grow-1" placeholder="{{$participantCost->from}}" value="{{$participantCost->from}}" >
									<span>to</span>
									<input id="to{{$participantCost->id}}" maxlength="3" class="ml-2 mx-md-2 form-control flex-grow-1" placeholder="{{$participantCost->to}}" value="{{$participantCost->to}}">
									<input id="type{{$participantCost->id}}" hidden name="type" type="text" value="{{Config::get('priceband.type.participant_band_type')}}" >   

								</div>
								<div class="col-4 col-md-3 pt-2 pt-md-0">
								<span style="line-height: 1.1" class="d-block">Participant Cost</span>
								</div>
								<div class="col-8 col-md-4 pt-2 pt-md-0">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">&euro;</span>
										</div>
										<input id="cost{{$participantCost->id}}" maxlength="10" class="form-control" placeholder="{{$participantCost->cost}}" value="{{$participantCost->cost}}">
										<button id="{{$participantCost->id}}"  maxlength="3" class=" form-control ml-1 SavePriceband" value="" name="old"><i class="fa fa-check-circle" style="color:blue"></i></button>
										
										
										@if($c==1 && $c==$count)
											<button  maxlength="3" class=" form-control ml-1 removePriceband" value="" id="participant"><i class="fa fa-trash" style="color:grey"></i></button>
											<i class="fa fa-plus-circle col-2 addParticipantPrice mt-4" id="addParticipantPrice1"></i>
											<i class="col-2 pl"style="display:none;" id="addParticipantPricesp1"></i>
										@elseif($c==1)
											<button  maxlength="3" class=" form-control ml-1 removePriceband" value="" id="participant" ><i class="fa fa-trash" style="color:grey"></i></button>
											<i class="col-2 pl" ></i>
										@elseif($c==$count)
											<button  maxlength="3" class=" form-control ml-1 removePriceband" value="" ><i class="fa fa-trash" style="color:grey"></i></button>
											<i class="fa fa-plus-circle col-2 addParticipantPrice mt-4" id="addParticipantPrice1"></i>
											<i class="col-2 pl"style="display:none;" id="addParticipantPricesp1"></i>
										@else
											<button  maxlength="3" class=" form-control ml-1 removePriceband" value="" ><i class="fa fa-trash" style="color:grey"></i></button>
											<i class="col-2 pl" ></i>
										@endif
										
										
									</div>
								</div>
							</form>				
							
							@endforeach
							@else

							<div class="row d-flex">
							<span class="col-9">
							<p id="nop"> No price </p>
							</span>
							<span class="col-3">
							<i class="fa fa-plus-circle addParticipantPrice " id="addParticipantPrice1"></i>
							<i class=""style="display:none;" id="addParticipantPricesp1"></i>
							<span>
							</div>	

							
											
							@endif
							@endif
							<i class="fa fa-plus-circle addParticipantPrice mt-4 dem" id="dem3" style="margin-top:-50%;float:right;display:none;" ></i>
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