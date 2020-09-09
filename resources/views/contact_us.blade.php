@extends('layouts.tablequizapp')

@section('content')
<section class="mb-4 container page__inner">
	 <!--Section heading-->
	 <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
	<!--Section description-->
	<p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
        a matter of hours to help you.</p>
		         <div class="row">

						<div class="col-sm-4">
							<div class="vc_column-inner">
								<div class="wpb_wrapper text-center">
									<div id="mk-icon-box-5" class="mk-box-icon-2  jupiter-donut- box-align-center ">
										<div class="mk-box-icon-2-icon size-48 "> 
										<i class='fas fa-location-arrow' style='font-size:48px;color:white'></i>
									       </div>
										<h3 class="mk-box-icon-2-title">Address</h3>
										<p class="mk-box-icon-2-content"><span style="color: #ffffff;"><b>Weifield Group Contracting</b><br>
												6950 S. Jordan Road<br>
												Centennial, CO 80112</span></p>
										<p><span style="color: #ffffff;"><b>Industrial Division Office</b><br>
												1270 Automation Drive #500<br>
												Windsor, CO 80550</span></p>
										<p><span style="color: #ffffff;"><b>Wyoming Office</b><br>
												308 Southwest Dr Unit E<br>
												Cheyenne, WY 82007</span></p>
										
									</div>
									<div id="padding-6" class="mk-padding-divider jupiter-donut-visible-sm  jupiter-donut-clearfix"></div>

								</div>
							</div>
						</div>


						<div class="col-sm-4">
							<div class="vc_column-inner">
								<div class="wpb_wrapper text-center">
									<div id="mk-icon-box-7" class="mk-box-icon-2  jupiter-donut- box-align-center ">
										<div class="mk-box-icon-2-icon size-48"> 
											<i class="fa fa-phone" style="font-size:48px;color:white"></i>
										 </div>
										<h3 class="mk-box-icon-2-title">Phone</h3>
										<p class="mk-box-icon-2-content"><span style="color: #ffffff;"><b>Weifield Group Contracting</b><br>
												303.428.2011 phone<br>
												303.202.0466 facsimile</span></p>
										<p><span style="color: #ffffff;"><b>Weifield 24/7 Service Department</b><br>
												303.428.2011<br>
												(Then press 2 for emergency calls)</span></p>
										<p><span style="color: #ffffff;"><b>Industrial Division Office</b><br>
												303.428.2011 phone<br>
												303.202.0466 facsimile</span></p>
										
									</div>
									<div id="padding-8" class="mk-padding-divider jupiter-donut-visible-sm  jupiter-donut-clearfix"></div>

								</div>
							</div>
						</div>


						<div class="col-sm-4">
							<div class="vc_column-inner">
								<div class="wpb_wrapper text-center">
									<div id="mk-icon-box-9" class="mk-box-icon-2  jupiter-donut- box-align-center ">
										<div class="mk-box-icon-2-icon size-48"> 
											<i class="	fa fa-envelope" style="font-size:48px;color:white"></i> 
										</div>
										<h3 class="mk-box-icon-2-title">Email</h3>
										<p class="mk-box-icon-2-content"><span style="color: #ffffff;"><b>Request for Proposal</b></span><br>
											<span style="color: #ffffff;"> <a style="color: #ffffff;" href="mailto:info@weifieldcontracting.com">Info@weifieldgroup.com</a></span></p>
										<p><span style="color: #ffffff;"><b>All Bid Opportunities</b></span><br>
											<span style="color: #ffffff;"> <a style="color: #ffffff;" href="mailto:estimating@weifieldgroup.com">estimating@weifieldgroup.com</a></span></p>
										<p><span style="color: #ffffff;"><b>Electrical Service Calls</b></span><br>
											<span style="color: #ffffff;"> <a style="color: #ffffff;" href="mailto:service@weifieldcontracting.com">service@weifieldcontracting.com</a></span></p>
										<p><span style="color: #ffffff;"><b>Employment Opportunities</b></span><br>
											<span style="color: #ffffff;"> <a style="color: #ffffff;" href="mailto:careers@weifieldcontracting.com">careers@weifieldcontracting.com</a></span></p>
									</div>
									<div id="padding-10" class="mk-padding-divider jupiter-donut-visible-sm  jupiter-donut-clearfix"></div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>


	</div>
</div>

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