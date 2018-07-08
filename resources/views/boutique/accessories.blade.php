
@extends('layouts.boutique')

@section('titletext')
	Hinimo
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Wedding Gowns
        <!-- <small>Version 2.0</small> -->
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">


<div class="row row-pb-md">

		<!-- <h2>Womens</h2> -->
		<div class="col-md-4 no-gutters">
			<a href="{{ asset('wedding/1.jpg') }}" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/1.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Classy</h2>
			</div>
			</a>
			<a href="wedding/2.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/2.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Claire</h2>
			</div>
			</a>
			<a href="wedding/3.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/3.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Lacy</h2>
			</div>
			</a>
		</div>
		<div class="col-md-4 no-gutters">
			<a href="wedding/4.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/4.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Romania</h2>
			</div>
			</a>
			<a href="wedding/5.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/5.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Saharra</h2>
			</div>
			</a>
			<a href="wedding/6.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/6.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Lacy</h2>
			</div>
			</a>
		</div>
		<div class="col-md-4 no-gutters">
			<a href="wedding/7.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/7.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Europia</h2>
			</div>
			</a>
			<a href="wedding/8.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/8.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Lacy</h2>
			</div>
			</a>
			<a href="wedding/9.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/9.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Lacy</h2>
			</div>
			</a>
		</div>
		<!-- <div class="col-md-3 no-gutters">
			<a href="wedding/b.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/b.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Lily</h2>
			</div>
			</a>
			<a href="wedding/c.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/c.jpg') }}">
			<div class="desc text-center">
					<h2>Ivy</h2>
			</div>
			</a>
		</div> -->
		<br>

	</div>

</section>
    <!-- /.content -->
  </div>





  @endsection