
@extends('layouts.tablequizapp')

@section('content')
	<div class="col-12  border-25   text-center ">
	<img class="q-img mb-3" src="{{asset('site_design/images/homepage__logo.png')}}" height="200px">
					<div class="bernhard card-header w-50 mx-auto pt-2 col-12 bg-success article__heading text-white "><h4>{{ trans('titles.activation') }}</h4></div>
					<div class="card-body">
						<p>{{ trans('auth.regThanks') }}<strong> Table Quiz App Account</strong></p>
						<p>{{ trans('auth.anEmailWasSent',['email' => $email, 'date' => $date ] ) }}</p>
						<p>{{ trans('auth.clickInEmail') }}</p>
						<br>
						<p><a href='/activation' class="btn btn-primary">{{ trans('auth.clickHereResend') }}</a></p>
					</div>
	</div>
@endsection














