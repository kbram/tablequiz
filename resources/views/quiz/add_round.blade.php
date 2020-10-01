@extends('layouts.tablequizapp')
@section('template_linked_css')
<style>
	#round_image{
		transform-origin: top left;
		-webkit-transform-origin: top left;
		-ms-transform-origin: top left;
	}

	.rotate90 {
		transform: rotate(90deg) translateY(-100%);
		-webkit-transform: rotate(90deg) translateY(-100%);
		-ms-transform: rotate(90deg) translateY(-100%);
	}

	.rotate180 {
		transform: rotate(180deg) translate(-100%, -100%);
		-webkit-transform: rotate(180deg) translate(-100%, -100%);
		-ms-transform: rotate(180deg) translateX(-100%, -100%);
	}

	.rotate270 {

		transform: rotate(270deg) translateX(-100%);
		-webkit-transform: rotate(270deg) translateX(-100%);
		-ms-transform: rotate(270deg) translateX(-100%);
	}
</style>

@endsection
@section('content')
<script src='jquery-3.2.1.min.js'></script> 

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<section class="container page__inner">

<form id="add_round" action="/round" method="post" enctype="multipart/form-data" role="main" >
		 @csrf
<div class="is_container row" >

		<article class="col-12 ">

			<div class="article__heading">
				<h1>Round {{$round_count ?? '1'}} Setup</h1>
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
					<input type="text" name="round_name"  class="form-control" required="true">
					<input hidden autocomplete="nothanks" type="text" name="round_count" class="form-control" value="{{$round_count ?? '1'}}">
					<input hidden autocomplete="nothanks" type="text" name="quiz" class="form-control" value="{{$quiz}}">

				</div>
			</div>
			<div class="form-row">
				<div class="col-md-4">
					<label for="round__background">Round background</label>
					<span class="helper__text" data-placement="left" data-toggle="tooltip" title="You can add background images to each round you create by uploading the image here."><i class="fa fa-info-circle"></i></span>
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
								   <!-- <img class="modal__edit__image__image position-relative" id="round_image" style="display:block;margin-left:auto;margin-right:auto;" src="#"> -->
								   <!-- <base href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/"> -->
										<div id="image-container">
											<img src="" id="round_image" alt=''>
										</div>	
								   <div class="modal__edit__image__mask"></div>
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
											<!-- <input type="range" min="1" max="100" class="form-control-range" id="formControlRange"> -->
											<input type="range" class="form-control-range slider" min="1" max="4" value="1" step="0.1" id="zoomer" oninput="deepdive()">

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
									<button id="pro" type="submit" class="d-block btn btn-primary" data-dismiss="modal">Save</button>

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
			</div>
</div>
		</article>
	<!-- </form> -->
<!-- QUESTION -->	
<div id="sections">
  <div class="section">
