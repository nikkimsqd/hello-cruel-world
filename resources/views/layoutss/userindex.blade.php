<!DOCTYPE html>
<html>
<head>
	<!-- <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
	<title>@yield('titletext')</title>
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" /> -->

  <!-- Facebook and Twitter integration -->
	<!-- <meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" /> -->

	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<!-- <link rel="stylesheet" href="css/animate.css"> -->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">

	<!-- Icomoon Icon Fonts-->
	<!-- <link rel="stylesheet" href="css/icomoon.css"> -->
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">

	<!-- Bootstrap  -->
	<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">


	<!-- Magnific Popup -->
	<!-- <link rel="stylesheet" href="css/magnific-popup.css"> -->
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">


	<!-- Owl Carousel -->
	<!-- <link rel="stylesheet" href="css/owl.carousel.min.css"> -->
	<!-- <link rel="stylesheet" href="css/owl.theme.default.min.css"> -->
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">


	<!-- Theme style  -->
	<!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">


	<!-- Modernizr JS -->
	<script src="{{ asset('js/modernizr-2.6.2.min.js') }}"></script>
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

	<!-- FOR IE9 below -->
	<script src="{{asset('js/respond.min.js')}}"></script>
	<!-- [if lt IE 9]> -->
	<!-- <![endif] -->

</head>
<style type="text/css">
	a{
		color: black !important;
	}
	/*.video-hero{
		background-color: #f2f2f2 !important!
	}*/

</style>
<body>



	<div id="page">
		<nav class="colorlib-nav" role="navigation">
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-md-2 col-md-push-5 text-center">
							<div style="background-size: 60px;"><a href="/hinimo/public/index">
								<!-- <img src="{{ asset('hinimo.png') }}"></a> -->
								<p style="font-family: Arizonia; font-size: 60px;"> Hinimo</p>
							</div>
						</div>
					</div> <!-- row1 -->

					<div class="row"> <!-- row2 -->
						
						<div class="col-md-12 text-center">
							<ul>
								<li>
									<a href="/hinimo/public/about">About</a>
								</li>
								<li>
									<a href="/hinimo/public/how-it-works">How It Works</a>
								</li>
								<li><a href="/hinimo/public/lookbook">Lookbook</a>
								</li>
								<li class="btn btn-success">
									<a href="/hinimo/public/create-design-choose-mannequin">GET STARTED</a>
								</li>
								<li class="has-dropdown"><a href="/hinimo/public/shop">Shop</a>
									<ul class="dropdown" style="background-color: #f2f2f2;">
										<li><a href="/hinimo/public/shop/noelle-west-bridals">Noelle West Bridals</a></li>
										<li><a href="/hinimo/public/shop/younstyle">You 'n Style</a></li>
										<li><a href="/hinimo/public/shop/kolossas">Kolossas</a></li>
									</ul>
								</li>
								<li>
									<a href="/hinimo/public/contact-us">Contact Us</a>
								</li>
								<li class="active has-dropdown">
									<a href="/hinimo/public/my-account">My Account</a>
									<ul class="dropdown" style="background-color: #f2f2f2;">
										<li><a href="/hinimo/public/my-designs">View Saved Designs</a></li>
										<li><a href="/hinimo/public/my-account">View Account</a></li>
										<li><a href="/hinimo/public/logout">Logout</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div> <!-- row2 -->
				</div> <!-- container -->
			</div> <!-- top menu -->
		</nav>

		@yield('content')
			

		<footer id="colorlib-footer">
			<div class="container">
				<div class="row row-pb-md">
					<div class="col-md-3 colorlib-widget">
						<h4>About Hinimo</h4>
						<p>Far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics</p>
						<p>
							<ul class="colorlib-social-icons">
								<li><a href="#"><i class="icon-twitter"></i></a></li>
								<li><a href="#"><i class="icon-facebook"></i></a></li>
								<li><a href="#"><i class="icon-linkedin"></i></a></li>
								<li><a href="#"><i class="icon-dribbble"></i></a></li>
							</ul>
						</p>
					</div>
					<div class="col-md-3 colorlib-widget">
						<h4>Information</h4>
						<p>
							<ul class="colorlib-footer-links">
								<li><a href="/hinimo/public/index"><i class="icon-check"></i> Home</a></li>
								<li><a href="/hinimo/public/about"><i class="icon-check"></i> About</a></li>
								<li><a href="/hinimo/public/how-it-works"><i class="icon-check"></i> How It Works</a></li>
								<li><a href="/hinimo/public/shop"><i class="icon-check"></i> Shop</a></li>
								<li><a href="/hinimo/public/lookbook"><i class="icon-check"></i> Lookbook</a></li>
								<li><a href="/hinimo/public/contact-us"><i class="icon-check"></i> Conatct Us</a></li>
							</ul>
						</p>
					</div>

					<div class="col-md-3 colorlib-widget">
						<h4>Contact Info</h4>
						<ul class="colorlib-footer-links">
							<li>291 South 21th Street, <br> Suite 721 New York NY 10016</li>
							<li><a href="tel://1234567920"><i class="icon-phone"></i> + 1235 2355 98</a></li>
							<li><a href="mailto:info@yoursite.com"><i class="icon-envelope"></i> info@yoursite.com</a></li>
							<li><a href="#"><i class="icon-location4"></i> yourwebsite.com</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="copy">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<p>
								<small class="block"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></small><br> 
								<small class="block">Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a>, <a href="http://pexels.com/" target="_blank">Pexels</a></small>
							</p>
						</div>
					</div>
				</div>
			</div>
		</footer>



	</div>

<!-- jQuery -->
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<!-- jQuery Easing -->
	<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
	<!-- Bootstrap -->
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<!-- Waypoints -->
	<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
	<!-- Stellar Parallax -->
	<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
	<!-- YTPlayer -->
	<script src="{{ asset('js/jquery.mb.YTPlayer.min.js') }}"></script>
	<!-- Owl carousel -->
	<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
	<!-- Magnific Popup -->
	<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('js/magnific-popup-options.js') }}"></script>
	<!-- Main -->
	<script src="{{ asset('js/main.js') }}"></script>


</body>
</html>
