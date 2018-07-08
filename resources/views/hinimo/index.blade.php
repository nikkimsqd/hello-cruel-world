@extends('layouts.userindex')


@section('titletext')
	Hinimo
@endsection




@section('content')
<div id="page" style="background-color: white;">
<!-- <section id="home" class="video-hero" style="height: 800px; background-image: url(long/o.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;">
		<div class="overlay"></div>
			<div class="display-t text-center">
				<div class="display-tc">
					<div class="container">
						<div class="col-md-10 col-md-offset-1">
							<div class="animate-box">
								 <h1 class="holder"><span>Fashion Photoshoot</span></h1> -->
							<!-- 	<h2>Design your own</h2>
								<p></p>
								<p><a href="/hinimo/public/create-design-choose-mannequin" class="btn btn-primary btn-custom">GET STARTED</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
</section> -->
<section id="home" style="height: 170px;  background-size:cover; ">
</section>
<br>

<div class="container">
<div class="row">
<div id="myCarousel" class="carousel slide" data-ride="carousel" style="height: 500px;">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="long/oo.jpg" style="height:500px;">
    </div>

    <!-- <div class="item">
      <img src="long/f.jpg" style="height:500px;">
    </div>

    <div class="item">
      <img src="long/k.jpg" style="height:500px;">
    </div> -->
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div> <!-- row -->

<br><br>

	<div class="row">
		<!-- <div class="col-md-12 text-left animate-box" style="background-color: #f2f2f2;"> -->
			<div class="col-md-4">
				
					<br>
					<img src="{{ asset('long/custom.jpg') }}" style="height: 400px;">
					<br><br>
				
			</div><br><br><br>
			<div class="col-md-7" style="background-color: #f2f2f2;">
				<div class="desc">
					<br>
					<h3>Customize</h3>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
				</div>
			</div>
		<!-- </div> -->
	</div>

	<div class="row">
		<div class="col-md-12 img text-right animate-box services">
			
			<div class="col-md-7 col-md-offset-1 text-right" style="background-color: #f2f2f2;">
				
				<div class="desc">
					<br>
					<h3>Rent</h3>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
				</div>
			</div>
			<div class="col-md-4">
				
					<img src="{{ asset('long/h.jpg') }}" style="height: 400px;">
					<br><br>
				
			</div>
		</div>
	</div>




	<div class="row" style="background-color: #f2f2f2;">
		<br>
		<h2 class="text-center">How it Works</h2><br>
		<div class="col-md-4 text-center animate-box">
			<div class="">
				<span class="icon">
					<img src="{{ asset('male.png') }}">
				</span>
				<div class="desc">
					<h3>Select Fabric</h3>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
				</div>
			</div><br>
		</div>
		<div class="col-md-4 text-center animate-box">
			<div>
				<span class="icon">
					<img src="{{ asset('female.png') }}">
				</span>
				<div class="desc">
					<h3>Start Designing</h3>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
				</div>
			</div>
		</div>
		<div class="col-md-4 text-center animate-box">
			<div>
				<span class="icon">
					<img src="{{ asset('bg.png') }}">
				</span>
				<div class="desc">
					<h3>Submit Measurements</h3>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
				</div>
			</div>
		</div>
	</div>
</div>	


<br><br>
<div class="container-fluid">
	
	<div class="row animate-box ">
		<!-- <h2>Wedding gowns</h2> -->
		<div class="col-md-5 col-md-offset-1">
			<a href="wedding/g.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="wedding/ba.jpg" alt="">
				<div class="desc text-center">
					<h2>Wedding gowns</h2>
					<!-- <p class="category"><span>Jacket</span></p> -->
				</div>
			</a><br>
			<a href="long/c.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="long/ca.jpg" alt="">
				<div class="desc text-center">
					<h2>Entourage Set</h2>
					
				</div>
			</a>
		</div>
		<div class="col-md-5 no-gutters">
			<a href="long/c.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="long/ca.jpg" alt="">
				<div class="desc text-center">
					<h2>Ball Gowns</h2>
				</div>
			</a><br>
			<a href="wedding/ba.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="wedding/ba.jpg" alt="">
				<div class="desc text-center">
					<h2>Short Gowns/ Cocktails</h2>
				</div>
			</a>
		</div>
		
	</div>

</div> <!-- sa gallery -->


</div> <!-- sa page -->


@endsection

