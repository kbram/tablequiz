@extends('layouts.tablequizapp')


@section('content')

<section class="container page__inner">
	<div class="row">
		<article class="col-12">
			<div class="article__heading">
				<h1>Quiz Setup</h1>
			</div>		
			<form id="quiz__setup" action="/setup/update/{{$quiz->id}}"  enctype="multipart/form-data" method="post" class="pt-2 pt-lg-4">
				@csrf
<!-- QUIZ NAME -->
				<div class="form-row">
					<div class="col-md-4">
						<label for="quiz__name">Quiz name</label>
					</div>
					<div class="col-md-8">
						<input autocomplete="nothanks" type="text" name="quiz__name" class="form-control" value="{{ ($quiz->quiz__name != '' ? $quiz->quiz__name : '') }}">
					</div>
				</div>
<!-- QUIZ PASSWORD -->
				<div class="form-row">
					<div class="col-md-4">
						<label for="quiz__password">Quiz password</label>
					</div>
					<div class="col-md-8">
						<input type="text" name="quiz__password" class="form-control" placeholder="(optional)" value="{{ ($quiz->quiz_password != '' ? $quiz->quiz_password : '') }}">
					</div>
				</div>
<!-- QUIZ LINK -->
				<div class="form-row">
					<div class="col-md-4">
						<label for="quiz__link">Quiz link</label>
						<span class="helper__text" data-placement="left"
							  data-toggle="tooltip" title="This link is automatically generated from your Quiz name. Share easily with Quiz participants"><i class="fa fa-info-circle"></i></span>
					</div>
					<div class="col-sm flex-grow-0">
						<p class="disabled__text">TableQuiz.app/</p>
					</div>

					<div class="col-sm">
						<input type="text" name="quiz__link" class="form-control" value="{{ ($quiz->quiz_link != '' ? $quiz->quiz_link : '') }}">
						<input tabindex="-1" type="text" id="full__uri">
					</div>
					<span class="copy__icon quiz__link" id="copy" title="Copy text"><i class="fa fa-copy"></i></span>
				</div>
<!-- QUIZ ICON -->
				<div class="form-row">
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
								<div class="modal__edit__size" id="img-wrapper">
								<img class="modal__edit__image__image imagePreview" src="{{ $image }}" id="image_preview_container" name="image_preview_container" style="display:block;margin-left:auto;margin-right:auto;">
								</div>

							</div>
							<div class="modal__edit__image__range">
								<div class="form-group">
									<label for="formControlRangesize">Edit size</label>
									<input type="range" class="form-control-range formControlRange "  id="formControlRange" name="formControlRange" min="1" max="100">
									<div id="demo" class="d-none"></div>
								  </div>
							</div>
						  </div>
						  <div class="modal-footer justify-content-center row no-gutters">
							 <div class="col-md-3"> 
								 <label class="d-block" for="upload__quiz__icon">Upload 
									<input type="file" class="form-control-file imagePreviewInput" name="upload__quiz__icon"  id="upload__quiz__icon"  value="Upload">
								</label>
							</div>
							<div class="col-md-3">
								<button type="button" class="d-block btn btn-primary"data-dismiss="modal">Save</button>
							</div>
						  </div>
						</div>
					  </div>
					</div>
				</div>

			
<!-- QUIZ PARTICIPANTS -->

				<div class="form-row">
					<div class="col-md-4">
						<label for="quiz__participants">No.of participants</label>
					</div>
					<div class="col-md-4">
						<select id="quiz__participants" class="form-control" name="quiz__participants">
						<option selected>{{($quiz->no_of_participants != '' ? $quiz->no_of_participants : 'Please Choose...')}}</option>
							@foreach($bands as $band)
								@if(($band->band_type)== "participants costs")
									@if(($band->to)== null)
										<option class="{{$band->from}}" value="{{$band->from}}">{{$band->from}}+</option>
									@else
										<option class="{{$band->from}}-{{$band->to}}" value="{{$band->from}}-{{$band->to}}" >{{$band->from}}-{{$band->to}}</option>
									@endif
								@endif
							@endforeach

						</select>
						@if ($errors->has('quiz__participants'))
                                    <span class="help-block">
                                            <p>{{ $errors->first('quiz__participants') }}</p>
                                    </span>
                        @endif
						
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
								@foreach($bands as $band)
									@if(($band->band_type)== "participants costs")
										<div class="col-6 col-sm-4 participants__number p-1">
											<div class="participants__choice p-3" >
												@if(($band->to)== null)
													<input type="text" hidden class="participant" value="{{$band->from}}+" >{{$band->from}}+</input>
												@else
													<input type="text" hidden class="participant" value="{{$band->from}}-{{$band->to}}" >{{$band->from}}-{{$band->to}}</input>
												@endif


												@if(($band->cost)!= 0)
												<p>{{$band->cost}}</p>
												@else
												<p>Free</p>
												@endif
											</div>
										</div>
									@endif
								@endforeach
								
						  </div>
						  <div class="modal-footer justify-content-center row no-gutters">
							<div class="col-md-3">
								<button type="button" class="d-block btn btn-primary" data-dismiss="modal">Save</button>
							</div>
						  </div>
						</div>
					  </div>
					</div>
				</div>
				
				
				
<!-- END -->			
				<div class="form-row form-footer">
					<div class="text-center offset-md-4 col-md-4">
						<input class="d-block btn btn-success hasArrow" type="submit" value="Save">
					</div>
				</div>
			</form>

	      <div class="text-center offset-md-4 col-md-4">
						<a href="/round/edit/{{$quiz->id}}" class="btn btn-primary d-block">Edit Round</a>
				</div>
		</article>
	</div>
	
	</section>
	
@endsection
@include('scripts.quiz-icon-preview')

@section('footer_scripts')

<script>    

$('.participants__choice').click(function() {

var val =$(this).find('.participant').val();

$('#quiz__participants option[value='+val+']').attr("selected",true).change();


});

		
</script>y

@endsection