@extends('layouts.tablequizapp')

@section('content')
<!-- <script src='jquery-3.2.1.min.js'></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<section class="container page__inner">
    <form id="add_round" action="/round/upload/{{$round->id}}" method="post" enctype="multipart/form-data" role="main" novalidate>
        @csrf
        <div class="is_container row">

            <article class="col-12">
            
                <div class="article__heading">
                    <h1>Round {{$rid ?? '1'}} Setup</h1>
                    <!-- <h1>Round Setup</h1> -->
                    <?php /*if($quizName) echo "<h2>".$quizName."</h2>";*/ ?>


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
                        <input autocomplete="nothanks" type="text" name="round_name" class="form-control" value="{{$round->round_name}}" disabled>
                        <input hidden autocomplete="nothanks" type="text" name="round_count" class="form-control" value="{{$round_count ?? '1'}}" >
                        <input hidden autocomplete="nothanks" type="text" name="quiz" class="form-control" value="$quiz">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <label for="round__background">Round background</label>
                        <span class="helper__text" data-placement="left" data-toggle="tooltip" title="You can add background images to each round you create by uploading the image here."><i class="fa fa-info-circle"></i></span>
                    </div>
                    <div class=" col-md-4">
                    <img src='{{asset($round_image_data)}}' alt='image' width='120px' height='80px' style='border: 3px solid #dee2e6!important;' class='myImg'> 
                   
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


    </form>
    <section class="container page__inner  mt-4">
    @php
        $q=1;
    @endphp

    @foreach($questions as $question)
    <form id="add_round" action="/question/upload/{{$question->id}}" method="post" enctype="multipart/form-data" role="main" novalidate>
        <div class="row">

            <article class="col-12 article">

                    @csrf
                    <div class="article_question">
                        <div class="article__heading">
                            <h1>Question <span id="number"> {{$q}}</span></h1>
                            @php
                                $q+=1;
                            @endphp
                        </div>
                        <br>
                        <br>
                        <!-- <div class="form-row mt-md-5 align-items-start align-items-lg-center"> -->
                            <!-- <div class="col-md-4">
                                <label for="question__type">Question type</label>
                            </div>
                            <div class="col-md-8">
                                <div class="row align-items-center">
                                     <div class="col-lg-6">
                                        <select id="question__type" class="form-control question__type" name="question__type">
                                            @if($question->question_type =="standard__question")
                                            <option value="standard__question">Standard</option>
                                            <option value="multiple__choice__question">Multiple choice</option>
                                            <option value="numeric__question">Numeric</option>
                                            @endif

                                            @if($question->question_type  =="numeric__question")
                                            <option value="numeric__question">Numeric</option>
                                            <option value="standard__question">Standard</option>
                                            <option value="multiple__choice__question">Multiple choice</option>
                                            @endif

                                            @if($question->question_type  == "multiple__choice__question")
                                                <option value="multiple__choice__question">Multiple choice</option>
                                                <option value="standard__question">Standard</option>
                                                <option value="numeric__question">Numeric</option>
                                            @endif
                                        </select>
                                    </div> 
                                    <div class="col-lg-2 d-flex align-items-center justify-content-center">
                                        <p class="my-2 m-lg-0">OR</p> 
                                    </div>
                                    <div class="col-lg-4">
                                     <a class="d-block btn btn-outline-primary suggested_q_link" href="#" data-toggle="modal" data-target="#suggestedQuestion"><span style="color:var(--orange)">Use a suggested question</span></a> 
										 The modal for this is at the bottom of the page -->
                                        <!-- <a class="d-block btn btn-outline-primary suggested_q_link paysuggest"  href="#" data-toggle="modal" id="{{$id}}" ><span style="color:var(--orange)">Use a suggested question</span></a> -->
                                       
                                        
                                        <!-- The modal for this is at the bottom of the page -->
                                    <!-- </div>
                                </div> -->
                            <!-- </div> -->
                        <!-- </div> -->
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="question">Question</label>
                                
                            </div>
                            <div class="col-md-8">
                                <input name="question" type="text" class="form-control question" value="{{$question->question}}" disabled>
                                <input class="suggest" type="hidden" name="suggest" id="{{$id}}" value="">

                            </div>
                            @if ($errors->has('question'))
                            <span class="help-block">
                                <p>{{ $errors->first('question') }}</p>
                            </span>
                            @endif
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label>media</label>
                            </div>
                            <div class="col-md-8 bg-light">
                                <div class="row mt-3">
                                @if(isset($media[$question->id.'image']))
                                    <div class="col-md-4 pr-md-0 mt-3 pb-4 ml-3  mb-lg-0">
                                         <img src='{{asset($media[$question->id."image"])}}' alt='image' width='150px' height='100px' style='border: 3px solid #dee2e6!important;' class='myImg'>
                                    </div>
                                    
                                @endif
                                   
                              

                                    @if(isset($media[$question->id.'video']))
                                    <div class="col-md-4 pr-md-0 pr-md-3">
                                       <video width="300" height="200" controls>
                                         <source src='{{asset($media[$question->id."video"])}}' type="video/mp4">
                                         <source src='{{asset($media[$question->id."video"])}}' type="video/ogg">
                                       </video>                                    
                                    </div>
                                    @endif

                                    

                                </div>
                                @if(isset($media[$question->id.'audio']))
                                    <div class="col-md-4 pr-md-0 mb-3 mb-lg-0">
                                      <audio controls style="width:470px;">
                                        <source src='{{asset($media[$question->id."audio"])}}' type="audio/ogg">
                                        <source src='{{asset($media[$question->id."audio"])}}' type="audio/mpeg">
                                      </audio>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($question->question_type  =="standard__question")
                        @foreach($answers as $answer)
                            @if($answer->question_id==$question->id)
                                <div class="form-row d-flex standard__answer" id="standard__answer">
                                    <div class="col-md-4">
                                        <label for="standard__question__answer">Answer</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control answer" name="standard__question__answer" type="text" value="{{$answer->answer}}" disabled>
                                        <input type="hidden" name="standard__question__answer_id" value="{{$answer->id}}">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="form-row d-none numeric__answer" id="numeric__answer">
                            <div class="col-md-4">
                                <label for="numeric__question__answer">Answer</label>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" name="numeric__question__answer" type="number" disabled>
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


                        @if($question->question_type  =="numeric__question")
                        @foreach($answers as $answer)
                            @if($answer->question_id==$question->id)
                                <div class="form-row d-flex numeric__answer" id="numeric__answer">
                                    <div class="col-md-4">
                                        <label for="numeric__question__answer">Answer</label>
                                    </div>

                                    <div class="col-md-8">

                                        <input class="form-control" name="numeric__question__answer" type="number" value="{{$answer->answer}}" disabled>
                                        <input type="hidden" name="numeric__question__answer_id" value="{{$answer->id}}">

                                    </div>

                                </div>
                            @endif
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
                                <input class="form-control answer" name="standard__question__answer__0" type="text" disabled>
                            </div>
                        </div>
                        @endif

                        @if($question->question_type  == "multiple__choice__question")
                                @php
                                $m=0;
                                @endphp
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
                            @foreach($answers as $answer)
                                @if($answer->question_id==$question->id)
                                    @php
                                    ++$m;
                                    @endphp
                                    <div class="row multiple__choice__row  pb-3 align-items-center">
                                    
                                            <div class="col-7 multi ">
                                                <input name="multiple__choice__answer[]" class="multiple-choice-answer form-control" value="{{$answer->answer}}">
                                                <!-- <input type="hidden" name="multiple__question__answer_id[]" class="get_correct_answer" value="{{$answer->id}}"> -->
                                            </div>
                                            <!-- @if($m==1)
                                            <div class="col-1 justify-content-center p-0 d-flex">
                                                &nbsp;
                                            </div>
                                            @else
                                            <div class="col-1 justify-content-center p-0 d-flex">
                                                <span class="minus">-</span>
                                            </div> -->
                                        @endif
                                            <!-- <div class="col-1 justify-content-center">
                                                <span class="plus">+</span>
                                            </div> -->
                                            <div class="col-3 col-md-3 text-center form-check px-0 px-md-4">
                                                <input type="radio" value="0" class="multiple-choice-correct-answer" name="multiple__choice__correct__answer" disabled>
                                            </div>
                                    
                                    

                                    </div>
                                    @endif
                                @endforeach

                            </div>

                        </div>

                        <div class="form-row d-none numeric__answer" id="numeric__answer">
                            <div class="col-md-4">
                                <label for="numeric__question__answer">Answer</label>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" name="numeric__question__answer" type="number" disabled>
                                
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
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4 pr-md-0">
                                        <input class="form-control time-limit" min=0 oninput="validity.valid||(value='');" type="number" name="time__limit" value="{{$question->time_limit}}" disabled>
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
							<div class="col-sm-8">
								<h1 class="modal-title " align="center" id="suggestedQuestionsHeading">Suggested Questions</h1>
							</div>
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
                                        <p class=""formudio-based Q&amp;A</p>
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
                                form
                            </div>
                        </div>

                        <!-- kopi start working -->

                        <div class="modal-body questions d-none">
                            <div class="row suggested__question px-3">

                                <ul class="all_suggested_questions list-unstyled p-0 m-0">

                                    <!-- kopi formstart finished -->


                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        
            <div class="button__holder w-100 pt-0 mt-2 mb-4 justify-content-center d-md-flex" id="add-new-question">

                

            </div>
        </div>

        </form>
        @endforeach
    </section>

    @if($round_count==1)
    
   @elseif($round->id==$frid)
   <section class="row round__page__buttons justify-content-center align-items-center pt-5 mt-5 border-top">
			
			<div class="col-md-4 px-0 px-md-4">
				<!--<button type="button"  class="btn btn-primary d-block" id="publish-quiz">Publish Quiz</a>-->
				<a href="/quiz/{{$id}}/round/{{$rid+1}}"  id="nextRound" class="btn btn-primary  d-block">Next Round  <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				
                <!-- <a href="#" data-toggle="modal" id="publish-quiz" data-target="#publishQuizModal" class="btn btn-primary d-block publish-quiz ">Publish Quiz</a> -->
				
			</div>
	</section>
   @elseif($round->id==$lrid)
   <section class="row round__page__buttons justify-content-center align-items-center pt-5 mt-5 border-top">
			
            <div class="col-md-4 mb-3 mb-md-0 px-0 px-md-4" >
				<!-- <button type="submit" class="btn btn-secondary d-block" id="nextRound"><span class="pr-3"><i class="fa fa-plus"></i></span>Next round</a> -->
                <a href="/quiz/{{$id}}/round/{{$rid-1}}"  id="preRound" class="btn btn-secondary  d-block"><i class="fa fa-chevron-left" aria-hidden="true"></i>  Previous Round </a>
			</div>
	</section>

   @else
    <section class="row round__page__buttons justify-content-center align-items-center pt-5 mt-5 border-top">
			<div class="col-md-4 mb-3 mb-md-0 px-0 px-md-4" >
				<!-- <button type="submit" class="btn btn-secondary d-block" id="nextRound"><span class="pr-3"><i class="fa fa-plus"></i></span>Next round</a> -->
                <a href="/quiz/{{$id}}/round/{{$rid-1}}"  id="preRound" class="btn btn-secondary  d-block"><i class="fa fa-chevron-left" aria-hidden="true"></i>  Previous Round </a>
			</div>
			<div class="col-md-4 px-0 px-md-4">
				<!--<button type="button"  class="btn btn-primary d-block" id="publish-quiz">Publish Quiz</a>-->
				<a href="/quiz/{{$id}}/round/{{$rid+1}}"  id="nextRound" class="btn btn-primary  d-block">Next Round  <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				<!-- <a href="#" data-toggle="modal" id="publish-quiz" data-target="#publishQuizModal" class="btn btn-primary d-block publish-quiz ">Publish Quiz</a> -->
				
			</div>
	</section>
    
    @endif
    <!-- <section class="col-lg-12 dashboard__content">
        <div class="row h-100">
            <div class="col-12 d-flex flex-column">
                <h2>My Questions</h2>
                <div class="dashboard__container flex-grow-1 p-0">
                    <table class="table table-striped table-borderless m-0 h-100 my__quizzes">
                        <thead>
                            <tr>
                                <th>Rounds name</th>
                                <th>Question</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="users">

                            @foreach($questions as $question)

                            <tr>
                                <td>{{++$count}}</td>
                                <td>{{$question->question}}</td>

                                <td class="quiz_actions d-flex flex-row justify-content-lg-center">
                                    <a href="{{ URL::to('round_question/edit/'.$question->id) }}">
                                        <div class="d-flex flex-column pl-0 pl-md-4">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </div>
                                    </a>

                                </td>

                            </tr>
                            @endforeach

                    </table>

                </div>
            </div>
        </div>
    </section> -->
    	<!-- The Modal -->
