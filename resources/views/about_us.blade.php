@extends('layouts.tablequizapp')


@section('content')

<section class="container page__inner">
	<div class="row">
		<article class="col-12">
			<h1 class="mb-4">About Us</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan ut nisl ac dictum. Pellentesque sem lacus, varius nec ex a, ullamcorper convallis arcu. Nam aliquet tincidunt orci, eu semper diam mattis dignissim. Praesent quis velit quis erat fermentum condimentum. Integer dapibus felis at urna luctus, et suscipit nunc bibendum. Integer fringilla lacus purus. Fusce bibendum quis enim quis efficitur. Proin consectetur rutrum nisi, et rhoncus tellus elementum non. Nunc eget est non neque lacinia vehicula. Donec ornare convallis faucibus. Suspendisse lacinia et eros a dignissim. Ut pellentesque risus et leo mollis, suscipit porta ante consectetur. Donec volutpat lacus consectetur nibh tempor laoreet.
			</p>
			
		</article>
	</div>

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
display:none;  }


}
</style>
<section class="container page__inner">
	<div class="row">
		<article class="col-12">
			<h1 class="mb-4 abouthead " align="center"><strong>About TableQuiz.App</strong></h1>
			<p class="pl-5 pr-5 text-center ">TableQuiz.app is a web quizzing tool built for the education sector.
Quizzes can be setup and ran free of charge and ran using a simple link, no installations neccessary to setup, no registrations needed to play!
			</p>
<br>
<br>

<div class="container">
<div class="raw d-flex col-md-12">

<div class="">
<div class="easycontant">
			<h2 class="">Easy Setup </h2>
<br>

			<div class="raw d-flex">
			<div class="col-1 mt-2"><strong class="listnum p-1 border border-warning rounded-circle  ">01</strong></div>
			<div class="col-11"><h6 class="">Quickly create a quiz by entering questions and answers on mobile or web</h6></div>
			</div>
<br>
			<div class="raw d-flex">
			<div class="col-1 "><strong class="listnum p-1 border border-warning rounded-circle  ">02</strong></div>
			<div class="col-11"><h6 class="">Customize your questions with images, audio & videos</h6></div>
			</div>
<br>
			<div class="raw d-flex">
			<div class="col-1 mt-2"><strong class="listnum p-1 border border-warning rounded-circle  ">03</strong></div>
			<div class="col-11"><h6 class="">Personalize different quiz rounds by uploading your own backgrounds</h6></div>
			</div>
			
			
</div>
</div>

<div class="col-4  img-1st">
<img src="site_design/images/homepage__logo.png" class="homepage__logo" alt="TableQuiz.app logo" width="150px" height="150px" >
</div>

</div>	
<br>

<hr>

<br>
<br>
<div class="raw d-flex">

<div class="col-4 img-1st">
<img src="site_design/images/homepage__logo.png" class="homepage__logo" alt="TableQuiz.app logo" width="150px" height="150px" >
</div>

<div class=" ">
<div class="easycontant">
			<h2> Easy to Run </h2>
			<br>
			<div class="raw d-flex">
			<div class="col-1 mt-2"><strong class="listnum p-1 border border-warning rounded-circle  ">01</strong></div>
			<div class="col-11"><h6 class="">Share with your students, friends or family using a simple web link</h6></div>
			</div>
<br>
			<div class="raw d-flex">
			<div class="col-1 mt-2 "><strong class="listnum p-1 border border-warning rounded-circle  ">02</strong></div>
			<div class="col-11"><h6 class="">Manage timelimits, issue questions and complete marking from one easy-to-use dashboard</h6></div>
			</div>
<br>
			<div class="raw d-flex">
			<div class="col-1 mt-2"><strong class="listnum p-1 border border-warning rounded-circle  ">03</strong></div>
			<div class="col-11"><h6 class="">Use automated marking to help support / speed up your correcting
</h6></div>
			</div>
</div>
</div>



</div>
<br>
<br>
<hr>


<div class="raw d-flex">

<div class=" ">
<div class="easycontant ">
			<h2>Easy to Play </h2>
			<br>
			<div class="raw d-flex">
			<div class="col-1 "><strong class="listnum p-1 border border-warning rounded-circle  ">01</strong></div>
			<div class="col-11"><h6 class="">You are not required to register to play</h6></div>
			</div>
<br>
			<div class="raw d-flex">
			<div class="col-1 mt-2 "><strong class="listnum p-1 border border-warning rounded-circle  ">02</strong></div>
			<div class="col-11"><h6 class="">Enter your player or team name and quiz password to get started</h6></div>
			</div>
<br>
			<div class="raw d-flex">
			<div class="col-1 mt-2"><strong class="listnum p-1 border border-warning rounded-circle  ">03</strong></div>
			<div class="col-11"><h6 class="">Enter answers as questions are issued from your 'Quizmaster'</h6></div>
			</div>
</div>
</div>

<div class="col-4 img-1st">
<img src="site_design/images/homepage__logo.png" class="homepage__logo" alt="TableQuiz.app logo" width="150px" height="150px" >
</div>
</div>
</div>
		</article>


	</div>


</section>
@endsection

@section('footer_scripts')

@endsection