@extends('layouts.tablequizapp')
@section('content')
<section class="container page__inner dashboard">
	<div class="row dashboard__wrapper">
		
		<aside class="col-lg-3 dashboard__sidebar d-flex flex-column">
			<h2>Menu</h2>
			<div class="dashboard__container flex-grow-1 d-flex flex-column justify-content-between">
				
				<ul class="list-unstyled m-0 p-0">
					<li>
						<a href="/dashboard/home">
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
					<li class="active">
						<a href="">
							<span><i class="fas fa-cog"></i></span>
							Settings
						</a>
					</li>
				</ul>
				<a href="/setup/create" class="btn btn-primary hasPlus d-block">New Quiz</a>
			</div>
		</aside>
		
		<section class="col-lg-9 dashboard__content">
			<div class="row">
				<div class="col pl-0">
					<h2>Settings</h2>
				</div>
			</div>
			<div class="row">
				<div class="dashboard__container col">
					<form class="settings pt-1" action="/profile/{{$user->id }}/updateUserAccount" method="post">
					     @csrf
						<h3>Edit my details</h3>
						<div class="form-row mt-4">
							<div class="col-sm-4">
								<label for="first_name_">First name</label>
							</div>
							<div class="col-sm-6">
								<input class="form-control" name="first_name" value="{{$user->first_name}}">
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-4">
								<label for="last_name_">Last name</label>
							</div>
							<div class="col-sm-6">
								<input class="form-control" name="last_name" value="{{$user->last_name}}">
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-4">
								<label for="username_">Username</label>
							</div>
							<div class="col-sm-6">
								<input class="form-control" name="name" value="{{$user->name}}">
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-4">
								<label for="username_">Email address</label>
							</div>
							<div class="col-sm-6">
								<input class="form-control" name="email" value="{{$user->email}}" type="email">
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-4">
								<label for="confirm_password_">Password</label>
							</div>
							<div class="col-sm-6">
								<input class="form-control" name="password" value="" type="password">
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-4">
								<label for="confirm_password_">Confirm password</label>
							</div>
							<div class="col-sm-6">
								<input class="form-control" name="password_confirmation" value="" type="password">
							</div>
						</div>
						<div class="form-row d-flex justify-content-center pt-4 mb-0">
							<div class="col-4">
								<input type="submit" class="btn d-block btn-primary" value="Save">
								
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row mt-3">
				<div class="dashboard__container col">
					<form class="Settings pt-1">
						<h3>Payment details</h3>
						<div class="form-row mt-4">
							<div class="col-sm-4">
								<label for="card_name_">Cardholder name</label>
							</div>
							<div class="col-sm-6">
								<input class="form-control" name="card_name_" value="Senan Cronin" type="text">
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-4">
								<label for="street_address_">Street</label>
							</div>
							<div class="col-sm-6">
								<input class="form-control" name="street_address_" value="The Paint Box" type="text">
							</div>
						</div>

						<div class="form-row">
							<div class="col-sm-4">
								<label for="city_">City</label>
							</div>
							<div class="col-sm-6">
								<input class="form-control" name="city_" value="Barna" type="text">
							</div>
						</div>

						<div class="form-row">
							<div class="col-sm-4">
								<label for="county_">County</label>
							</div>
							<div class="col-sm-6">
								<input class="form-control" name="county_" value="Co. Galway" type="text">
							</div>
						</div>

						<div class="form-row">
							<div class="col-sm-4">
								<label for="country_">Country</label>
							</div>
							<div class="col-sm-6">
								<input class="form-control" name="country_" value="Ireland" type="text">
							</div>
						</div>

						<div class="form-row">
							<div class="col-sm-4">
								<label for="card_number_">Card Number</label>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<input type="password" class="form-control pwd no" value="4104554345029981" name="card_number_">
									<div class="input-group-append">
										<span class="input-group-text">
											<button class="btn btn-default reveal" id="eye_no" type="button"><i class="fas fa-eye"></i></button>
										</span>
									</div>          
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-sm-4">
								<label for="card_cvv_">CVV</label>
							</div>
							<div class="col-sm-2">
								<div class="input-group">
									<input type="password" class="form-control pwd cvv" value="332" maxlength="4" name="card_cvv_">
									<div class="input-group-append">
										<span class="input-group-text">
											<button class="btn btn-default reveal" id="eye_cvv"type="button"><i class="fas fa-eye"></i></button>
										</span>
									</div>          
								</div>
							</div>
						</div>
						<div class="form-row d-flex justify-content-center pt-4 mb-0">
							<div class="col-4">
								<button type="submit" class="btn d-block btn-primary">Save</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>
</section>
@endsection
@section('footer_scripts')

<script>
	$("body").on('click', '#eye_no', function() {
	$(this).toggleClass("fa-eye fa-eye-slash");
	var input = $(".no");
	if (input.attr("type") === "password") {
		input.attr("type", "text");
	} else {
		input.attr("type", "password");
	}
	})

	$("body").on('click', '#eye_cvv', function() {
	$(this).toggleClass("fa-eye fa-eye-slash");
	var input = $(".cvv");
	if (input.attr("type") === "password") {
		input.attr("type", "text");
	} else {
		input.attr("type", "password");
	}

	})
</script>
@endsection