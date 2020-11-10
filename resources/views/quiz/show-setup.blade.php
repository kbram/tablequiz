@extends('layouts.tablequizapp')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<section class="container page__inner">
	<div class="row ">
		<article class="col-12 ">
			<div class="article__heading">
				<h1>View Quiz  </h1>
			</div>		
			<form class="pt-2 pt-lg-4 text-center" >
			@csrf
                
<!-- QUIZ NAME -->

<div class="form-row ">
					<div class="col-md-4">
						<label for="quiz__name">Author name</label>
					</div>
					<div class="col-md-8">
					<p class="disabled__text"> {{$quizzes->user->name}} </p>

					
					
					</div>
			
					
				</div>

				<div class="form-row">
					<div class="col-md-4">
						<label for="quiz__name">Quiz name</label>
					</div>
					<div class="col-md-8">
					<p class="disabled__text"> {{$quizzes->quiz__name}} </p>

					
					
					</div>
			
					
				</div>
<!-- QUIZ PASSWORD -->
				<div class="form-row">
					<div class="col-md-4">
						<label for="quiz__password">Rounds</label>
					</div>
					<div class="col-md-8">
					<p class="disabled__text"> {{$quizzes->rounds->count()}} </p>

					</div>
				</div>

				<div class="form-row">
					<div class="col-md-4">
						<label for="quiz__password">Questions</label>
					</div>
					<div class="col-md-8">
						<p class="disabled__text"> {{$quizzes->questions->count()}} </p>
					</div>
				</div>

				<div class="form-row">
					<div class="col-md-4">
						<label for="quiz__password">No.of participants</label>
					</div>
					<div class="col-md-8">
						<p class="disabled__text"> {{$quizzes->no_of_participants}} </p>
					</div>
				</div>
<!-- QUIZ LINK -->
				<!-- <div class="form-row">
					<div class="col-md-4">
						<label for="quiz__link">Quiz link</label>
					</div>
					<div class="col-sm flex-grow-0">
						<p class="disabled__text">TableQuiz.app/{{$quizzes->quiz_link}}</p>
					</div>
					<div class="col-md-8 text-center">
						<input type="text" hidden name="quiz__link" class="form-control" value="{{$quizzes->quiz_link}}" disabled>
						
						<input tabindex="-1" type="text" id="full__uri">
					</div>
					 <span class="copy__icon quiz__link" id="copy" title="Copy text"><i class="fa fa-copy"></i></span> -->
				
<!-- QUIZ ICON -->
				<!-- <div class="form-row">
					<div class="col-md-4">
						<label>Quiz icon</label>
					</div>
					<div class=" col-md-4">
						<a href="#" class="d-block btn btn-outline-secondary" data-toggle="modal" data-target="#edit__icon__modal">Upload</a>
					</div>
					<div class="col-md-3">
						<p class="form__explainer">
							<small>250 x 250 pixels<br>Max. upload size 2mb</small>
						</p>
					</div>
					<div class="modal" id="edit__icon__modal" tabindex="-1" role="dialog" aria-labelledby="edit__icon__modal" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						  </div>
						  <div class="modal-body">
							<div class="modal__edit__image">
								<div class="modal__edit__image__mask"></div>
								<img class="modal__edit__image__image" src="{{ $image }}" id="image_preview_container" value="{{ old('image_preview_container') }}" >
							</div>
							<div class="modal__edit__image__range">
								<div class="form-group">
									<label for="formControlRange">Edit size</label>
									<input type="range" class="form-control-range" id="formControlRange">
									<div id="demo" class="d-none"></div>
								  </div>
							</div>
						  </div>
						  <div class="modal-footer justify-content-center row no-gutters">
							 <div class="col-md-3"> 
								 <label class="d-block" for="upload__quiz__icon">Upload
									<input type="file"  class="form-control-file" id="upload__quiz__icon" name="upload__quiz__icon" value="Upload" disabled>
								</label>
							</div>
							<div class="col-md-3">
								<button type="button" class="d-block btn btn-primary"data-dismiss="modal">Save</button>
							</div>
						  </div>
						</div>
					  </div>
					</div>
				</div> -->



<!-- QUIZ PARTICIPANTS -->
				<!-- <div class="form-row">
					<div class="col-md-4">
						<label for="quiz__participants">No.of participants</label>
					</div>
					<div class="col-md-4">
					<p class="disabled__text">{{$quizzes->no_of_participants}}</p>

						
						
					</div>
					<div class="modal" id="select_participants__modal" tabindex="-1" role="dialog" aria-labelledby="select_participants__modal" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
						  <div class="modal-header justify-content-center">
							  <h1>No. of participants</h1>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						  </div>
						  <div class="modal-body row no-gutters participants">
						  @foreach($participants as $participant)
						  <div class="col-6 col-sm-4 participants__number p-1">
									<div class="participants__choice p-3">
										 @if(($participant->from) && ($participant->to)== null)
										    <p>{{$participant->from}}+</p>
										 @else
										    <p>{{$participant->from}}-{{$participant->to}}</p>
										 @endif


										@if(($participant->cost)!= 0)
										   <p>{{$participant->cost}}</p>
										@else
										   <p>Free</p>
										@endif
									</div>
								</div>
						  @endforeach
								
							
						  </div> -->
						  
						  <div class="form-row form-footer d-flex justify-content-center">
					<div class="text-center m-2">
					<a href="/admin/quizzes" type="button" class="d-block btn btn-secondary hasArrow">Back</a>
						<!-- <input class="d-block btn btn-secondary hasArrow" type="submit" value="Save"> -->
					</div>
					<div class="text-center m-2">
						<a href="/round/show/{{$id}}/1" class="btn btn-primary d-block ">Show Round</a>
					</div>
				</div>
						</div>
					  </div>
					</div>
				</div>
				
				
<!-- END -->				
				<!-- <div class="form-row form-footer">
					<div class="text-center offset-md-4 col-md-4">
						<button class="d-block btn btn-primary hasArrow" type="submit" value="Next">Back</button>
					</div>
				</div> -->
			</form>
	
	<script>
	function readURL(input) {
  	if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#image_preview_container').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#upload__quiz__icon").change(function() {
  readURL(this);
});
	</script>
	
	
	
	
		</article>
	</div>
	</section>
	
@endsection

@section('footer_scripts')

@endsection