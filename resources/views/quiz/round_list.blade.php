@extends('layouts.tablequizapp')

@section('content')
<section class="container-fluid">
	<div class="row ">
		<section class="col-lg-12 dashboard__content">
			<div class="row h-100">
				<div class="col-12 d-flex flex-column">
					<h2>My Rounds</h2>
					<div class="dashboard__container flex-grow-1 p-0">
						<table class="table table-striped table-borderless m-0 h-100 my__quizzes">
							<thead>
								<tr>
									<th>Rounds name</th>
								    <th>Questions</th> 
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody id="users">
                               
							 @foreach($rounds as $round)

							<tr>
									 <td>{{$round->round_name}}</td>
									 <td>{{$questions_counts[$round->id]}}</td>
								
									<td class="quiz_actions d-flex flex-row justify-content-lg-center">
										<a href="{{ URL::to('round_ques_list/edit/'.$round->round_name.'/'.$round->id) }}">			
										<div class="d-flex flex-column pl-0 pl-md-4">
											<i class="fas fa-edit"></i>
											<span>Edit</span>
										</div></a>
										
										</td>
                                      
								</tr>
                                @endforeach
                                       
						</table>
						
					</div>
					</div>
			</div>
		</section>
	</div>
</section>
<style>
.row dashboard__wrapper{
	margin-bottom:50px;
}
</style>
@endsection
@section('footer_scripts')
@include('scripts.quiz-icon-preview')
@include('scripts.share-quiz')
@endsection

