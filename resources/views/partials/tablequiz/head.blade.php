<header>
		<div class="navigation__logo">
			<a href="/">
				<img src="site_design/images/tablequizapp_logo.png"
					 alt="TableQuiz.app logo"
					 class="main__logo">
			</a>

		</div>
		@guest
		<nav class="main__navigation">
			<ul>
				<li class="sign_up">
					<a href="#" data-toggle="modal" data-target="#publishQuizModal" class='d-block d-lg-inline-block btn btn-outline-secondary sign_up__from__modal'>Sign Up</a>
				</li>
				<li>
					<a data-toggle="modal" data-target="#publishQuizModal" class="btn btn-secondary d-block d-lg-inline-block login__from__modal" href="#">Log in</a>
				</li>
				
				<!-- This is the avatar to be used when logged in
				<li class="logged_in">
					<a href="../dashboard/home.php" class="d-flex align-items-center">
						<p class="m-0 pr-3">Hi, Senan!</p>
						<img src="../images/senan-avatar.jpeg" class="avatar">
					</a>
				</li>
				-->
				
			</ul>

		</nav>
		@endguest
		@auth
		<nav class="main__navigation">
			<ul>
				
				<li>
					<a  class="btn btn-secondary d-block d-lg-inline-block login__from__modal" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
				</li>
				
				<!-- This is the avatar to be used when logged in
				<li class="logged_in">
					<a href="../dashboard/home.php" class="d-flex align-items-center">
						<p class="m-0 pr-3">Hi, Senan!</p>
						<img src="../images/senan-avatar.jpeg" class="avatar">
					</a>
				</li>
				-->
				
			</ul>

		</nav>
		@endauth
		<div id="menu__btn">
			<i class="fa fa-bars"></i>
		</div>
</header>
	
	