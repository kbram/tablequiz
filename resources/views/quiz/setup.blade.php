@extends('layouts.tablequizapp')
@section('content')

<section class="container page__inner">
	<div class="row">
		<article class="col-12">
			<div class="article__heading">
				<h1>Quiz Setup</h1>
			</div>		
			<form action="/quiz" method="post" enctype="multipart/form-data" class="pt-2 pt-lg-4" >
			@csrf

<!-- QUIZ NAME -->
				<div class="form-row">
					<div class="col-md-4">
						<label for="quiz__name">Quiz name</label>
					</div>
					<div class="col-md-8">
						<input autocomplete="nothanks" type="text" name="quiz__name" class="form-control" value="{{ old('quiz__name') }}">
					
						@if ($errors->has('quiz__name'))
                                    <span class="help-block">
                                            <p>{{ $errors->first('quiz__name') }}</p>
                                    </span>
                        @endif
					</div>
			
					
				</div>
<!-- QUIZ PASSWORD -->
				<div class="form-row">
					<div class="col-md-4">
						<label for="quiz__password">Quiz password</label>
					</div>
					<div class="col-md-8">
						<input type="text" name="quiz__password" class="form-control" placeholder="(optional)" >
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
						<input type="text" name="quiz__link" class="form-control" value="{{ old('quiz__link') }}">
						@if ($errors->has('quiz__link'))
                                    <span class="help-block">
                                            <p>{{ $errors->first('quiz__link') }}</p>
                                    </span>
                        @endif
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
								<img class="modal__edit__image__image" src="" id="image_preview_container">
								</div>
							</div>
							<div class="modal__edit__image__range">
								<div class="form-group">
									<label for="formControlRange">Edit size</label>
									<input type="range" class="form-control-range" id="formControlRange" class="slider" >
									<div id="demo" class="d-none"></div>
								  </div>
							</div>
						  </div>
						  <div class="modal-footer justify-content-center row no-gutters">
							 <div class="col-md-3"> 
								 <label class="d-block" for="upload__quiz__icon">Upload
									<input type="file"  class="form-control-file" id="upload__quiz__icon" name="upload__quiz__icon" value="Upload">
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
							<option disabled selected>{{(old('quiz__participants') != '' ? old('quiz__participants') : 'Please Choose...')}}</option>
							<option value="1-5">1-5</option>
							<option value="5-9">5-9</option>
							<option value="10-19">10-19</option>
							<option value="20-29">20-29</option>
							<option value="30-49">30-49</option>
							<option value="50+">50+</option>
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
								<!-- <div class="col-6 col-sm-4 participants__number p-1">
									<div class="participants__choice p-3">
										<p>1-5</p>
										<p>Free</p>
									</div>
								</div>
								<div class="col-6 col-sm-4 participants__number p-1">
									<div class="participants__choice p-3">
										<p>5-9</p>
										<p>Free</p>
									</div>
								</div>
								<div class="col-6 col-sm-4 participants__number p-1">
									<div class="participants__choice p-3">
										<p>10-19</p>
										<p>€4.99</p>
									</div>
								</div>
								<div class="col-6 col-sm-4 participants__number p-1">
									<div class="participants__choice p-3">
										<p>20-29</p>
										<p>€9.99</p>
									</div>
								</div>
								<div class="col-6 col-sm-4 participants__number p-1">
									<div class="participants__choice p-3">
										<p>30-49</p>
										<p>€19.99</p>
									</div>
								</div>
								<div class="col-6 col-sm-4 participants__number p-1">
									<div class="participants__choice p-3">
										<p>50+</p>
										<p>€29.99</p>
									</div>
								</div> -->
						  </div>
						  <div class="modal-footer justify-content-center row no-gutters">
							<div class="col-md-3">
								<button type="button" class="d-block btn btn-primary"data-dismiss="modal">Save</button>
							</div>
						  </div>
						</div>
					  </div>
					</div>
				</div>
				
				
<!-- END -->				
				<div class="form-row form-footer">
					<div class="text-center offset-md-4 col-md-4">
						<button class="d-block btn btn-primary hasArrow" type="submit" value="Next">Next</button>
					</div>
				</div>
			</form>
			
		</article>
	</div>
	</section>
	
@endsection

@section('footer_scripts')
@include('scripts.quiz-icon-preview')

@endsection