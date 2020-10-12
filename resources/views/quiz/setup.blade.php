@extends('layouts.tablequizapp')
@section('template_linked_css')
<style>
	#myProgress {
		width: 100%;
		background-color: #ddd;
	}

	#myBar {
		width: 1%;
		height: 30px;
		background-color: #ff8243;
	}
</style>

@endsection
@section('content')


<section class="container page__inner">
	<div class="row">
		<article class="col-12">
			<div class="article__heading">
				<h1>Quiz Setup</h1>
			</div>

			<form action="/quiz" method="post" enctype="multipart/form-data" class="pt-2 pt-lg-4">
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
						<input type="text" name="quiz__password" class="form-control" placeholder="(optional)">
					</div>
				</div>
				<!-- QUIZ LINK -->
				<div class="form-row">
					<div class="col-md-4">
						<label for="quiz__link">Quiz link</label>
						<span class="helper__text" data-placement="left" data-toggle="tooltip" title="This link is automatically generated from your Quiz name. Share easily with Quiz participants"><i class="fa fa-info-circle"></i></span>
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
									<div class="modal__edit__image position-relative border h-100">

										<div id="image-container">

										</div>
									</div>
									<div class="modal__edit__image__range">
										<div class="form-group">
											<label for="formControlRange">Edit size</label>
											<!-- <input type="range" class="form-control-range slider" min="1" max="4" value="1" step="0.1" id="zoomer"> -->
											<div id="demo" style="display:none;" class="d-none"></div>
											<div id="myProgress">
												<div id="myBar"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer justify-content-center row no-gutters">
									<div class="col-md-3">
										<label class="d-block" for="upload__quiz__icon">Upload
											<input type="file" class="form-control-file imagePreviewInput" id="upload__quiz__icon" name="upload__quiz__icon" value="Upload">
											<input type="hidden" name="crop_image" id="crop-image" value="">
											<input type="hidden" name="original_image" id="original-image" value="">

										</label>
									</div>
									<div class="col-md-3">
										<button id="pro" type="button" class="d-block btn btn-primary" data-dismiss=""> Save</button>
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
							<option  selected>{{(old('quiz__participants') != '' ? old('quiz__participants') : 'Please Choose...')}}</option>
							@foreach($bands as $band)
							@if(($band->band_type)== Config::get('priceband.type.participant_band_type'))
							@if(($band->to)== null)
							<option class="{{$band->from}}" value="{{$band->from}}">{{$band->from}}+</option>
							@else
							<option class="{{$band->from}}-{{$band->to}}" value="{{$band->from}}-{{$band->to}}">{{$band->from}}-{{$band->to}}</option>
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
					<div class="modal show" id="select_participants__modal" tabindex="-1" role="dialog" aria-labelledby="select_participants__modal" aria-hidden="true">
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
									@if(($band->band_type)== Config::get('priceband.type.participant_band_type'))
									<div class="col-6 col-sm-4 participants__number p-1">
										<div class="participants__choice p-3">
											@if(($band->to)== null)
											<input type="text" hidden class="participant" value="{{$band->from}}+">{{$band->from}}+</input>
											@else
											<input type="text" hidden class="participant" value="{{$band->from}}-{{$band->to}}">{{$band->from}}-{{$band->to}}</input>
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
						<button class="d-block btn btn-primary hasArrow" type="submit" value="Next">Next</button>
					</div>
				</div>
			</form>

		</article>
	</div>
</section>



@endsection

@section('footer_scripts')
<script>

var image_src;
  $('.imagePreviewInput').on('change', function(){
	  /**progress bar */
	  $("#pro").text("Save");
	$("#pro").addClass("btn-primary");
	var elem = document.getElementById("myBar");
	elem.style.width = "1%";

    var reader = new FileReader();
    reader.onload = function (event) {

      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
        image_src=event.target.result;
        

      });
    }
    reader.readAsDataURL(this.files[0]);
  });

	$("#pro").click(function() {
		
		if(image_src){ console.log('image src');
		$image_crop.croppie('result', {
							type: 'canvas',
							size: 'viewport'
						}).then(function(response) {
							$('#crop-image').val(response);
							$('#original-image').val(image_src);

						})

					}
		var s = $('.cr-boundary').attr('src');
		//$("#demo").show();
          console.log(event.target.result);



		if (s != "undefind") {
			sessionStorage.setItem("im", s);
			var i = 0;
			if (i == 0) {
				i = 1;
				var elem = document.getElementById("myBar");
				var width = 1;
				var id = setInterval(frame, 10);

				function frame() {
					if (width >= 100) {

						$("#pro").attr("data-dismiss", "modal");
						$("#pro").text("Close");
						$("#pro").removeClass("btn-primary");
						$("#pro").addClass("btn-danger");

						/**image crop */
						
						//$('#image_preview_container').attr('src','');
						//$("#demo").hide();
						clearInterval(id);
						i = 0;
					} else {
						width++;
						elem.style.width = width + "%";
					}
				}
			}
		}
	});

	$('.participants__choice').click(function() {

		var val = $(this).find('.participant').val();

		$('#quiz__participants option[value=' + val + ']').attr("selected", true).change();


	});
</script>
<!-- @include('scripts.quiz-icon-preview') -->
@include('scripts.crop-image')
@endsection