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
					<li class="active">
						<a href="#">
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
						<div class="col-lg-9">
							<h2>Questions</h2>
						</div>
						<div class="col-lg-3 ">
							@if(config('usersmanagement.enableSearchUsers'))
								@include('partials.search-questions-form')
							@endif
							
						</div>
					</div>
					
					
					<div class="dashboard__container flex-grow-0 pt-4 mb-3">
						<h3>Add new question</h3>
						
						<form action="/questions/create" enctype="multipart/form-data" method="post" class="pt-3 add__new__in__admin">
							@csrf
							<div class="form-row">
								<div class="col-md-4">
									<label for="category__type">Category</label>
								</div>
								<div class="col-md-4">

								<select name="category__type" id="category__type" class="form-control" >
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id }}" value="show" >{{ $category->category_name }}</option>
													
                                                @endforeach
                                   	<li class="active">
						
					</li>
					
				</ul>
				<a href="../quiz/setup" class="btn btn-primary hasPlus d-block">New Quiz</a>
			</div>
		</aside>
		
		<section class="col-lg-9 dashboard__container">
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
								
									<select id="question__type" name="question__type" class="form-control" >
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
									<input name="question" type="text" class="form-control" >
									
								</div>
							</div>
							<div class="form-row">
								<div class="col-md-4">
									<label>Add media</label>
								</div>
								<div class="col-md-8">
									<div class="row mt-3">
										<div class="col-md-4 pr-0 mb-3 mb-lg-0">
											<a href="#" class="px-4 btn btn-outline-secondary grey d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#add__image__media" data-title="Image" data-add-text="an image"><span class="pr-2 icon_"><i class="far fa-image"></i></span>Image </a>
										</div>
										<div class="col-md-4 pr-0 mb-3 mb-lg-0">
											<a href="#" class="px-4 btn btn-outline-secondary grey d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#add__audio__media" data-title="Audio" data-add-text="any audio file"><span class="pr-2 icon_"><i class="fas fa-music"></i></span>Audio </a></a>
										</div>
										<div class="col-md-4 pr-0 pr-md-3">
											<a href="#" class="px-4 btn btn-outline-secondary grey d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#add__video__media" data-title="Video" data-add-text="any video file"><span class="pr-2 icon_"><i class="fas fa-video"></i></span>Video </a></a>
										</div>
									</div>
								</div>
								<div class="modal" id="add__image__media" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header justify-content-center">
										<h1 class="modal-title" id="add__image__media__modal__heading"></h1>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										<p class="text-center py-2">Add <span id="add__image__media__text"></span> to reference in your question</p>
										<div class="form-row">
											<div class="col-md-4">
												<label>Add link</label>
											</div>
											<div class="col-md-8">
												<input type="url" name="add_link_to_image__media" class="form-control" id="add__image__media__text">
											</div>
										</div>
										<div class="text-center w-100">
											 <span>OR</span>
										</div>
										<div class="form-row justify-content-center pt-3">
											<div class="col-md-3">	
											   <label class="d-block" for="upload__image__media__file">Upload
													<input type="file" class="form-control-file" id="upload__image__media__file" value="Upload" name="image_media">
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
                            	<div class="modal" id="add__audio__media" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header justify-content-center">
										<h1 class="modal-title" id="add__audio__media__modal__heading"></h1>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										<p class="text-center py-2">Add <span id="add__audio__media__text"></span> to reference in your question</p>
										<div class="form-row">
											<div class="col-md-4">
												<label>Add link</label>
											</div>
											<div class="col-md-8">
												<input type="url" name="add_link_to_audio__media" class="form-control" id="add__audio__media__text">
											</div>
										</div>
										<div class="text-center w-100">
											 <span>OR</span>
										</div>
										<div class="form-row justify-content-center pt-3">
											<div class="col-md-3">	
											   <label class="d-block" for="upload__audio__media__file">Upload
													<input type="file" class="form-control-file" id="upload__audio__media__file" value="Upload" name="audio_media">
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
								<div class="modal" id="add__video__media" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header justify-content-center">
										<h1 class="modal-title" id="add__video__media__modal__heading"></h1>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										<p class="text-center py-2">Add <span id="add__video__media__text"></span> to reference in your question</p>
										<div class="form-row">
											<div class="col-md-4">
												<label>Add link</label>
											</div>
											<div class="col-md-8">
												<input type="url" name="add_link_to_video__media" class="form-control" id="add__video__media__text">
											</div>
										</div>
										<div class="text-center w-100">
											 <span>OR</span>
										</div>
										<div class="form-row justify-content-center pt-3">
											<div class="col-md-3">	
											   <label class="d-block" for="upload__video__media__file">Upload
													<input type="file" class="form-control-file" id="upload__video__media__file" value="Upload" name="video_media">
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
							<div class="form-row d-flex" id="standard__answer" >
								<div class="col-md-4">
									<label for="standard__question__answer">Answer</label>
								</div>
								<div class="col-md-8">
									<input class="form-control" name="standard__question__answer" type="text" >
								</div>
							</div>
							<div class="form-row d-none" id="numeric__answer" name="numeric__answer">
								<div class="col-md-4">
									<label for="numeric__question__answer">Answer</label>
								</div>
								<div class="col-md-8">
									<input class="form-control" name="numeric__question__answer" type="number" >
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
										<div  id="dynamicTable" class="col-7">
										
											
									 <input  name="multiple__choice__answer__1" class="form-control" type="text" >		   
										</div> 
										<div class="col-1 justify-content-center">
											&nbsp;
										</div>
										<div class="col-1 justify-content-center" >
											<span class="plus" id="add">+</span>
											
										</div>
										<div class="col-3 text-center form-check">
											<input  type="radio" class="" name="multiple__choice__correct__answer" value=0 >
										</div>
									</div>

								</div>

							</div>

							<div class="form-row">
								<div class="col-md-4">
									<label for="time__limit">Time limit</label>
								</div>
								<div class="col-md-4">
									<input class="form-control" type="number" name="time__limit" >
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
							<tbody>
							
							@foreach($questions as $question)
							

							<tr>	
								<td>{{$question->question}}</td>  
							    <td>{{$cat_name[$question->id]}}</td>
						       
						       <td class="quiz_actions d-flex flex-row justify-content-lg-center">
							   <div class="d-flex flex-column">
									<i class="fas fa-pencil-alt"></i>
									<span><a href="{{ URL::to('questions/'. $question->id .'/edit') }}" data-toggle="tooltip" title="edit">
                                                   Edit
                                                </a></span>
								</div>									
								<div class="d-flex flex-column">
									<i class="fas fa-times-circle"></i>
									<span> <a  data-id="{{$question->question}}" data-model="GlobalQuestion"  data-toggle="tooltip" title="delete" >
                                               Delete
                                                </a></span>
								</div>
							    </td>
							</tr>
							 @endforeach
							
								 
							</tbody>
								<tr>
									<td>{{$question->question}}</td>
									<td>{{$question->category}}</td>
									<td class="quiz_actions d-flex flex-row justify-content-lg-center">
										<div class="d-flex flex-column">
											<i class="fas fa-pencil-alt"></i>
											<span>Edit</span>
										</div>									
										
										
										<div class="p-0">
										
											<form method="POST" action="/admin/questions/{{$question->id}}" class="p-0">
												{{ csrf_field() }}
												<div class="d-flex flex-column">
											<i class="fas fa-times-circle "></i><span class="delete" >Delete</span>
											</div>
											</form>
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
						{{ $questions->links() }}
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
@include('scripts.delete-model')	
@endsection
