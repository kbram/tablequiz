@extends('layouts.tablequizapp')

@section('content')

<div id="ss-holder" class="ss-holder">
		<div id="effects"><!-- script will add automatically the scroll effect class here -->
			<article id="articlehold">
				<!-- START SLIDE -->
				<section>
					<div class="ss-row greensea go-anim"> <!-- greensea is the class for the color scheme(there are 19) go-anim is for slide up animation on roll over -->
						<div class="ss-container gcnopadding">
							<!-- ADD YOUT HTML CODE HERE -->
							<p>Bit ZERO</p>
						</div>
					</div>
				</section>
				<!-- END SLIDE -->				
				<!-- START SLIDE -->
				<section>
					<div class="ss-row peterriver go-anim"> <!-- peterriver is the class for the color scheme(there are 19) go-anim is for slide up animation on roll over -->
						<div class="ss-container gcnopadding">
							<!-- ADD YOUT HTML CODE HERE -->
							<p>Here's bit number 1</p>
						</div>
					</div>
				</section>
				<!-- END SLIDE -->				
				<!-- START SLIDE -->
				<section>
					<div class="ss-row alizarin go-anim"> <!-- alizarin is the class for the color scheme(there are 19) go-anim is for slide up animation on roll over -->
						<div class="ss-container gcnopadding">
							<!-- ADD YOUT HTML CODE HERE -->
							<p>Second bt</p>
						</div>
					</div>
				</section>
				<!-- END SLIDE -->				
			</article>
			<!-- START NAVIGATION ARROWS -->
			<div class="ss-nav-arrows-next">
				<i id="next-arrow" class="icon-angle-right "></i>
			</div>
			<div class="ss-nav-arrows-prev" style="">
				<i id="prev-arrow" class="icon-angle-left"></i>
			</div>
			<!-- END NAVIGATION ARROWS -->
		</div>
	</div>
<div class="ss-holder">
	<div class="inifiniteLoader animated fadeOutDown">
		<div class="bar"> <span></span>
		</div>
	</div>
</div>

@endsection

@section('footer_scripts')

@endsection