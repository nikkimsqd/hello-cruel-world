@extends('layouts.userindex')


@section('titletext')
	Hinimo
@endsection

@section('title')
	Login
@endsection


@section('content')
	

<div class="page">
<section id="home" style="height: 200px; background-image: url('silk.jpg');  background-size:cover; ">
</section>





<br><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
			<h2>Shop</h2>
			<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name</p>
		</div>
	</div>
	<div class="row animate-box services colorlib-heading">
		<!-- <h2>Noelle West Bridals</h2> -->
		<div class="col-md-3">
			<a href="wedding/a.jpg" data-toggle="modal" data-target="#pendingModal"><img class="img-responsive" src="wedding/a.jpg"></a>
				<div class="desc text-center">
					<h2>Alice</h2>
					<p>8,000</p>
					<p><button>Rent</button>&nbsp<button>Buy</button></p>
				</div>
				<br><br>
			<a href="wedding/gg.jpg"><img class="img-responsive" src="wedding/gg.jpg" alt=""></a>
				<div class="desc text-center">
					<h2>Alice</h2>
					<p>5,000</p>
					<p><button class="btn btn-default">Rent</button>&nbsp<button>Buy</button></p>
				</div>
				<br><br>
		</div>
		<div class="col-md-3">
			<a href="wedding/k.jpg" class="image-popup-link animate-box"><img class="img-responsive" src="wedding/k.jpg" alt=""></a>
				<div class="desc text-center">
					<h2>Beka</h2>
					<p>5,000</p>
					<p><button>Rent</button>&nbsp<button>Buy</button></p>
				</div>
				<br><br>
			<a href="wedding/i.jpg" class="image-popup-link animate-box"><img class="img-responsive" src="wedding/i.jpg" alt=""></a>
				<div class="desc text-center">
					<h2>Alice</h2>
					<p><button>Rent</button>&nbsp<button>Buy</button></p>
				</div>
				<br><br>
		</div>
		<div class="col-md-3">
			<a href="wedding/pp.jpg" class="image-popup-link animate-box"><img class="img-responsive" src="wedding/pp.jpg" alt=""></a>
				<div class="desc text-center">
					<h2>Candice</h2>
					<p>8,500</p>
					<p><button>Rent</button>&nbsp<button>Buy</button></p>
				</div>
				<br><br>
			<a href="wedding/o.jpg" class="image-popup-link animate-box"><img class="img-responsive" src="wedding/o.jpg" alt=""></a>
				<div class="desc text-center">
					<h2>Alice</h2>
					<p><button>Rent</button>&nbsp<button>Buy</button></p>
				</div>
				<br><br>
		</div>
		<div class="col-md-3">
			<a href="wedding/b.jpg" class="image-popup-link animate-box"><img class="img-responsive" src="wedding/b.jpg" alt=""></a>
				<div class="desc text-center">
					<h2>Alice</h2>
					<p>7,500</p>
					<p><button>Rent</button>&nbsp<button>Buy</button></p>
				</div>
				<br><br>
			<a href="wedding/d.jpg" class="image-popup-link animate-box"><img class="img-responsive" src="wedding/d.jpg"></a>
				<div class="desc text-center">
					<h2>Alice</h2>
					<p><button>Rent</button>&nbsp<button>Buy</button></p>
				</div>
				<br><br>
		</div>
		<br><br><br><br><br><br>
		
	</div>


	<div class="modal fade" id="pendingModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"><b>Rent Details</b></h3>
        </div>

        <div class="modal-body">
          <table class="table">
            <tr>
              <td><b>Rent ID:</b></td>
              <td>183</td>
            </tr>
            <tr>
              <td><b>Customer Name:</b></td>
              <td>John Doe</td>
            </tr>
            <tr>
              <td><b>Order Placed at</b></td>
              <td>11-07-2017</td>
            </tr>
            <tr>
              <td>Order Status:</td>
              <td><span class="label label-warning">Pending</span></td>
            </tr>
            <tr>
              <td>Item ID</td>
              <td>G001</td>
            </tr>
            <tr>
              <td>Item:</td>
              <td><img src="long/b.jpg"></td>
            </tr>
          </table>


        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Accept Order</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel Order</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- 
	<div class="row animate-box services colorlib-heading">
		<h2>You 'n Style</h2>
		<div class="col-md-3 no-gutters">
			<a href="long/e.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="long/e.jpg" alt=""></a>
			<a href="long/i.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="long/i.jpg" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="long/b.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="long/b.jpg" alt=""></a>
			<a href="long/q.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="long/q.jpg" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="long/g.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="long/g.jpg" alt=""></a>
			<a href="long/m.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="long/m.jpg" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="long/a.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="long/a.jpg" alt=""></a>
			<a href="long/c.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="long/c.jpg"></a>
		</div>
	</div>


	<div class="row animate-box services colorlib-heading">
		<h2>Short gowns/dresses</h2>
		<div class="col-md-3 no-gutters">
			<a href="short/z.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="short/z.jpg" alt=""></a>
			<a href="short/q.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="short/q.jpg" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="short/t.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="short/t.jpg" alt=""></a>
			<a href="short/s.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="short/s.jpg" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="short/b.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="short/b.jpg" alt=""></a>
			<a href="short/a.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="short/a.jpg" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="short/p.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="short/p.jpg" alt=""></a>
			<a href="short/l.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="short/l.jpg"></a>
		</div>
	</div>


	<div class="row animate-box services colorlib-heading">
		<h2>Kolossas</h2>
		<div class="col-md-3 no-gutters">
			<a href="mens/g.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="mens/g.jpg" alt=""></a>
			<a href="mens/d.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="mens/d.jpg" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="mens/e.jpeg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="mens/e.jpeg" alt=""></a>
			<a href="mens/k.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="mens/k.jpg" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="mens/j.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="mens/j.jpg" alt=""></a>
			<a href="mens/h.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="mens/h.jpg" alt=""></a>
		</div>
		<div class="col-md-3 no-gutters">
			<a href="mens/f.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="mens/f.jpg" alt=""></a>
			<a href="mens/c.jpg" class="gallery-img image-popup-link animate-box"><img class="img-responsive" src="mens/c.jpg"></a>
		</div>
	</div> -->
</div> <!-- sa gallery -->
	
		

</div> <!-- page -->

@endsection

