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
					<li>
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
					<li class="active">
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
						<div class="col-lg-9">
							<h2>Questions</h2>
						</div>
						<div class="col-lg-3 d-flex">
							@if(config('usersmanagement.enableSearchUsers'))
								@include('partials.search-questions-form')
							@endif
							
						</div>
					</div>
					
					
					<div class="dashboard__container flex-grow-0 pt-4 mb-3">
						<h3>Add new question</h3>
						
						<form action="" method="" class="pt-3 add__new__in__admin">
							<div class="form-row">
								<div class="col-md-4">
									<label for="category_type">Category</label>
								</div>
								<div class="col-md-4">
									<select id="category_type" class="form-control">
										<option value="category__music">Music</option>
										<option value="category__sport">Sport</option>
										<option value="category__Geography">Geography</option>
										<option value="category__History">History</option>
										<option value="category__Politics">Politics</option>
										<option value="category__popular_culture">Popular Culture</option>

									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="col-md-4">
									<label for="question__type">Question type</label>
								</div>
								<div class="col-md-4">
									<select id="question__type" class="form-control">
										<option value="standard__question">Standard</option>
										<option value="multiple__choice__question">Multiple choice</option>
										<option value="numeric__question">Numeric</option>

									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="col-md-4">
									<label for="question">Question</label>
								</div>
								<div class="col-md-8">
									<input name="question" type="text" class="form-control">
								</div>
							</div>
							<div class="form-row">
								<div class="col-md-4">
									<label>Add media</label>
								</div>
								<div class="col-md-8">
									<div class="row mt-3">
										<div class="col-md-4 pr-0 mb-3 mb-lg-0">
											<a href="#" class="px-4 btn btn-outline-secondary grey d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#add__media" data-title="Image" data-add-text="an image"><span class="pr-2 icon_"><i class="far fa-image"></i></span>Image </a>
										</div>
										<div class="col-md-4 pr-0 mb-3 mb-lg-0">
											<a href="#" class="px-4 btn btn-outline-secondary grey d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#add__media" data-title="Audio" data-add-text="any audio file"><span class="pr-2 icon_"><i class="fas fa-music"></i></span>Audio </a></a>
										</div>
										<div class="col-md-4 pr-0 pr-md-3">
											<a href="#" class="px-4 btn btn-outline-secondary grey d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#add__media" data-title="Video" data-add-text="any video file"><span class="pr-2 icon_"><i class="fas fa-video"></i></span>Video </a></a>
										</div>
									</div>
								</div>
								<div class="modal" id="add__media" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header justify-content-center">
										<h1 class="modal-title" id="add__media__modal__heading"></h1>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										<p class="text-center py-2">Add <span id="add__media__text"></span> to reference in your question</p>
										<div class="form-row">
											<div class="col-md-4">
												<label>Add link</label>
											</div>
											<div class="col-md-8">
												<input type="url" name="add_link_to_media" class="form-control">
											</div>
										</div>
										<div class="text-center w-100">
											 <span>OR</span>
										</div>
										<div class="form-row justify-content-center pt-3">
											<div class="col-md-3">	
											   <label class="d-block" for="upload__media__file">Upload
													<input type="file" class="form-control-file" id="upload__media__file" value="Upload">
												</label>
											</div>
										</div>
									  </div>
									  <div class="modal-footer justify-content-center">
										  <div class="col-sm-4">
											<button type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button>
										  </div>
									  </div>
									</div>
								  </div>
								</div>

							</div>
							<div class="form-row d-flex" id="standard__answer">
								<div class="col-md-4">
									<label for="standard__question__answer">Answer</label>
								</div>
								<div class="col-md-8">
									<input class="form-control" name="standard__question__answer" type="text">
								</div>
							</div>
							<div class="form-row d-none" id="numeric__answer">
								<div class="col-md-4">
									<label for="numeric__question__answer">Answer</label>
								</div>
								<div class="col-md-8">
									<input class="form-control" name="numeric__question__answer" type="number">
								</div>
							</div>
							<div class="form-row d-none" style="min-height:0;" id="multiple__choice__legend">
								<div class="offset-md-10 col-2">
									<small class="d-block text-center pl-4">Correct answer</small>
								</div>
							</div>
							<div class="form-row d-none" id="multiple__choice__answer">
								<div class="col-md-4 align-self-start">
									<label for="multiple__choice__answer">Answer</label>
								</div>
								<div class="col-md-8">

									<div class="row multiple__choice__row pb-3 align-items-center">
										<div class="col-7">
											<input name="multiple__choice__answer__1" class="form-control" type="text">		   
										</div>
										<div class="col-1 justify-content-center">
											&nbsp;
										</div>
										<div class="col-1 justify-content-center">
											<span class="plus">+</span>
										</div>
										<div class="col-3 text-center form-check">
											<input type="radio" class="" name="multiple__choice__correct__answer">
										</div>
									</div>

								</div>

							</div>

							<div class="form-row">
								<div class="col-md-4">
									<label for="time__limit">Time limit</label>
								</div>
								<div class="col-md-4">
									<input class="form-control" type="number" name="time__limit">
								</div>
								<div class="col">
									<small class="form-text text-muted">Seconds</small>
								</div>
							</div>
							
						</form>
						
						<hr>
						<div class="row justify-content-center">
							<div class="col-4">
								<a href="#" class="d-block btn btn-primary">Save</a>
							</div>
						</div>
					</div>
					<div class="dashboard__container flex-grow-1">
						<table class="table table-striped table-borderless m-0 h-100 my__quizzes">
							<thead>
								<tr>
									<th>Question <span><small><i class="fa fa-angle-down"></i></small></span</th>
									<th>Category <span><small><i class="fa fa-angle-down"></i></small></span</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody id="questions_table">
								@foreach($questions as $question)
								
								<tr>
									<td>{{$question->question}}</td>
									<td>{{$question->category}}</td>
									<td class="quiz_actions d-flex flex-row justify-content-lg-center">
										<div class="d-flex flex-column">
											<i class="fas fa-pencil-alt"></i>
											<span>Edit</span>
										</div>									
										<div class="d-flex flex-column">
											<i class="fas fa-times-circle"></i>
											<span>Delete</span>
										</div>
									</td>
								</tr>
								@endforeach
								</tbody>
							<tbody id="questions_table"></tbody>
							@if(config('usersmanagement.enableSearchUsers'))
								<tbody id="search_results"></tbody>
							@endif
							<tfoot>
								<tr>
									<td colspan="6" class="text-center text-muted">
										
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
	@if(config('usersmanagement.enableSearchUsers'))
        @include('scripts.search-questions')
    @endif
	
@endsection