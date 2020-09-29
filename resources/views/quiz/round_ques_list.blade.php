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

<section class="container page__inner">
    <form id="add_round" action="/round/upload/{{$id}}" method="post" enctype="multipart/form-data" role="main" novalidate>
        @csrf
        <div class="is_container row">

            <article class="col-12">

                <div class="article__heading">
                    <h1>Round {{$name ?? '1'}} Setup</h1>
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
                        <input autocomplete="nothanks" type="text" name="round_name" class="form-control" value="{{$rounds[0]->round_name}}">
                        <input hidden autocomplete="nothanks" type="text" name="round_count" class="form-control" value="{{$round_count ?? '1'}}">
                        <input hidden autocomplete="nothanks" type="text" name="quiz" class="form-control" value="$quiz">

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
        </div>
        </div>
        <div class="button__holder w-100 pt-0 mt-1 justify-content-center d-md-flex" id="add-new-question">
            <div class="col-md-4 p-0">
                <button type="submit" class="btn btn-white d-block" id="addQuestions">Save Round</button>
            </div>
        </div>
        </article>


    </form>

    <section class="col-lg-12 dashboard__content">
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
    </section>
</section>

@endsection

@section('footer_scripts')
@include('scripts.suggest')
@include('scripts.bg-image');
@include('scripts.payment');


@endsection