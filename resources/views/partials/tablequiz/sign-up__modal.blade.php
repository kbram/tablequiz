<div class="modal" id="publishQuizModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">


  <!-- thusha_dev -->


  @guest
    <div class="modal-content " id="modal__login">
		@endguest

		@auth
		<div class="modal-content d-none " id="modal__login">
@endauth
  <!-- thusha_dev -->



      <div class="modal-header justify-content-center d-flex">
        <h1 class="modal-title" id="publishQuizModalLabel">Login</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  

      <div class="modal-body ">

        <form class="popupLogIn text-body px-4 pt-4" method="POST" action="{{ route('login') }}">
		@csrf
		  	<div class="form-row">
				<div class="col-md-5">
			  		<label for="login__user">Username/email</label>
				</div>
			  	<div class="col-md-7">
					<input id="email" type="email" name="email"  type="text" class="form-control" name="login__user"> 
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-5">
			  		<label for="login__pass">Password</label>
				</div>
			  	<div class="col-md-7">
					<input id="password" name="password" type="password" class="form-control" name="login__pass"> 
				</div>
			</div>
			<div class="form-row d-flex justify-content-center mt-5">
				<div class="col-10 col-md-4">
					<input class="d-block btn  btn-primary" type="submit" value="Log In">
					<!-- for check out view -> to__checkout -->
				</div>
			</div>
		</form>

		<div class="or__separator"><span>OR</span></div> 
		
		<div class="modal__social_login row flex-column align-items-center">
			<div class="col-sm-6">	
			
			<a href="{{route('social.redirect', ['provider' => 'facebook'])}}" > 
				<button class="btn social__login facebook">Login with Facebook</button>
				</a>
			</div>
			<div class="col-sm-6">
			<a href="{{route('social.redirect', ['provider' => 'twitter'])}}" > 
	
				<button class="btn social__login twitter">Login with Twitter</button>
				</a>
			</div>
			<div class="col-sm-6">	
			<a href="{{route('social.redirect', ['provider' => 'google'])}}" > 

				<button class="btn social__login google">Login with Google</button>
				</a>
			</div>
			<div class="col-sm-6">	
			<a href="{{route('social.redirect', ['provider' => 'instagram'])}}" > 

				<button class="btn social__login instagram">Login with Instagram</button>
				</a>
			</div>
		</div>
		  
		<div class="row text-body pt-2 flex-column align-items-center">
			<hr class="w-100">
			<div class="col-10 col-md-4 d-flex flex-column">
				<p class="text-center">Don't have an account?</p>
				<button class="btn btn-primary sign_up__from__modal d-block">Sign up</button>
			</div>
			 
		</div>
      </div>
		
    </div>
	<div class="modal-content d-none" id="modal__signup">
      <div class="modal-header justify-content-center d-flex">
        <h1 class="modal-title" id="publishQuizModalLabel">Sign Up</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		  <a class="back_to__login" href="#"><i class="fa fa-angle-left"></i><span>Back</span></a>
      </div>
      <div class="modal-body">
        <form class="popupLogIn text-body px-4" method="POST" action="{{ route('register') }}">
		@csrf
		  	<div class="form-row">
				<div class="col-md-5">
			  		<label for="signup__user_firstname">First Name</label>
				</div>
			  	<div class="col-md-7">
					<input id="first_name"  type="text" class="form-control" name="first_name"> 
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-5">
			  		<label for="signup__user_lastname">Last Name</label>
				</div>
			  	<div class="col-md-7">
					<input id="last_name" type="text" class="form-control" name="last_name"> 
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-5">
			  		<label for="signup__username">Username</label>
				</div>
			  	<div class="col-md-7">
					<input id="name" name="name" type="text" class="form-control" name="signup__username"> 
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-5">
			  		<label for="signup__email">Email</label>
				</div>
			  	<div class="col-md-7">
					<input id="email" type="email" class="form-control" name="email"> 
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-5">
			  		<label for="signup__pass">Password</label>
				</div>
			  	<div class="col-md-7">
					<input id="password" type="password" class="form-control" name="password"> 
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-5">
			  		<label for="signup__pass">Confirm Password</label>
				</div>
			  	<div class="col-md-7">
					<input id="password-confirm" type="password" class="form-control" name="password_confirmation"> 
				</div>
			</div>
			<div class="form-row d-flex justify-content-center mt-5">
				<div class="col-10 col-md-4">
					<input class="d-block btn btn-primary to__checkout" type="submit" value="Sign Up">
				</div>
			</div>
		</form>
		<div class="or__separator"><span>OR</span></div> 
		
		<div class="modal__social_login row">
			<div class="col-sm-6">	
			<a href="{{route('social.redirect', ['provider' => 'facebook'])}}" > 

				<button class="btn social__login facebook">Sign up with Facebook</button>
				</a>
			</div>
			<div class="col-sm-6">	
			<a href="{{route('social.redirect', ['provider' => 'twitter'])}}" > 

				<button class="btn social__login twitter">Sign up with Twitter</button>
				</a>
			</div>
			<div class="col-sm-6">
			<a href="{{route('social.redirect', ['provider' => 'google'])}}" > 
	
				<button class="btn social__login google">Sign up with Google</button>
				</a>
			</div>
			<div class="col-sm-6">	
			<a href="{{route('social.redirect', ['provider' => 'instagram'])}}" > 

				<button class="btn social__login instagram">Sign up with Instagram</button>
				</a>
			</div>
		</div>
		
      </div>
		
	</div>

	<!-- thusha dev -->
