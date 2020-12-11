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
						<a href="/admin/questions">
							<span><i class="fas fa-question-circle"></i></span>
							Questions
						</a>
					</li>
					
				</ul>
			</div>
		</aside>
		
		
		
		<section class="col-lg-9 dashboard__content">
			<div class="row">
				<div class="col-12">
					<div class="row">
						<div class="col-lg-9">
							<h2>Questions</h2>
						</div>
						<div class="col-lg-3">
							<form action="" method="" class="p-0">
								<input type="text" list="quizzes" name="quiz" placeholder="Search..." class="form-control mb-2 mt-n2">
							</form>
						</div>
					</div>
					
					<article >

					
					<div class="dashboard__container flex-grow-0 pt-4 mb-3">
						<h3>Edit Question</h3>
						
						<form action="/questions/{{$questions->id}}/update" enctype="multipart/form-data" method="post" class="pt-3 add__new__in__admin">
							@csrf
							<div class="form-row">
								<div class="col-md-4">
									<label for="category__type">Category</label>
								</div>
								<div class="col-md-4">

								<select name="category__type" id="category__type" class="form-control" >
                                              <option selected value="{{($questions->category_id != '' ? $questions->category_id : '')}}">{{$cat_name[$questions->id]}}</option>
                                                @foreach($categories as $category)
                                                
                                                <option value="{{$category->id }}" value="show" >{{ $category->category_name }}</option>
													
                                                @endforeach
                                   	<li class="active">
						
					</li>
					
				</ul>
			</div>
		</aside>
		
		<section class="col-lg-9 dashboard__container">
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="col-md-4">
									<label for="question__type">Question type</label>
								</div>
								<div class="col-md-4">
								
									<!-- <select id="question__type" name="question__type" class="form-control" >
                                        <option selected value="{{$questions->question_type}}" >{{$questions->question_type}}</option>
										<option value="standard__question">Standard</option>
										<option value="multiple__choice__question">Multiple choice</option>
										<option value="numeric__question">Numeric</option>

									</select> -->



									<select id="question__type" class="form-control question__type" name="question__type">
                                        @if($questions->question_type =="standard__question")
                                        <option value="standard__question">Standard</option>
                                        <option value="multiple__choice__question">Multiple choice</option>
                                        <option value="numeric__question">Numeric</option>
                                        @endif

                                        @if($questions->question_type =="numeric__question")
                                        <option value="numeric__question">Numeric</option>
                                        <option value="standard__question">Standard</option>
                                        <option value="multiple__choice__question">Multiple choice</option>
                                        @endif

                                        @if($questions->question_type == "multiple__choice__question")
                                        <option value="multiple__choice__question">Multiple choice</option>
                                        <option value="standard__question">Standard</option>
                                        <option value="numeric__question">Numeric</option>
                                        @endif
                                    </select>

							
								</div>
							</div>
							<div class="form-row">
								<div class="col-md-4">
									<label for="question">Question</label>
								</div>
								<div class="col-md-8">
									<input name="question" type="text" class="form-control" value="{{ ($questions->question != '' ? $questions->question : '') }}">
									
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
									  <div class="modal-header ">
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
												<input type="url" name="add_link_to_image__media" class="form-control" id="add__image__media__text" >
											</div>
										</div>
										<div class="text-center w-100">
											 <span>OR</span>
										</div>
										<div class="form-row justify-content-center pt-3">
											<div class="col-md-3">	
											   <label class="d-block" for="upload__image__media__file">Upload
													<input type="file" class="form-control-file" id="upload__image__media__file" name="image_media" value="{{ ($image_media_edit != '' ? $image_media_edit : 'upload') }}"  >
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
												<input type="url" name="add_link_to_audio__media" class="form-control" >
											</div>
										</div>
										<div class="text-center w-100">
											 <span>OR</span>
										</div>
										<div class="form-row justify-content-center pt-3">
											<div class="col-md-3">	
											   <label class="d-block" for="upload__audio__media__file">Upload
													<input type="file" class="form-control-file" id="upload__audio__media__file" value="Upload" name="audio_media" value="{{ ($audio_media_edit != '' ? $audio_media_edit : 'upload') }}">
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
									  <div class="modal-header ">
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
												<input type="url" name="add_link_to_video__media" class="form-control">
											</div>
										</div>
										<div class="text-center w-100">
											 <span>OR</span>
										</div>
										<div class="form-row justify-content-center pt-3">
											<div class="col-md-3">	
											   <label class="d-block" for="upload__video__media__file">Upload
													<input type="file" class="form-control-file" id="upload__video__media__file" value="Upload" name="video_media" value="{{ ($video_media_edit != '' ? $video_media_edit : 'upload') }}">
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
							@if($questionMedia)
								<div class="form-row">
									<div class="col-md-4">
									
									</div>
									<div class=" col-md-4">
									<img src='{{asset($questionMedia->public_path)}}' alt='image' width='100px'  style='border: 3px solid #dee2e6!important;' class='myImg'> 
								
									</div>    
								</div>
               				 @endif
