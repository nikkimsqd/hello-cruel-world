@extends('layouts.userindex')


@section('titletext')
	Hinimo
@endsection


@section('content')

<div class="page">
<section id="home" class="video-hero" style="height: 800px; background-image: url(../../public/mens/l.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;">
		<div class="overlay"></div>
			<div class="display-t text-center">
				<div class="display-tc">
					<div class="container">
						<div class="col-md-10 col-md-offset-1">
							<div class="animate-box">
								<!-- <h1 class="holder"><span>Fashion Photoshoot</span></h1> -->
								<h2>Kolossas</h2>
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

		<h2>Mens</h2>
		<div class="col-md-3 no-gutters">
			<a href="mens/g.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('mens/g.jpg') }}" alt=""></a>
			<a href="mens/d.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('mens/d.jpg') }}" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="mens/e.jpeg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('mens/e.jpeg') }}" alt=""></a>
			<a href="mens/k.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('mens/k.jpg') }}" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="mens/j.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('mens/j.jpg') }}" alt=""></a>
			<a href="mens/h.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('mens/h.jpg') }}" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="mens/f.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('mens/f.jpg') }}" alt=""></a>
			<a href="mens/c.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('mens/c.jpg') }}"></a>
		</div>
	</div>
	</div>
	</div>


</div> <!-- sa page -->
@endsection