@extends('layouts.userindex')


@section('titletext')
	Hinimo
@endsection

@section('title')
	Login
@endsection


@section('content')

<div id="page">
<section id="home" style="height: 170px;  background-size:cover; ">
</section>
<br>


<div class="container">
<div class="row">
<div id="myCarousel" class="carousel slide" data-ride="carousel" style="height: 400px;">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="long/o.jpg" style="height:400px;">
    </div>

    <div class="item">
      <img src="long/f.jpg" style="height:400px;">
    </div>

    <div class="item">
      <img src="long/k.jpg" style="height:400px;">
    </div>
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


<div id="colorlib-about">
				<div class="row row-pb-lg">
					<div class="col-md-8 col-md-offset-2 animate-box" style="background-color: #f2f2f2;">
						<h2>About Hinimo</h2>
						<p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>
						<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
						<h2>Our Team</h2>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 text-center animate-box">
						<div class="staff-entry">
							<a href="#" class="staff-img" style="background-image: url(kenny.jpg);"></a>
							<div class="desc">
								<h3>NIKKI MOSQUEDA</h3>
								<span>Photographer</span>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
								<p>
									<ul class="colorlib-social-icons">
										<li><a href="#"><i class="icon-twitter"></i></a></li>
										<li><a href="#"><i class="icon-facebook"></i></a></li>
										<li><a href="#"><i class="icon-linkedin"></i></a></li>
										<li><a href="#"><i class="icon-dribbble"></i></a></li>
									</ul>
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 text-center animate-box">
						<div class="staff-entry">
							<a href="#" class="staff-img" style="background-image: url(images/person2.jpg);"></a>
							<div class="desc">
								<h3>RUSSEL CARREDO</h3>
								<span>Photo Editor</span>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
								<p>
									<ul class="colorlib-social-icons">
										<li><a href="#"><i class="icon-twitter"></i></a></li>
										<li><a href="#"><i class="icon-facebook"></i></a></li>
										<li><a href="#"><i class="icon-linkedin"></i></a></li>
										<li><a href="#"><i class="icon-dribbble"></i></a></li>
									</ul>
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 text-center animate-box">
						<div class="staff-entry">
							<a href="#" class="staff-img" style="background-image: url(images/person3.jpg);"></a>
							<div class="desc">
								<h3>JOESALEM BELORIA</h3>
								<span>Photographer</span>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
								<p>
									<ul class="colorlib-social-icons">
										<li><a href="#"><i class="icon-twitter"></i></a></li>
										<li><a href="#"><i class="icon-facebook"></i></a></li>
										<li><a href="#"><i class="icon-linkedin"></i></a></li>
										<li><a href="#"><i class="icon-dribbble"></i></a></li>
									</ul>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
</div> <!-- Sa page -->

@endsection
