@extends('layouts.tablequizapp')


@section('content')



<style>
.abouthead{
	color:#7544C1;
	font-family:sofia-pro;
    
}
.listnum{
	background-color:#F4A75A;
color:white;}



@media only screen and (max-width: 425px) {
	.img-1st {
display:none;  
	

}}
</style>
<section class="container page__inner">
	<div class="row ">
		<article class="col-12">
		<div class="text-center">
			<h1 class="mb-4 abouthead text-center" text-align="center"><strong>About TableQuiz.App</strong></h1>
			<p class="pl-5 pr-5 text-center ">TableQuiz.app is a web quizzing tool built for the education sector.
Quizzes can be setup and ran free of charge and ran using a simple link, no installations neccessary to setup, no registrations needed to play!
			</p>
			</div>
<br>
<br>

<div class="container">
<div class="row">

<div class="easycontant col-xl-7 col-lg-7 col-md-12 col-sm-12">
			<h2 class="">Easy Setup </h2>
<br>

			<ul class="how-it-works__homepage  mt-3 ">
			<li class="py-3">Quickly create a quiz by entering questions and answers on mobile or web</li>

			<li class="py-3">Customize your questions with images, audio & videos</li>

			<li class="py-3">Personalize different quiz rounds by uploading your own backgrounds</li>
			</ul>
			
			
</div>

<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 py-5 mt-5">
<img src="site_design/images/about1.jpg" class="homepage__logo" alt="TableQuiz.app logo"  >
</div>

</div>	
<br>

<hr>

<br>
<br>
<div class="row ">

<div class="col-lg-5  col-md-12 col-sm-12 py-5 mt-5">
<img src="site_design/images/about2.jpg" class="homepage__logo" alt="TableQuiz.app logo" >
</div>

<div class="col-lg-7 col-md-12 col-sm-12">
<div class="easycontant">
			<h2> Easy to Run </h2>
			<br>
			<ul class="how-it-works__homepage mb-5 mt-3 ">
			<li class="py-3">Share with your students, friends or family using a simple web link</li>

			<li class="py-3">Manage timelimits, issue questions and complete marking from one easy-to-use dashboard</li>

			<li class="py-3">Use automated marking to help support / speed up your correcting</li>
			</ul>
</div>
</div>



</div>
<br>
<br>
<hr>
<br>
<br>
<div class="row ">

<div class="col-lg-7 col-md-12 col-sm-12">
<div class="easycontant ">

			<h2>Easy to Play </h2>
			<br>
<ul class="how-it-works__homepage mb-5 mt-3 ">
			<li class="py-3">You are not required to register to play</li>

			<li class="py-3">Enter your player or team name and quiz password to get started</li>

			<li class="py-3">Enter answers as questions are issued from your 'Quizmaster'</li>
			</ul>
</div>
</div>

<div class="col-lg-5  col-md-12 col-sm-12">
<img src="site_design/images/about3.jpg" class="homepage__logo" alt="TableQuiz.app logo"  >
</div>
</div>
<br>

<div class="raw ">
<div class="col-lg-12 col-md-12 cols-sm-4 col-centered text-center">
<a href="/setup/create/" class="btn btn-primary ">Get started ></a>
<div class="col-4"></div>

</div>
</div>
<br>
<br>
</div>
		</article>


	</div>


</section>
@endsection

@section('footer_scripts')

@endsection