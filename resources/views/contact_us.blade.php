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




}

</style>
<section class="container page__inner">
<div class="container-fluid">
	<div class="row">
		<article class="">
		<h1 class="abouthead " align="center"><strong>We'd love to hear from you!</strong></h1>
<h5 class="text-secondary " align="center">if you have questions, comments or just want a chat, please drop us a message below</h5>

@if ($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
  @endif

<form action="{{url('sendmail')}}" method="post">
@csrf
<div class="raw d-flex">

<div class="f col-xl-8 col-lg-8 col-md-12 col-xs-12 col-sm-10">
  <div class="form-group d-flex">
    <label class="text-secondary" for="">Full Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input  name="name" class="form-control ml-5" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
  </div>

  <div class="form-group d-flex">
    <label class="text-secondary" for="">Email Address</label>
    <input name="email" type="email" class="form-control ml-5" id="exampleInputPassword1" placeholder="">
  </div>

  <div class="form-group d-flex">
    <label class="text-secondary" for="">Message&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <textarea name="message" type="password" class="form-control ml-5" id="exampleInputPassword1" placeholder=""></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary float-right">Submit</button>
</div>

<div class="conimg col-md-4 ">
<img src="site_design/images/contact1.png" class="homepage__logo" alt="TableQuiz.app logo" width="50" height="200px" >
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