<!-- <form class="is_container row" id="add_round" action="/question" method="post" enctype="multipart/form-data" role="main">
@csrf	 -->

		<article class="col-12 article ">
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
							<select id="question__type"  class="form-control question__type" name="question__type[]" required>
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
					<input name="question[]" type="text" class="form-control question" required > 
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
					</div>

				<div class="modal" id="add__image__media" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
 								  <div class="modal-dialog" role="document">
 									<div class="modal-content">
 									  <div class="modal-header">
 										<h1 class="modal-title" id="add__image__media__modal__heading"></h1>
 										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 										  <span aria-hidden="true">&times;</span>
 										</button>
 									  </div>
 									  <div class="modal-body">
 										<p class="text-center py-2">Add <span id="add__image__media__text"></span> to reference in your question</p>
 										<div class="form-row">
 											<div class="col-md-4">
 												<label>Add link image</label>
 											</div>
 											<div class="col-md-8">
 												<input type="url" name="add_link_to_image__media__0" class="form-control add-image-media-link" value="" id="add__image__media__text">
 											</div>
 										</div>
 										<div class="text-center w-100">
 											 <span>OR</span>
 										</div>
 										<div class="form-row justify-content-center pt-3">
 											<div class="col-md-3">	
 											   <label class="d-block" for="upload__image__media__file">Upload
 													<input type="file" class="form-control-file " id="upload__image__media__file" value="Upload" name="image_media_0">
 												</label>
 											</div>
 										</div>
 									  </div>
									 
 									  <div class="modal-footer justify-content-center">
 										  <div class="col-sm-4">
 											<button id="pro1" type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button>
 										  </div>
 									  </div>
 									</div>
 								  </div>
 								</div>

                             	<div class="modal" id="add__audio__media" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
 								  <div class="modal-dialog" role="document">
 									<div class="modal-content">
 									  <div class="modal-header ">
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
												<input type="url" name="add_link_to_audio__media__0" class="form-control add-audio-media-link" id="add__audio__media__text">
 											</div>
 										</div>
 										<div class="text-center w-100">
 											 <span>OR</span>
 										</div>
 										<div class="form-row justify-content-center pt-3">
 											<div class="col-md-3">	
 											   <label class="d-block" for="upload__audio__media__file">Upload
 													<input type="file" class="form-control-file" id="upload__audio__media__file" value="Upload" name="audio_media_0">
 												</label>
 											</div>
 										</div>
 									  </div>
 									  <div class="modal-footer justify-content-center">
 										  <div class="col-sm-4">
 											<button id="pro2" type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button>
 										  </div>
 									  </div>
 									</div>
 								  </div>
 								</div>
 								<div class="modal" id="add__video__media" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
 								  <div class="modal-dialog" role="document">
 									<div class="modal-content">
 									  <div class="modal-header ">
 										<h1 class="modal-title" id="add__video__media__modal__heading"></h1>
 										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 										  <span aria-hidden="true">&times;</span>
 										</button>
 									  </div>
 									  <div class="modal-body">
 										<p class="text-center py-2">Add <span id="add__video__media__text"></span>to reference in your question</p>
 										<div class="form-row">
 											<div class="col-md-4">
 												<label>Add link video</label>
 											</div>
 											<div class="col-md-8">
											<input type="url" name="add_link_to_video__media__0" class="form-control add-video-media-link" id="add__video__media__text">
 											</div>
 										</div>
 										<div class="text-center w-100">
										 <span>OR</span>
 										</div>
 										<div class="form-row justify-content-center pt-3">
 											<div class="col-md-3">	
 											   <label class="d-block" for="upload__video__media__file">Upload
 													<input type="file" class="form-control-file" id="upload__video__media__file" value="Upload" name="video_media_0">
 												</label>
 											</div>
 										</div>
 									  </div>
 									  <div class="modal-footer justify-content-center">
 										  <div class="col-sm-4">
 											<button id="pro3" type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button>
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
					<input class="form-control answer" name="standard__question__answer__0" type="text" required>
				</div>
			</div>
			<div class="form-row d-none numeric__answer" id="numeric__answer">
				<div class="col-md-4">
					<label for="numeric__question__answer">Answer</label>
				</div>
				<div class="col-md-8">
					<input class="form-control" name="numeric__question__answer__0" type="number" >
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
				<div class="col-md-8 multi-choice">

					<div class="row multiple__choice__row   pb-3 align-items-center">
						<div class="col-7">
							<input name="multiple__choice__answer__0[]" class="multiple-choice-answer form-control first-multi-answer" type="text">
						</div>
						<div class="col-1 justify-content-center p-0 d-flex">
							&nbsp;
						</div>
						<div class="col-1 justify-content-center">
							<span class="plus">+</span>
						</div>
						<div class="col-3 col-md-3 text-center form-check px-0 px-md-4">
							<input type="radio" value="0" class="multiple-choice-correct-answer" name="multiple__choice__correct__answer__0">
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
							<input class="form-control time-limit" type="number" name="time__limit[]">
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

						<div class="modal-header  border-0 row">
							<div class="col-sm-2">
								<button type="button" id="suggested__modal__back" class="p-2" style="background-color: transparent;float:left;padding: 0;border: 0;">
									<i class="fas fa-angle-left"></i>
								</button>
							</div>
							<div class="col-sm-8"><h1 class="modal-title " align="center" id="suggestedQuestionsHeading">Suggested Questions</h1></div>
							<div class="col-sm-2">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
						<div class="modal-body categories d-flex w-100 pb-4">
							<div class="row suggested__categories px-3 w-100 no-gutters">

								@foreach($categories as $category)
								<div id="{{$category->id}}" class="suggested__category suggested_category__icon col-6 col-sm-4 text-center p-2" data-id="{{$category->id}}">
									<div class="d-flex flex-column h-100 participants__choice justify-content-center align-items-center p-4">
										<div class="icon pb-2">
											<i class="far fa-futbol"></i>
										</div>
										<p id="{{$category->category_name}}">

											{{$category->category_name}}

										</p>
									</div>
								</div>
								</a>
								@endforeach
							</div>
						</div>

						<div class="modal-body question_types d-none">
							<div class="row suggested__categories px-3 w-100">


								<div id="standard-q" class="suggested_category__icon col-6 text-center p-2">
									<div class="d-flex flex-column h-100 participants__choice justify-content-center align-items-center p-4">
										<div class="icon pb-2">
											<i class="fas fa-list-ul"></i>
										</div>
										<p class="">Standard Q&amp;A</p>
									</div>
								</div>


								<div id="image-based-q" class="suggested_category__icon col-6 text-center p-2">
									<div class="d-flex flex-column h-100 participants__choice justify-content-center align-items-center p-4">
										<div class="icon pb-2">
											<i class="far fa-image"></i>
										</div>
										<p class="">Image-based Q&amp;A</p>
									</div>
								</div>


								<div id="audio-based-q" class="suggested_category__icon col-6 text-center p-2">
									<div class="d-flex flex-column h-100 participants__choice justify-content-center align-items-center p-4">
										<div class="icon pb-2">
											<i class="fas fa-music"></i>
										</div>
										<p class="">Audio-based Q&amp;A</p>
									</div>
								</div>


								<div id="video-based-q" class="suggested_category__icon col-6 text-center p-2">
									<div class="d-flex flex-column h-100 participants__choice justify-content-center align-items-center p-4">
										<div class="icon pb-2">
											<i class="fas fa-play"></i>
										</div>
										<p class="">Video-based Q&amp;A</p>
									</div>
								</div>

							</div>
						</div>

						<!-- kopi start working -->

						<div class="modal-body questions d-none">
							<div class="row suggested__question px-3">

								<ul class="all_suggested_questions list-unstyled p-0 m-0">

									<!-- kopi start finished -->


								</ul>
							</div>
						</div>

					</div>
				</div>
			</div>
	
	</div>
	</div>
	<div class="button__holder w-100 pt-0 mt-5 justify-content-center d-md-flex" id="add-new-question">

		<div class="col-md-4 p-0">
			<a class="btn btn-white d-block" id="addQuestion">Add Question</a>
		</div>

	</div>

	<section class="row round__page__buttons justify-content-center align-items-center pt-5 mt-5 border-top">
		<div class="col-md-4 mb-3 mb-md-0 px-0 px-md-4" id="add-new-round">
			<button type="submit"  class="btn btn-secondary d-block" id="nextRound"><span class="pr-3"><i class="fa fa-plus"></i></span>Next round</a>
		</div>
		<div class="col-md-4 px-0 px-md-4">
		<!--<button type="button"  class="btn btn-primary d-block" id="publish-quiz">Publish Quiz</a>-->
		<a href="#" data-toggle="modal" id="publish-quiz" data-target="#publishQuizModal" class="btn btn-primary d-block publish-quiz">Publish Quiz</a>
		</div>
	</section>
	</form>
