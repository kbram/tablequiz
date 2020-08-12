@extends('layouts.tablequizapp')

@section('content')
<style>
.abouthead{
    color:#7544C1;
	font-family:sofia-pro;

}
label{
	white-space:nowrap;

}

@media only screen and (max-width: 768px) {
	.conimg {
display:none;  
}
.formcon{
	width:100% !important;
	display:ingerit;
}
img{

}



}

</style>
<section class="container page__inner">
<div class="container-fluid">
	<div class="row">
		<article class="">
		<h1 class="abouthead " align="center"><strong>We'd love to hear from you!</strong></h1>
<h5 class="text-secondary " align="center">if you have questions, comments or just want a chat, please drop us a message below</h5>

<form>
<div class="raw d-flex">

<div class="f col-xl-8 col-md-12 col-xs-12 col-sm-10">
  <div class="form-group d-flex">
    <label class="text-secondary" for="">Full Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input type="email" class="form-control ml-5" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
  </div>

  <div class="form-group d-flex">
    <label class="text-secondary" for="">Email Address</label>
    <input type="email" class="form-control ml-5" id="exampleInputPassword1" placeholder="">
  </div>

  <div class="form-group d-flex">
    <label class="text-secondary" for="">Message&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <textarea type="password" class="form-control ml-5" id="exampleInputPassword1" placeholder=""></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary float-right">Submit</button>
</div>

<div class="conimg col-xl-4 ">
<img src="site_design/images/homepage__logo.png" class="homepage__logo" alt="TableQuiz.app logo" width="150px" height="150px" >
</div>

</div>
</form>

		</article>
	</div>
	</div>	
</section>
@endsection

@section('footer_scripts')

@endsection