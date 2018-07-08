@extends('layouts.userindex')


@section('titletext')
	Hinimo
@endsection


@section('content')

<div class="page">
<section id="home" class="video-hero" style="height: 800px; background-image: url(../../public/wedding/nice.jpg);  background-size:cover; background-position: center center; background-attachment:fixed;">
		<div class="overlay"></div>
			<div class="display-t text-center">
				<div class="display-tc">
					<div class="container">
						<div class="col-md-10 col-md-offset-1">
							<div class="animate-box">
								<!-- <h1 class="holder"><span>Fashion Photoshoot</span></h1> -->
								<h2>Noelle West Bridals</h2>
								<p>Shop</p>
								<p><a href="/hinimo/public/create-design-choose-mannequin" class="btn btn-primary btn-custom">Click here to Start Customizing</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
</section>
<div class="colorlib-gallery">
<div class="container">
<div class="row row-pb-md">

		<!-- <h2>Womens</h2> -->
		<div class="col-md-3 no-gutters">
			<a href="{{ asset('wedding/j.jpg') }}" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/j.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Classy</h2>
					<p class="category"><span>Get Item</span></p>
				</div>
			</a>
			<a href="wedding/g.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/g.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Claire</h2>
					<p class="category"><span>Get Item</span></p>
			</div>
			</a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="wedding/n.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/n.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Romania</h2>
					<p class="category"><span>Get Item</span></p>
			</div>
			</a>
			<a href="wedding/i.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/i.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Saharra</h2>
					<p class="category"><span>Get Item</span></p>
			</div>
			</a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="wedding/p.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/p.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Europia</h2>
					<p class="category"><span>Get Item</span></p>
			</div>
			</a>
			<a href="wedding/o.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/o.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Lacy</h2>
					<p class="category"><span>Get Item</span></p>
			</div>
			</a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="wedding/b.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/b.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Lily</h2>
					<p class="category"><span>Get Item</span></p>
			</div>
			</a>
			<a href="wedding/c.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/c.jpg') }}">
			<div class="desc text-center">
					<h2>Ivy</h2>
					<p class="category"><span>Get Item</span></p>
			</div>
			</a>
		</div>
		<br>

	</div>


	</div>
	</div>


</div> <!-- sa page -->
@endsection