</section>

@endsection

@section('footer_scripts')
<script>    
var size=2000;
$('#upload__quiz__icon').on('change', function() { 
	size=this.files[0].size;
}); 
$("#pro").click(function(){
	var s=$('#upload__quiz__icon').val();
	s=Math.round(size/100);
	if(s=="" ){

	}else{
		let timerInterval
		Swal.fire({
		title: 'File Uploading!',
		html: 'please wait <br><b></b> kb remaining',
		timer: s,
		timerProgressBar: true,
		onBeforeOpen: () => {
			Swal.showLoading()
			timerInterval = setInterval(() => {
			const content = Swal.getContent()
			if (content) {
				const b = content.querySelector('b')
				if (b) {
				b.textContent = Swal.getTimerLeft()
				}
			}
			}, 100)
		},
		onClose: () => {
			clearInterval(timerInterval)
		}
		}).then((result) => {
		/* Read more about handling dismissals below */
		if (result.dismiss === Swal.DismissReason.timer) {
			console.log('I was closed by the timer')
		}
		})
	}
});

var size1=2000;
$('#upload__image__media__file').on('change', function() { 
	size1=this.files[0].size;
}); 

$("#pro1").click(function(){
	var s=$('#upload__image__media__file').val();
	var s1=$('#add__image__media__text').val();
	s=Math.round(size1/100);
	if(s=="" && s1==""){

	}else{
		let timerInterval
		Swal.fire({
		title: 'File Uploading!',
		html: 'please wait <br><b></b> kb remaining',
		timer: s,
		timerProgressBar: true,
		onBeforeOpen: () => {
			Swal.showLoading()
			timerInterval = setInterval(() => {
			const content = Swal.getContent()
			if (content) {
				const b = content.querySelector('b')
				if (b) {
				b.textContent = Swal.getTimerLeft()
				}
			}
			}, 100)
		},
		onClose: () => {
			clearInterval(timerInterval)
		}
		}).then((result) => {
		/* Read more about handling dismissals below */
		if (result.dismiss === Swal.DismissReason.timer) {
			console.log('I was closed by the timer')
		}
		})
	}
});

