@extends('layouts.tablequizapp')


@section('content')

<section class="container page__inner">
	<div class="row">
		<article class="col-12">
			<div class="article__heading">
				<h1>Quiz Setup</h1>
			</div>		
			<form id="quiz__setup" action="/setup/update/{id}" class="pt-2 pt-lg-4">
				
<!-- QUIZ NAME -->
				<div class="form-row">
					<div class="col-md-4">
						<label for="quiz__name">Quiz name</label>
					</div>
					<div class="col-md-8">
						<input autocomplete="nothanks" type="text" name="quiz__name" class="form-control" value="{{ ($quiz->quiz_name != '' ? $quiz->quiz_name : '') }}">
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
								<img class="modal__edit__image__image" src="{{ $image }}">
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
									<input type="file" class="form-control-file" id="upload__quiz__icon" value="Upload">
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
<!-- QUIZ CHARGE ?-->
				<div class="form-row">
					<div class="col-md-4">
						<label>Charge for entry?</label>
						<span class="helper__text" data-placement="left"
							  data-toggle="tooltip" title="TableQuiz.app allows users to charge entry. Set custom amounts to easily collect for a charity or for prize money."><i class="fa fa-info-circle"></i></span>
					</div>
					<div class="col">
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="quiz__charge_entry" id="quiz_charge__yes" value="yes">
						  <label class="form-check-label" for="quiz_charge__yes">Yes</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="quiz__charge_entry" id="quiz_charge__no" value="no" checked>
						  <label class="form-check-label" for="quiz_charge__no">No</label>
						</div>
					</div>
					
				</div>
<!-- ENTRY FEE -->
				<div class="form-row d-none entry__fee">
					<div class="col-md-4">
						<label for="quiz__entry_fee">Entry fee</label>
					</div>
					<div class="col-md-4">
						<div class="input-group">
							<div class="input-group-prepend">
							  <div class="input-group-text">€</div>
							</div>
							<input type="text" class="form-control" id="quiz__entry_fee">
						</div>
					</div>
					
				</div>
				
<!-- ENTRY FEE MESSAGE-->
				
				<div class="form-row d-none entry__fee">
					<div class="col-md-4">
						<label for="quiz__entry_fee__message">Message</label>
						<span class="helper__text" data-placement="left"
							  data-toggle="tooltip" title="This message will be displayed before your quiz with a fee request."><i class="fa fa-info-circle"></i></span>
					</div>
					<div class="col-md-7">
						<textarea width="100%" id="quiz__entry_fee__message" class="form-control"></textarea>
					</div>
					
				</div>
<!-- QUIZ PARTICIPANTS -->
				<div class="form-row">
					<div class="col-md-4">
						<label for="quiz__participants">No. of participants</label>
					</div>
					<div class="col-md-4">
						<select id="quiz__participants" class="form-control">
                            <option selected>{{($quiz->no_of_participants != '' ? $quiz->no_of_participants : 'Please Choose...')}}</option>
							<option value="1-5">1-5</option>
							<option value="5-9">5-9</option>
							<option value="10-19">10-19</option>
							<option value="20-29">20-29</option>
							<option value="30-49">30-49</option>
							<option value="50+">50+</option>

						</select>
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
								<div class="col-6 col-sm-4 participants__number p-1">
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
								</div>
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
						<input class="d-block btn btn-primary hasArrow" type="submit" value="Next">
					</div>
				</div>
			</form>
			
		</article>
	</div>
	
	</section>
	
@endsection

@section('footer_scripts')

@endsection