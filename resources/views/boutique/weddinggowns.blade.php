
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
		<div class="col-md-3 no-gutters">
			<a href="{{ asset('wedding/j.jpg') }}" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/j.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Classy</h2>
			</div>
			</a>
			<a href="wedding/g.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/g.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Claire</h2>
			</div>
			</a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="wedding/n.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/n.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Romania</h2>
			</div>
			</a>
			<a href="wedding/i.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/i.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Saharra</h2>
			</div>
			</a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="wedding/p.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/p.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Europia</h2>
			</div>
			</a>
			<a href="wedding/o.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/o.jpg') }}" alt="">
			<div class="desc text-center">
					<h2>Lacy</h2>
			</div>
			</a>
		</div>
		<div class="col-md-3 no-gutters">
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
		</div>
		<br>

	</div>

</section>
    <!-- /.content -->
  </div>





  @endsection