@extends('layouts.tablequizapp')
@section('template_linked_css')
<style>
	#blah {
		transform-origin: top left;
		-webkit-transform-origin: top left;
		-ms-transform-origin: top left;
	}

	.rotate90  {
		transform: rotate(90deg) translateY(-100%);
		-webkit-transform: rotate(90deg) translateY(-100%);
		-ms-transform: rotate(90deg) translateY(-100%);
	}

	.rotate180  {
		transform: rotate(180deg) translate(-100%, -100%);
		-webkit-transform: rotate(180deg) translate(-100%, -100%);
		-ms-transform: rotate(180deg) translateX(-100%, -100%);
	}

	.rotate270  {
	
		transform: rotate(270deg) translateX(-100%);
		-webkit-transform: rotate(270deg) translateX(-100%);
		-ms-transform: rotate(270deg) translateX(-100%);
	}
</style>
@endsection
@section('content')


<section class="container page__inner">
	<form class="is_container row" id="add_round" action="/round" method="post" enctype="multipart/form-data" role="main">
		 @csrf
		<article class="col-12">
			<div class="article__heading">
				<h1>Round {{$id ?? '1'}} Setup</h1>
				<?php /*if($quizName) echo "<h2>".$quizName."</h2>";*/?>


				@if (Session::has('fail'))
				<div class="alert alert-danger text-center">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					<p>{{ Session::get('fail') }}</p>
				</div>
				@endif


			</div>
			<div class="form-row mt-md-5">
				<div class="col-md-4">
					<label for="round__name">Round name</label>
				</div>
				<div class="col-md-8">
					<input autocomplete="nothanks" type="text" name="round_name" class="form-control">
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-4">
					<label for="round__background">Round background</label>
					<span class="helper__text" data-placement="left" data-toggle="tooltip" title="Some text about the round background to go here."><i class="fa fa-info-circle"></i></span>
				</div>
				<div class=" col-md-4">
					<a href="#" class="d-block btn btn-outline-secondary" data-toggle="modal" data-target="#edit__round__bg__modal">Upload</a>
				</div>
				<div class="col-md-3">
					<p class="form__explainer">
						<small class="form-text text-muted">250 x 250 pixels<br>Max. upload size 2mb</small>
					</p>
				</div>
				<div class="modal" id="edit__round__bg__modal" tabindex="-1" role="dialog" aria-labelledby="edit__round__bg__modal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="modal__edit__image position-relative">
									<div class="modal__edit__image__mask"></div>
										<img id="blah" style="display:block;margin-left:auto;margin-right:auto;" class="modal__edit__image__image" src="#">
								</div>
								<div class="modal__edit__image__range">
									<div class="form-row align-items-center">
										<div class="col-3">
											<label><small>Rotate</small></label>
										</div>
										<div class="col-9 d-flex">
											<div class="p-2 border d-flex align-items-center justify-content-center rounded">
												<button type="button" id="rotate"><i class="fas fa-undo"></i></button>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-3">
											<label for="formControlRange"><small>Edit size</small></label>
										</div>
										<div class="col-9">
											<input type="range" min="1" max="100" class="form-control-range" id="formControlRange">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer justify-content-center row no-gutters align-items-stretch">
								<div class="col-md-3 mr-0 mr-lg-1">
									<label class="d-block" for="upload__quiz__icon">Upload
										<input type="file" class="form-control-file" id="upload__quiz__icon" name="bg_image" value="Upload">
									</label>
								</div>
								<div class="col-md-3 ml-0 ml-lg-1 d-flex">
									<button type="submit" class="d-block btn btn-primary" data-dismiss="modal">Save</button>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- <div class="form-row justify-content-center pt-3">
				<div class="col-md-4">	
					<input class="justify-content-center px-4" type="submit" value="Save">
				
				</div>
			</div> -->
			</div>
		</article>
	</form>
<!-- QUESTION -->	
<div id="sections">
  <div class="section">
<form class="is_container row" id="add_round" action="/question" method="post" enctype="multipart/form-data" role="main">
@csrf	

		<article class="col-12 ">