<!-- 							
							<div class="form-row d-flex" id="standard__answer">
								<div class="col-md-4">
									<label for="standard__question__answer">Answer</label>
								</div>
								<div class="col-md-8">
									<input class="form-control" name="standard__question__answer" type="text" value="{{($standard_answer != '' ? $standard_answer : '')}}" >
								</div>
							</div>
							<div class="form-row d-none" id="numeric__answer" name="numeric__answer">
								<div class="col-md-4">
									<label for="numeric__question__answer">Answer</label>
								</div>
								<div class="col-md-8">
									<input class="form-control" name="numeric__question__answer" type="number" value="{{($numeric_answer != '' ? $numeric_answer : '')}}" >
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
										
											
									 <input  name="multiple__choice__answer__1" class="form-control" type="text" value="{{($multiple_answer != '' ? $multiple_answer : '')}}" >		   
										</div> 
										<div class="col-1 justify-content-center">
											&nbsp;
										</div>
										<div class="col-1 justify-content-center">
											<span class="plus" id="add">+</span>
											
										</div>
										<div class="col-3 text-center form-check">
											<input  type="radio" class="" name="multiple__choice__correct__answer" value=0 >
										</div>
									</div>

								</div>

							</div> -->

				@if($question_type =="standard__question")
                    @foreach($answers as $answer)
                    <div class="form-row d-flex standard__answer" id="standard__answer">
                        <div class="col-md-4">
                            <label for="standard__question__answer">Answer</label>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control answer" name="standard__question__answer" type="text" value="{{$answer->answer}}">
                            <input type="hidden" name="standard__question__answer_id" value="{{$answer->id}}">
                        </div>
                    </div>
                    @endforeach
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

                            <div class="row multiple__choice__row   pb-3 align-items-center">
                                <div class="col-7 multi ">
                                    <input name="multiple__choice__answer__0[]" class="multiple-choice-answer form-control" type="text">
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
                    @endif


                    @if($question_type =="numeric__question")
                    @foreach($answers as $answer)

                    <div class="form-row d-flex numeric__answer" id="numeric__answer">
                        <div class="col-md-4">
                            <label for="numeric__question__answer">Answer</label>
                        </div>

                        <div class="col-md-8">

                            <input class="form-control" name="numeric__question__answer" type="number" value="{{$answer->answer}}">
                            <input type="hidden" name="numeric__question__answer_id" value="{{$answer->id}}">

                        </div>

                    </div>
                    @endforeach

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

                            <div class="row multiple__choice__row   pb-3 align-items-center">
                                <div class="col-7 multi ">
                                    <input name="multiple__choice__answer__0[]" class="multiple-choice-answer form-control" type="text">
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

                    <div class="form-row d-none standard__answer" id="standard__answer">
                        <div class="col-md-4">
                            <label for="standard__question__answer">Answer</label>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control answer" name="standard__question__answer__0" type="text">
                        </div>
                    </div>
                    @endif

                    @if($question_type == "multiple__choice__question")

                    <div class="form-row  mb-n4 mb-md-4 multiple__choice__legend" style="min-height:0;" id="multiple__choice__legend">
                        <div class="offset-9 offset-md-10 col-3 col-md-2">
                            <small class="d-block text-center pl-4">Correct answer</small>
                        </div>
                    </div>

                    <div class="form-row  multiple__choice__answer" id="multiple__choice__answer">

                        <div class="col-md-4 align-self-start">
                            <label for="multiple__choice__answer">Answer</label>
                        </div>

                        <div class="col-md-8">

                            <div class=" multiple__choice__row">
                                @foreach($answers as $answer)
                                <div class="row pb-3 align-items-center">
                                    <div class="col-7 multi ">
                                        <input name="multiple__choice__answer[]" class="multiple-choice-answer form-control" value="{{$answer->answer}}">
                                        <input type="hidden" name="multiple__question__answer_id[]" class="get_correct_answer" value="{{$answer->id}}">
                                    </div>
                                    <div class="col-1 justify-content-center p-0 d-flex">
                                        &nbsp;
                                    </div>
                                    <div class="col-1 justify-content-center">
                                        <span class="plus">+</span>
                                    </div>
                                    <div class="col-3 col-md-3 text-center form-check px-0 px-md-4">
                                        <input type="radio" value="0" class="multiple-choice-correct-answer" name="multiple__choice__correct__answer">
                                    </div>
                                </div>
                                @endforeach

                            </div>


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

                    <div class="form-row d-none standard__answer" id="standard__answer">
                        <div class="col-md-4">
                            <label for="standard__question__answer">Answer</label>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control answer" name="standard__question__answer__0" type="text">
                        </div>
                    </div>
                    @endif





							<div class="form-row">
								<div class="col-md-4">
									<label for="time__limit">Time limit</label>
								</div>
								<div class="col-md-4">
									<input class="form-control" min=0 oninput="validity.valid||(value='');" type="number" name="time__limit" value="{{($questions->time_limit != '' ? $questions->time_limit : '')}}"  >
								</div>
								<div class="col">
									<small class="form-text text-muted">Seconds</small>
								</div>
							</div>
							<hr>
						<div class="row justify-content-center">
							<div class="col-4">
							<button  class="d-block btn btn-primary" type="submit">Save</button>
							</div>
						</div>
						</form>
						
						
					</div>
					
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

</article>

	</div>
	  <div id="myModal" class="modal">
       <span id="image-close">&times;</span>
       <img class="modal-contents" id="img01">
      <div id="caption"></div>
    </div>
</section>

@endsection

@section('footer_scripts')
<script>
$(document).ready(function(){
var modal = $("#myModal");

var modalImg = $("#img01");
var captionText = $("#caption");

$("body").delegate(".myImg","click",function(){ 
  modal.css("display","block");
  modalImg.attr('src',this.src);
  captionText.innerHTML = this.alt;
  
});

$('#image-close').click(function(){
	modal.css("display","none");
	
});


});
</script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

.myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

.myImg:hover {opacity: 0.7;}

/* The Modal (background) */
#myModal{
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 5; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-contents {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-contents, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
#image-close{
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>

@endsection