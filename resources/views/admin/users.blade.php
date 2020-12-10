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
					<li class="active">
						<a href="">
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
						<div class="col-lg-9">
							<h2>Users</h2>
						</div>
						<div class="col-lg-3">
						@if(config('usersmanagement.enableSearchUsers'))
								@include('partials.search-user-form')
							@endif
						</div>
					</div>
					
					
					<div class="dashboard__container flex-grow-0 p-0">
						<table class="table table-striped table-borderless m-0 h-100 my__quizzes">
							<thead>
								<tr>
									<th>Username <span><small><i class="fa fa-angle-down"></i></small></span</th>
									<th>Quizzes created <span><small><i class="fa fa-angle-down"></i></small></span></th>
									<th>Questions created <span><small><i class="fa fa-angle-down"></i></small></span</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody id="users_table">
						        	@if(!empty($users))
								   @foreach($users as $user)
								   @if ($user->is_blocked)
								<tr>
									<td>{{$user->name}}</td>
									<td>{{$quizcount[$user->id]}}</td>
									<td>{{$questioncount[$user->id]}}</td>


									<td class="quiz_actions d-flex flex-row justify-content-lg-center">

									<div class="d-flex flex-column pl-0"  style=" pointer-events: none;opacity: 0.4;">

												<i class="far fa-eye"></i>
										<a href="{{route('userquizzes',$user->id)}}" data-toggle="tooltip" title="View Qs">
											
											<span>  View Qs</span></a>
										
											</div>

										<form method="POST" action="/admin/home/un-blockuser/{{$user->id}}" class="p-0">
										      @csrf
											<div class="d-flex flex-column blockuser" id="{{$user->id}}" >
												<i class="fas fa-times-circle"></i>
												<span id="block{{$user->id}}">Un-Block</span>
											</div>
										</form>

										</td>
								</tr>

								@else
								<tr>
									<td>{{$user->name}}</td>
									<td>{{$quizcount[$user->id]}}</td>
									<td>{{$questioncount[$user->id]}}</td>


						<td class="quiz_actions d-flex flex-row justify-content-lg-center">
                            <a href="{{route('userquizzes',$user->id)}}" data-toggle="tooltip" title="View Qs">
								<div class="d-flex flex-column pl-0">
									<i class="far fa-eye"></i>
									<span>View Qs</span>
								</div>
							</a>


										<form method="POST" action="/admin/home/blockuser/{{$user->id}}" class="p-0">
										             @csrf
											<div class="d-flex flex-column blockuser"  id="{{$user->id}}">
												<i class="fas fa-times-circle"></i>
												<span id="block{{$user->id}}">Block</span>
											</div>
										</form>

										</td>
								</tr>


                                @endif 								 
								@endforeach
								@else
								<tr>
								<p>No users to show</p>
								</tr>
								@endif
							</tbody>
							<tbody id="users_table"></tbody>
							@if(config('usersmanagement.enableSearchUsers'))
								<tbody id="search_results"></tbody>
							@endif
							<tfoot>
								<tr>
									
									<td colspan="4" class="text-center text-muted">
									<br>
										@if(!empty($users))
											<div  class="d-flex justify-content-center">{{$users->links()}}</div>
										@endif
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
@include('scripts.message')
@include('scripts.block-user')
@if(config('usersmanagement.enableSearchUsers'))
        @include('scripts.search-user')
@endif
@endsection