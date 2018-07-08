
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
			<a href="{{ asset('wedding/t.jpg') }}" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/t.jpg') }}" alt="">
			<div class="desc text-center">
				
			</div>
			</a>
			<a href="wedding/u.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/u.jpg') }}" alt="">
			<div class="desc text-center">
					<!-- <h2>Claire</h2> -->
			</div>
			</a>
			<a href="wedding/zz.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/zz.jpg') }}" alt="">
			<div class="desc text-center">
					<!-- <h2>Lacy</h2> -->
			</div>
			</a>
		</div>
		<div class="col-md-4 no-gutters">
			<a href="wedding/v.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/v.jpg') }}" alt="">
			<div class="desc text-center">
					<!-- <h2>Romania</h2> -->
			</div>
			</a>
			<a href="wedding/w.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/w.jpg') }}" alt="">
			<div class="desc text-center">
					<!-- <h2>Saharra</h2> -->
			</div>
			</a>
			<a href="wedding/xx.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/xx.jpg') }}" alt="">
			<div class="desc text-center">
					<!-- <h2>Lacy</h2> -->
			</div>
			</a>
		</div>
		<div class="col-md-4 no-gutters">
			<a href="wedding/yy.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/yy.jpg') }}" alt="">
			<div class="desc text-center">
					<!-- <h2>Europia</h2> -->
			</div>
			</a>
			<a href="wedding/ww.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/ww.jpg') }}" alt="">
			<div class="desc text-center">
					<!-- <h2>Lacy</h2> -->
			</div>
			</a>
			<a href="wedding/x.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="{{ asset('wedding/x.jpg') }}" alt="">
			<div class="desc text-center">
					<!-- <h2>Lacy</h2> -->
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