<div class="article_question">
			<div class="article__heading">
				<h1>Question <span id="number"> 1</span></h1>
				
			</div>

			<div class="form-row mt-md-5 align-items-start align-items-lg-center">
				<div class="col-md-4">
					<label for="question__type">Question type</label>
				</div>
				<div class="col-md-8">
					<div class="row align-items-center">
						<div class="col-lg-6">
							<select id="question__type"  class="form-control question__type" name="question__type">
								<option value="standard__question">Standard</option>
								<option value="multiple__choice__question">Multiple choice</option>
								<option value="numeric__question">Numeric</option>

							</select>
						</div>
						<div class="col-lg-2 d-flex align-items-center justify-content-center">
							<p class="my-2 m-lg-0">OR</p>
						</div>
						<div class="col-lg-4">
							<a class="d-block btn btn-outline-primary suggested_q_link" href="#" data-toggle="modal" data-target="#suggestedQuestion"><span style="color:var(--orange)">Use a suggested question</span></a>
							<!-- The modal for this is at the bottom of the page -->
						</div>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-4">
					<label for="question">Question</label>
				</div>
				<div class="col-md-8">
					<input name="question" type="text" class="form-control">
				</div>
				@if ($errors->has('question'))
                        <span class="help-block">
                            <p>{{ $errors->first('question') }}</p>
                        </span>
                        @endif
			</div>
			<div class="form-row">
				<div class="col-md-4">
					<label>Add media</label>
				</div>
				<div class="col-md-8">
					<div class="row mt-3">
						<div class="col-md-4 pr-md-0 mb-3 mb-lg-0">
							<a href="#" class="px-4 btn btn-outline-secondary grey d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#add__image__media" data-title="Image" data-add-text="an image"><span class="pr-2 icon_"><i class="far fa-image"></i></span>Image </a>
						</div>
						<div class="col-md-4 pr-md-0 mb-3 mb-lg-0">
							<a href="#" class="px-4 btn btn-outline-secondary grey d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#add__audio__media" data-title="Audio" data-add-text="any audio file"><span class="pr-2 icon_"><i class="fas fa-music"></i></span>Audio </a></a>
						</div>
						<div class="col-md-4 pr-md-0 pr-md-3">
							<a href="#" class="px-4 btn btn-outline-secondary grey d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#add__video__media" data-title="Video" data-add-text="any video file"><span class="pr-2 icon_"><i class="fas fa-video"></i></span>Video </a></a>
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
 										<p class="text-center py-2">Add <span id="add__video__media__text"></span>to reference in your question</p>
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

			<div class="form-row d-flex standard__answer" id="standard__answer" >
				<div class="col-md-4">
					<label for="standard__question__answer">Answer</label>
				</div>
				<div class="col-md-8">
					<input class="form-control" name="standard__question__answer" type="text">
				</div>
			</div>
			<div class="form-row d-none numeric__answer" id="numeric__answer">
				<div class="col-md-4">
					<label for="numeric__question__answer">Answer</label>
				</div>
				<div class="col-md-8">
					<input class="form-control" name="numeric__question__answer" type="number">
				</div>
			</div>
			<div class="form-row d-none mb-n4 mb-md-4 multiple__choice__legend" style="min-height:0;" id="multiple__choice__legend">
				<div class="offset-9 offset-md-10 col-3 col-md-2">
					<small class="d-block text-center pl-4">Correct answer</small>
				</div>
			</div>
			<div class="form-row d-none multiple__choice__answer" id="multiple__choice__answer">
				<div class="col-md-4 align-self-start">
					<label for="multiple__choice__answer">Answer</label>
				</div>
				<div class="col-md-8">

					<div class="row multiple__choice__row pb-3 align-items-center">
						<div class="col-7 ">
							<input name="multiple__choice__answer__1" class="form-control" type="text">
						</div>
						<div class="col-1 justify-content-center p-0 d-flex">
							&nbsp;
						</div>
						<div class="col-1 justify-content-center">
							<span class="plus">+</span>
						</div>
						<div class="col-3 col-md-3 text-center form-check px-0 px-md-4">
							<input type="radio" class="" name="multiple__choice__correct__answer">
						</div>
					</div>

				</div>

			</div>
			<div class="form-row">
				<div class="col-md-4">
					<label for="time__limit">Time limit</label>
				</div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-4 pr-md-0">
							<input class="form-control" type="number" name="time__limit">
						</div>
						@if ($errors->has('time__limit'))
                        <span class="help-block">
                            <p>{{ $errors->first('time__limit') }}</p>
                        </span>
                        @endif
						
						<div class="col-md-2 text-right d-flex align-items-center justify-content-end">
							<small class="form-text text-muted mt-0">Seconds</small>
						</div>
						
					</div>
				</div>

			</div>
					
			 
			<!-- <div class="form-row justify-content-center pt-3">
				<div class="col-md-1">	
					<input class="justify-content-center" type="submit" value="Save">
				</div>
			</div> -->
			</div>
			
	</div>		
		
		</article>


		       
        
        <!-- Suggested Question modal -->
        <div class="modal" id="suggestedQuestion" tabindex="-1" role="dialog" aria-labelledby="suggestedQuestion" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content pb-4">
				
              <div class="modal-header justify-content-center border-0">
                <h1 class="modal-title" id="suggestedQuestionsHeading">Suggested Questions</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body categories d-flex w-100 pb-4">
                <div class="row suggested__categories px-3 w-100 no-gutters">

					@foreach($cat as $category)
						<div class="suggested_category__icon col-6 col-sm-4 text-center p-2">
							<div class="d-flex flex-column h-100 participants__choice justify-content-center align-items-center p-4">
								<div class="icon pb-2">
									<i class="far fa-futbol"></i>
								</div>
								<p class="">
									
									{{$category->category_name ?? ''}}
									
								</p>
							</div>
						</div>
					@endforeach
                </div>
              </div>
			  
              <div class="modal-body question_types d-none">
                <div class="row suggested__categories px-3 w-100">

                    <div class="suggested_category__icon col-6 text-center p-2">
						<div class="d-flex flex-column h-100 participants__choice justify-content-center align-items-center p-4">
							<div class="icon pb-2">
								<i class="fas fa-list-ul"></i>
							</div>
							<div class="suggested_category__icon col-6 text-center p-2">
								<div class="d-flex flex-column h-100 participants__choice justify-content-center align-items-center p-4">
									<div class="icon pb-2">
										<i class="far fa-image"></i>
									</div>
									<p class="">Image-based Q&amp;A</p>
								</div>
							</div>
							<div class="suggested_category__icon col-6 text-center p-2">
								<div class="d-flex flex-column h-100 participants__choice justify-content-center align-items-center p-4">
									<div class="icon pb-2">
										<i class="fas fa-music"></i>
									</div>
									<p class="">Audio-based Q&amp;A</p>
								</div>
							</div>
							<div class="suggested_category__icon col-6 text-center p-2">
								<div class="d-flex flex-column h-100 participants__choice justify-content-center align-items-center p-4">
									<div class="icon pb-2">
										<i class="fas fa-play"></i>
									</div>
									<p class="">Video-based Q&amp;A</p>
								</div>
							</div>

						</div>
                    </div>
                    
                </div>
              </div>


              <div class="modal-body questions d-none">
                <div class="row suggested__question px-3">
                    <ul class="all_suggested_questions list-unstyled p-0 m-0">
                        <li class="single__suggested__question text-body p-3 border rounded mb-4">

                            <div class="single__suggested__question__image position-relative">
                                <img src="../images/moscow__image.jpeg" class="w-100">
                                <div class="change__image position-absolute px-4 invisible">
                                    <label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change
                                        <input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload">
                                    </label>
                                </div>
                            </div>


                            <div class="single__suggested__question__attributes row pt-3">
								<div class="col-md-3 text-center d-flex align-items-center justify-content-center">
									<span class="pr-2">
										<i class="fa fa-clock"></i>
									</span>
								</div>
								<div class="col-md-9 d-flex align-items-center" style="height:48px">
									<p class="m-0"><span class="pr-2"><small><input class="form-control readonly edit__time__limit" readonly type="text" value="15">s</small></span>Time-limited</p>
								</div>
                                <div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2">
									<span class="pr-2"><i class="fas fa-list-ul"></i></span>
								</div>
								<div class="col-10 col-md-9 d-flex align-items-center">
									<p class="w-50 pr-0 m-0 pt-2">
										<select class="pr-5 disabled form-control" disabled id="suggested__question__type">
											<option value="multiple">Multiple choice</option>
											<option value="text">Text</option>
											<option value="numeric">Numeric</option>
										</select>
									</p>
								</div>
								<div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2">
									<span class="pr-2"><i class="far fa-image"></i></span>
								</div>
                                <div class="col-10 col-md-9 d-flex align-items-center">
									<p class="pr-0 w-50 m-0 pt-2">
										<select class="disabled form-control pr-5" disabled>
											<option>Image based</option>
											<option>Audio based</option>
											<option>Video based</option>
											<option>Standard Q&amp;A</option>
										</select>
									</p>
								</div>
                            </div>
                            <div class="single__suggested__question__question pt-4 row">
                                <p class="col-3"><span class="d-inline-block w-25">Question: </span></p>
                                <p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value="What is this capital city?"></p>
                            </div>
                            <div class="single__suggested__question__answer row pb-3">
								<div class="offset-3 col-9">
									<div class="form-row" style="min-height:0">
										<div class="offset-10 col">
											<small class="form-text text-center d-none correct_answer_heading">Correct:</small>
										</div>
									</div>
									<div class="single__suggested__question__attributes row pt-3">
										<div class="col-md-3 text-center d-flex align-items-center justify-content-center">
											<span class="pr-2">
												<i class="fa fa-clock"></i>
											</span>
										</div>
										<div class="col-md-9 d-flex align-items-center" style="height:48px">
											<p class="m-0"><span class="pr-2"><small><input class="form-control readonly edit__time__limit" readonly type="text" value="15">s</small></span>Time-limited</p>
										</div>
										<div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2">
											<span class="pr-2"><i class="fas fa-list-ul"></i></span>
										</div>
										<div class="col-10 col-md-9 d-flex align-items-center">
											<p class="w-50 pr-0 m-0 pt-2">
												<select class="pr-5 disabled form-control" disabled id="suggested__question__type">
													<option value="multiple">Multiple choice</option>
													<option value="text">Text</option>
													<option value="numeric">Numeric</option>
												</select>
											</p>
										</div>
										<div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center pt-2">
											<span class="pr-2"><i class="far fa-image"></i></span>
										</div>
										<div class="col-10 col-md-9 d-flex align-items-center">
											<p class="pr-0 w-50 m-0 pt-2">
												<select class="disabled form-control pr-5" disabled>
													<option>Image based</option>
													<option>Audio based</option>
													<option>Video based</option>
													<option>Standard Q&amp;A</option>
												</select>
											</p>
										</div>
									</div>
									<div class="single__suggested__question__question pt-4 row">
										<p class="col-3"><span class="d-inline-block w-25">Question: </span></p>
										<p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value="What is this capital city?"></p>
									</div>
									<div class="single__suggested__question__answer row pb-3">
										<div class="offset-3 col-9">
											<div class="form-row" style="min-height:0">
												<div class="offset-10 col">
													<small class="form-text text-center d-none correct_answer_heading">Correct:</small>
												</div>
											</div>
										</div>
										<p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p>
										<div class="col-9 the_answer">
											<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center">
												<div class="col input-group">
													<input name="multiple__choice__answer__1" class="form-control readonly" type="text" readonly value="Chisinau">
													<div class="input-group-prepend">
														<span class="input-group-text text-white border-danger bg-danger rounded-right d-none" id="basic-addon1"><i class="far fa-trash-alt"></i></span>
													</div>

												</div>
												<div class="col-2 text-center form-check d-none">
													<input readonly type="radio" class="readonly" name="multiple__choice__correct__answer">
												</div>
											</div>
											<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center">
												<div class="col input-group">
													<input name="multiple__choice__answer__1" class="form-control readonly" type="text" readonly value="Kiev">
													<div class="input-group-prepend">
														<span class="input-group-text text-white border-danger bg-danger rounded-right d-none" id="basic-addon1"><i class="far fa-trash-alt"></i></span>
													</div>
												</div>
												<div class="col-2 text-center form-check d-none">
													<input readonly type="radio" class="readonly" name="multiple__choice__correct__answer">
												</div>
											</div>
											<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center">
												<div class="col input-group">
													<input name="multiple__choice__answer__1" class="readonly form-control" type="text" readonly value="Moscow">
													<div class="input-group-prepend">
														<span class="input-group-text text-white border-danger bg-danger rounded-right d-none" id="basic-addon1"><i class="far fa-trash-alt"></i></span>
													</div>

												</div>
												<div class="col-2 text-center form-check d-none">
													<input readonly type="radio" checked class="readonly" name="multiple__choice__correct__answer">
												</div>
											</div>
											<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center">
												<div class="col input-group">
													<input name="multiple__choice__answer__1" class="form-control readonly" type="text" readonly value="Bucharest">
													<div class="input-group-prepend">
														<span class="input-group-text text-white border-danger bg-danger rounded-right d-none" id="basic-addon1"><i class="far fa-trash-alt"></i></span>
													</div>

												</div>
												<div class="col-2 text-center form-check d-none">
													<input readonly type="radio" class="readonly" name="multiple__choice__correct__answer">
												</div>
											</div>
											<div class=" align-items-center form-row">
												<div class="col-10 d-none">
													<a href="#" class="btn btn-primary d-block">Add answer</a>
												</div>
											</div>

										</div>
									</div>
									<div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center">
										<button class="btn btn-primary mr-1" data-dismiss="modal">Add question</button>
										<button class="btn btn-secondary ml-1 edit__question">Edit question</button>
									</div>
								</li>
								<li class="single__suggested__question text-body p-3 border rounded mb-4">
									<div class="single__suggested__question__image position-relative">
										<img src="../images/mozambique__flag.png" class="w-100">
										<div class="change__image position-absolute px-4 invisible">
											<label class="d-block m-0 border-0" for="upload__quiz__icon"><i class="fas fa-edit"></i> Change
												<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload">
											</label>
										</div>
									</div>
									<div class="single__suggested__question__attributes row pt-3">
										<div class="col-md-3 text-center d-flex align-items-center justify-content-center">
											<span class="pr-2">
												<i class="fa fa-clock"></i>
											</span>
										</div>
										<div class="col-md-9 d-flex align-items-center">
											<p><span class="pr-2"><small><input class="form-control readonly edit__time__limit" readonly type="text" value="15">s</small></span>Time-limited</p>
										</div>
										<div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center">
											<span class="pr-2"><i class="fas fa-list-ul"></i></span>
										</div>
										<div class="col-10 col-md-9 d-flex align-items-center">
											<p>
												<select class="pr-2 disabled form-control" disabled id="suggested__question__type">
													<option value="multiple">Multiple choice</option>
													<option value="text">Text</option>
													<option value="numeric">Numeric</option>
												</select>
											</p>
										</div>
										<div class="col-2 col-md-3 text-center d-flex align-items-center justify-content-center">
											<span class="pr-2"><i class="far fa-image"></i></span>
										</div>
										<div class="col-10 col-md-9 d-flex align-items-center">
											<p class="pr-0">
												<select class="disabled form-control" disabled>
													<option>Image based</option>
													<option>Audio based</option>
													<option>Video based</option>
													<option>Standard Q&amp;A</option>
												</select>
											</p>
										</div>
									</div>
									<div class="single__suggested__question__question pt-4 row">
										<p class="col-3"><span class="d-inline-block w-25">Question: </span></p>
										<p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value="What country's flag is this?"></p>
									</div>
									<div class="single__suggested__question__answer row pb-3">
										<div class="offset-3 col-9">
										</div>
									</div>
									<div class="single__suggested__question__question pt-4 row">
										<p class="col-3"><span class="d-inline-block w-25">Question: </span></p>
										<p class="col-9 the_question"><input type="text" class="form-control readonly" readonly value="What country's flag is this?"></p>
									</div>
									<div class="single__suggested__question__answer row pb-3">
										<div class="offset-3 col-9">
											<div class="form-row" style="min-height:0">
												<div class="offset-10 col">
													<small class="form-text text-center d-none correct_answer_heading">Correct:</small>
												</div>
											</div>
										</div>
										<p class="col-3"><span class="d-inline-block w-25 answers__label">Answers: </span></p>
										<div class="col-9 the_answer">
											<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center">
												<div class="col input-group">
													<input name="multiple__choice__answer__1" class="form-control readonly" type="text" readonly value="Madagascar">
													<div class="input-group-prepend">
														<span class="input-group-text text-white border-danger bg-danger rounded-right d-none" id="basic-addon1"><i class="far fa-trash-alt"></i></span>
													</div>

												</div>
												<div class="col-2 text-center form-check d-none">
													<input readonly type="radio" class="readonly" name="multiple__choice__correct__answer">
												</div>
											</div>
											<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center">
												<div class="col input-group">
													<input name="multiple__choice__answer__1" class="form-control readonly" type="text" readonly value="Mozambique">
													<div class="input-group-prepend">
														<span class="input-group-text text-white border-danger bg-danger rounded-right d-none" id="basic-addon1"><i class="far fa-trash-alt"></i></span>
													</div>
												</div>
												<div class="col-2 text-center form-check d-none">
													<input readonly type="radio" class="readonly" name="multiple__choice__correct__answer">
												</div>
											</div>
											<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center">
												<div class="col input-group">
													<input name="multiple__choice__answer__1" class="readonly form-control" type="text" readonly value="Chad">
													<div class="input-group-prepend">
														<span class="input-group-text text-white border-danger bg-danger rounded-right d-none" id="basic-addon1"><i class="far fa-trash-alt"></i></span>
													</div>

												</div>
												<div class="col-2 text-center form-check d-none">
													<input readonly type="radio" checked class="readonly" name="multiple__choice__correct__answer">
												</div>
											</div>
											<div class="form-row multiple__choice__row__in_modal pb-0 mb-2 align-items-center">
												<div class="col input-group">
													<input name="multiple__choice__answer__1" class="form-control readonly" type="text" readonly value="South Sudan">
													<div class="input-group-prepend">
														<span class="input-group-text text-white border-danger bg-danger rounded-right d-none" id="basic-addon1"><i class="far fa-trash-alt"></i></span>
													</div>

												</div>
												<div class="col-2 text-center form-check d-none">
													<input readonly type="radio" class="readonly" name="multiple__choice__correct__answer">
												</div>
											</div>
											<div class=" align-items-center form-row">
												<div class="col-10 d-none">
													<a href="#" class="btn btn-primary d-block">Add answer</a>
												</div>
											</div>

										</div>
									</div>
									<div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center">
										<button class="btn btn-primary mr-1" data-dismiss="modal">Add questions</button>
										<button class="btn btn-secondary ml-1 edit__question">Edit question</button>

									</div>
                                    
                                </div>
                            </div>
                            <div class="single__suggested__question__footer border-top pt-3 d-flex justify-content-center align-items-center">
                                <button class="btn btn-primary mr-1" data-dismiss="modal">Add questions</button>
								<button class="btn btn-secondary ml-1 edit__question">Edit question</button>
								
                            </div>
                        </li>
                        
                    </ul>
                </div>
              </div>

            </div>
          </div>
        </div>
	
		
	</form>
	</div>
	</div>
	<div class="button__holder w-100 pt-0 mt-5 justify-content-center d-md-flex" id="add-new-question">
			
			<div class="col-md-4 p-0">
				<a class="btn btn-white d-block" id="addQuestion" href="#">Add Question</a>
			</div>

	</div>
	<section class="row round__page__buttons justify-content-center align-items-center pt-5 mt-5 border-top">
		<div class="col-md-4 mb-3 mb-md-0 px-0 px-md-4" id="add-new-round">
			<a href="/addround/{{$id  ?? '1'}}" class="btn btn-secondary d-block" id="nextRound"><span class="pr-3"><i class="fa fa-plus"></i></span>Next round</a>
		</div>
		<div class="col-md-4 px-0 px-md-4">
			<a href="#" data-toggle="modal" data-target="#publishQuizModal" class="btn btn-primary d-block">Publish Quiz</a>
		</div>
	</section>
</section>

@endsection

@section('footer_scripts')
@include('scripts.bg-image');
@endsection