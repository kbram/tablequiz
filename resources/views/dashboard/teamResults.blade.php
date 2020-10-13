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
				<a href="/setup/create" class="btn btn-primary hasPlus d-block">New Quiz</a>
			</div>
		</aside>
		
		<section class="col-lg-9 dashboard__content">
			<div class="row h-100">
				<div class="col-12 d-flex flex-column">
					<h2>Results</h2>
					<div class="dashboard__container flex-grow-1 p-0">
						<table class="table table-striped table-borderless m-0 h-100 my__quizzes">
                        @if(!empty($teamNames))
                            <thead> 
                                <tr>
                                    <th>Quiz name</th>
                                    <th>Team name</th>
                                    <th>Score</th>
                                    <th>Position</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $pos = ['st','nd','rd','th','th','th','th','th','th']; $x=1; @endphp
                                    @foreach($onlyteamNames as $onlyteamName)
                                        @foreach($teamNames as $teamName)
                                            @if($onlyteamName->id==$teamName->quiz_id)
                                                <tr>
                                                    @foreach($quizzes as $quiz)
                                                        @if($quiz->id==$teamName->quiz_id)
                                                            <td>{{$quiz->quiz__name}}</td>
                                                        @endif
                                                    @endforeach
                                                    <td>{{$teamName->team_name}}</td>
                                                    <td>{{$teamName->total}}</td>
                                                    @if($x==1)
                                                        <td>{{$x}}<sup>{{$pos[$x-1]}}</sup><span class="trophy first"><i class="fas fa-trophy"></i>
                                                    </span></td>
                                                    @else
                                                        <td>{{$x}}<sup>{{$pos[$x-1]}}</sup></td>
                                                    @endif
                                                    @php $x=$x+1; @endphp
                                                </tr>
                                            @endif
                                        @endforeach
                                        @php $x=1; @endphp
                                    @endforeach
                                
                            </tbody>
                            @else
                            <br>
							<br>
								<h4 class="pt-3 pl-3 text-center">No Result Found</h4>					
								<br><br>
							@endif	
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