<div id="myModal" class="modal">
  <span id="image-close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
</section>

@endsection

@section('footer_scripts')
@include('scripts.add-round-image')
<script>

var size = 2000;
     var cropper;
     var image = document.getElementById('image');
     
 $('.edit-round-img-btn').click(function(){
     cropper = new Cropper(image, {
	  aspectRatio: 3/2,
	  viewMode:1,
	  preview: '.preview'
    });
 });
     

	
	$('#upload__quiz__icon').on('change', function(e) { 
        cropper.destroy();
        cropper = null;

	var files = e.target.files;
    var done = function (url) {
	  image.src = url;
	
     cropper = new Cropper(image, {
	  aspectRatio: 3/2,
	  viewMode:1,
	  preview: '.preview'
    });
//     setTimeout(function(){
//    // $('.cropper-container').css('left',70);
//     }, 100);
   
    };
    var reader;
    var file;
    var url;

    if (files && files.length > 0) {
      file = files[0];
	  reader = new FileReader();
        reader.onload = function (e) {
          done(reader.result);
		};
		reader.readAsDataURL(file);

    }
/**new crop image round end */

		size = this.files[0].size;
	
	});

	$("#pro").click(function() {
		
		/**crop image round save btn start */
		canvas = cropper.getCroppedCanvas({
	    width: 160,
	    height: 160,
      });

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
         reader.readAsDataURL(blob); 
         reader.onloadend = function() {
            var base64data = reader.result;	
            $('#edit-round-image-crop').val(base64data);
        
         }
    });
    
/**crop image round save btn end */

		var s = $('#upload__quiz__icon').val();
		s = Math.round(size / 1000);
		if (s == "") {

		} else {
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
					
				}
			})
            
		}
        
	});


</script>

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
.modal-content {
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
.modal-content, #caption {  
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
@include('scripts.add-round-image')
@include('scripts.suggest')
@include('scripts.bg-image');
@include('scripts.payment');


@endsection