@guest
	<div class="modal-content d-none " id="modal__payment">
		@endguest
@auth
<div class="modal-content  " id="modal__payment">

@endauth
	<!-- thusha dev -->

      <div class="modal-header justify-content-center d-flex">
        <h1 class="modal-title" id="publishQuizModalLabel">Your cart</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		  <a class="back_to__login" href="#"><i class="fa fa-angle-left"></i><span>Back</span></a>
      </div>
      <div class="modal-body">
		  <table id="modal__payment__table" class="table border-bottom-0">
			  <thead>
				  <tr>
					<th class='border-0'>Description</th>
					<th class='border-0'>Details</th>
					<th class='border-0'>Price</th>
					<th class='border-0'>Remove</th>
				  </tr>
			  </thead>
			  <tbody>
				<tr>
					<td>No. participants</td>
					<td>20 - 29</td>
					<td>€9.99</td>
					<td><span class="checkout__remove">-</span></td>
				</tr>
				 
				<tr>
					<td>Suggested questions</td>
					<td>&times; 25</td>
					<td>€9.99</td>
					<td><span class="checkout__remove">-</span></td>
				</tr>
				 
				<tr>
					<td>Customised backgrounds</td>
					<td>&times; 2</td>
					<td>€9.99</td>
					<td><span class="checkout__remove">-</span></td>
				</tr>
				  
			  </tbody>
			  <tfoot>
				<tr>  
				  <td colspan="2"><strong>Total:</strong></td>
				  <td><strong>€29.97</strong></td>
				<td></td>
				</tr>
			  </tfoot>
		  </table>
		  
		  <form id="modal__checkout" action="/dashboard/home.php" method="post" class="text-body px-2">
			<h3 class="text-center mb-5">Payment details</h3>
			  <div class="form-row">
				  <div class="col-md-5">
					  <label for="cardholder_name">Cardholder name:</label>
					 </div>
				  <div class="col-md-7">
					  <input class="form-control" type="text" name="cardholder_name">
				  </div>
			 </div>
			 <div class="form-row">
				  <div class="col-md-5">
					  <label for="cardholder_street">Street:</label>
					 </div>
				  <div class="col-md-7">
					  <input class="form-control" type="text" name="cardholder_street">
				  </div>
			 </div>
			 <div class="form-row">
				  <div class="col-md-5">
					  <label for="cardholder_city">City/County:</label>
					 </div>
				  <div class="col-md-7">
					  <input class="form-control" type="text" name="cardholder_city">
				 </div>
			</div>
			 <div class="form-row">
				  <div class="col-md-5">
					  <label for="cardholder_country">Country:</label>
					 </div>
				  <div class="col-md-7">
					  <input class="form-control" type="text" name="cardholder_country">
				  </div>
			 </div>
			 <div class="form-row mt-5">
				  <div class="col-md-5">
					  <label for="cardholder_number">Card number:</label>
					 </div>
				  <div class="col-md-7">
					  <input class="form-control" type="number" name="cardholder_number">
				  </div>
			 </div>
			 <div class="form-row">
				  <div class="col-md-5">
					  <label for="cardholder_expiry">Card expiry:</label>
					 </div>
				  <div class="col-md-7">
					  <input class="form-control" type="number" name="cardholder_expiry">
				  </div>
			 </div>
			 <div class="form-row">
				  <div class="col-md-5">
					  <label for="cardholder_cvv">CVV:</label>
					 </div>
				  <div class="col-md-7">
					  <input class="form-control w-25" maxlength="4	" type="text" name="cardholder_cvv">
				  </div>
			 </div>
			  <div class="form-row justify-content-center mt-5">
				  <div class="col-8 col-sm-4">
				  		<button class="d-block btn btn-success">Pay Now</button>
					 </div>
				 </div>
			  
    	  </form>
		  
      </div>
		
    </div>
  </div>
</div>