var size2=2000;

$('#upload__audio__media__file').on('change', function() { 
	size2=this.files[0].size;
}); 

$("#pro2").click(function(){
	var s=$('#upload__audio__media__file').val();
	var s1=$('#add__audio__media__text').val();
	s=Math.round(size2/100);
	if(s=="" && s1==""){

	}else{
		let timerInterval
		Swal.fire({
		title: 'File Uploading!',
		html: 'please wait <br><b></b> kb remaining',
		timer: s,
		timerProgressBar: true,
		onBeforeOpen: () => {
			Swal.showLoading()
			timerInterval = setInterval(() => {
			const content = Swal.getContent()
			if (content) {
				const b = content.querySelector('b')
				if (b) {
				b.textContent = Swal.getTimerLeft()
				}
			}
			}, 100)
		},
		onClose: () => {
			clearInterval(timerInterval)
		}
		}).then((result) => {
		/* Read more about handling dismissals below */
		if (result.dismiss === Swal.DismissReason.timer) {
			console.log('I was closed by the timer')
		}
		})
	}
});
var size3=2000;

$('#upload__video__media__file').on('change', function() { 
	size3=this.files[0].size;
}); 
$("#pro3").click(function(){
	var s=$('#upload__video__media__file').val();
	var s1=$('#add__video__media__text').val();
	s=Math.round(size3/100);
	if(s=="" && s1==""){

	}else{
		let timerInterval
		Swal.fire({
		title: 'File Uploading!',
		html: 'please wait <br><b></b> kb remaining',
		timer: s,
		timerProgressBar: true,
		onBeforeOpen: () => {
			Swal.showLoading()
			timerInterval = setInterval(() => {
			const content = Swal.getContent()
			if (content) {
				const b = content.querySelector('b')
				if (b) {
				b.textContent = Swal.getTimerLeft()
				}
			}
			}, 100)
		},
		onClose: () => {
			clearInterval(timerInterval)
		}
		}).then((result) => {
		/* Read more about handling dismissals below */
		if (result.dismiss === Swal.DismissReason.timer) {
			console.log('I was closed by the timer')
		}
		})
	}
});
</script>
@include('scripts.suggest')
@include('scripts.bg-image');
@include('scripts.payment');



@endsection