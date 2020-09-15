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

<article class="col-12 article">
	<div class="article_question">
		<div class="article__heading">
			<h1>Question '+count+'</h1>
        </div>
        <div class="form-row mt-md-5 align-items-start align-items-lg-center">
			<div class="col-md-4">
				<label for="question__type">Question type</label>
			</div>
			<div class="col-md-8">
				<div class="row align-items-center">
					<div class="col-lg-6">
						<select name="question__type[]" id="question__type" class="form-control question__type">
							<option value="standard__question">Standard</option>
							<option value="multiple__choice__question">Multiple choice</option>
							<option value="numeric__question">Numeric</option>
						</select>
					</div>
					<div class="col-lg-2 d-flex align-items-center justify-content-center">
						<p class="my-2 m-lg-0">OR</p>
					</div>
					<div class="col-lg-4">
						<a class="d-block btn btn-outline-primary suggested_q_link" href="#" data-toggle="modal" data-target="#suggestedQuestion">
							<span style="color:var(--orange)">Use a suggested question</span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-md-4">
				<label for="question">Question</label>
			</div>
			<div class="col-md-8">
				<input name="question[]" type="text" class="question form-control">
			</div>
		</div>
		<div class="form-row">
			<div class="col-md-4">
				<label>Add media</label>
			</div>
			<div class="col-md-8">
				<div class="row ">
					<div class="col-md-4 pr-0">
						<a href="#" class="btn btn-outline-secondary d-block hasPlus" data-toggle="modal" data-target="#add__image__media'+count+'" data-title="Image" data-add-text="an image">Image</a>
					</div>
					<div class="col-md-4 pr-0">
						<a href="#" class="btn btn-outline-secondary d-block hasPlus" data-toggle="modal" data-target="#add__audio__media'+count+'" data-title="Audio" data-add-text="any audio file">Audio</a>
					</div>
					<div class="col-md-4">
						<a href="#" class="btn btn-outline-secondary d-block hasPlus" data-toggle="modal" data-target="#add__video__media'+count+'" data-title="Video" data-add-text="any video file">Video</a>
				</div>
			</div>
		</div>
		<div class="modal" id="add__image__media'+count+'" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
									 <label>Add link image '+count+'</label> 
									</div> 
									<div class="col-md-8"> 
										<input type="url" name="add_link_to_image__media[]" class="form-control" id="add__image__media__text"> 
									</div> 
								</div> 
								<div class="text-center w-100"> 
									<span>OR</span> 
								</div> 
								<div class="form-row justify-content-center pt-3"> 
									<div class="col-md-3"> 
										<label class="d-block" for="upload__image__media__file">Upload 
											<input type="file" class="form-control-file" id="upload__image__media__file" value="Upload" name="image_media[]"> 
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
								 <div class="modal" id="add__audio__media'+count+'" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"> 
									 <div class="modal-dialog" role="document"> 
										 <div class="modal-content"> 
											 <div class="modal-header justify-content-center"> 
												 <h1 class="modal-title" id="add__audio__media__modal__heading"></h1> 
												 <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> 
												</button>
											 </div> 
											 <div class="modal-body"> 
												 <p class="text-center py-2">Add <span id="add__audio__media__text"></span> to reference in your question</p> 
												 <div class="form-row"> 
													 <div class="col-md-4">
														  <label>Add link audio '+count+'</label> 
														</div> 
														<div class="col-md-8"> 
															<input type="url" name="add_link_to_audio__media[]" class="form-control" id="add__audio__media__text"> 
														</div> 
													</div>
													 <div class="text-center w-100"> <span>OR</span> 
													</div> 
													<div class="form-row justify-content-center pt-3"> 
														<div class="col-md-3"> 
															<label class="d-block" for="upload__audio__media__file">Upload <input type="file" class="form-control-file" id="upload__audio__media__file" value="Upload" name="audio_media[]"> </label> 
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
                                                     <div class="modal" id="add__video__media'+count+'" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"> 
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
                                                                                 <label>Add link video'+count+'</label>
                                                                                 </div> 
                                                                                 <div class="col-md-8"> 
                                                                                     <input type="url" name="add_link_to_video__media[]" class="form-control" id="add__video__media__text"> 
                                                                                    </div> 
                                                                                </div>
                                                                                 <div class="text-center w-100">
                                                                                      <span>OR</span> 
                                                                                    </div> 
                                                                                    <div class="form-row justify-content-center pt-3"> 
                                                                                        <div class="col-md-3"> 
                                                                                            <label class="d-block" for="upload__video__media__file">Upload <input type="file" class="form-control-file" id="upload__video__media__file" value="Upload" name="video_media[]"> 
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
                                                                    <div class="form-row d-flex standard__answer" id="standard__answer">
                                                                        <div class="col-md-4"><label for="standard__question__answer">Answer</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input class="form-control answer" name="standard__question__answer[]" type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="form-row d-none numeric__answer" id="numeric__answer">
                                                                    <div class="col-md-4">
                                                                        <label for="numeric__question__answer">Answer</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input class="form-control" name="numeric__question__answer[]" type="number">
                                                                    </div>
                                                                </div>
                                                                <div class="form-row d-none multiple__choice__legend" style="min-height:0;" id="multiple__choice__legend">
                                                                <div class="offset-md-10 col-2"><small class="d-block text-center pl-4">Correct answer</small>
                                                            </div>
                                                        </div>
                                                        <div class="form-row d-none multiple__choice__answer" id="multiple__choice__answer">
                                                            <div class="col-md-4 align-self-start">
                                                                <label for="multiple__choice__answer">Answer</label>
                                                            
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="row multiple__choice__row pb-3 align-items-center">
                                                                    <div class="col-7"><input name="multiple__choice__answer__1[]" class="form-control" type="text"> 
                                                                </div>
                                                                <div class="col-1 justify-content-center">&nbsp;

                                                                </div>
                                                                <div class="col-1 justify-content-center">
                                                                    <span class="plus">+</span>
                                                                </div>
                                                                <div class="col-3 text-center form-check">
                                                                    <input type="radio" class="" name="multiple__choice__correct__answer[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-4">
                                                            <label for="time__limit">Time limit</label>
                                                        </div>
                                                        <div class="col-md-4"><input class="form-control time-limit" type="number" name="time__limit[]">
                                                    </div>
                                                    <div class="col">
                                                        <small class="form-text text-muted">Seconds</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>




@endsection

@section('footer_scripts')
@include('scripts.bg-image');
@endsection