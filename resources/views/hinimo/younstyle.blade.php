@extends('layouts.userindex')


@section('titletext')
	Hinimo
@endsection

@section('title')
	Login
@endsection


@section('content')

<div class="page">
<section id="home" class="video-hero" style="height: 800px; background-image: url(../../public/long/k.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;">
		<div class="overlay"></div>
			<div class="display-t text-center">
				<div class="display-tc">
					<div class="container">
						<div class="col-md-10 col-md-offset-1">
							<div class="animate-box">
								<!-- <h1 class="holder"><span>Fashion Photoshoot</span></h1> -->
								<h2>You 'n Style</h2>
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
			<a href="{{ asset('long/e.jpg') }}" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('long/e.jpg') }}" alt=""></a>
			<a href="{{ asset('long/i.jpg') }}" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('long/i.jpg') }}" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="{{ asset('long/b.jpg') }} class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('long/b.jpg') }}" alt=""></a>
			<a href="{{ asset('long/q.jpg') }}" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('long/q.jpg') }}" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="{{ asset('long/g.jpg') }}" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('long/g.jpg') }}" alt=""></a>
			<a href="{{ asset('long/m.jpg') }}" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('long/m.jpg') }}" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="{{ asset('long/a.jpg') }}" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('long/a.jpg') }}" alt=""></a>
			<a href="{{ asset('long/c.jpg') }}" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('long/c.jpg') }}"></a>
		</div>
		<br>

	</div>


	</div>
	</div>


</div> <!-- sa page -->

@endsection