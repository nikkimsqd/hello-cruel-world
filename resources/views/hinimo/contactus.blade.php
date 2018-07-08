@extends('layouts.userindex')


@section('titletext')
	Hinimo
@endsection

@section('title')
	Login
@endsection


@section('content')

<div class="page">
<section id="home" style="height: 170px; background-image: url('silk.jpg');  background-size:cover; ">
</section>

<div class="container-fluid">
<br><br><br>

<div class="row col-md-8 col-md-offset-2 animate-box services colorlib-heading ">
<div class="col-md-6 col-md-offset-3">

<form action="" method="post">
		
	<h2>Contact Us</h2>
	<input type="text" name="name" placeholder="Your Name" class="input form-control"><br>
	<input type="text" name="email" placeholder="Your Email" class="input form-control"><br>
	<textarea rows="4" cols="50" placeholder="Your message here.." class="input form-control">
		
	</textarea>
	<br>
	
	<input type="submit" name="btn_submit" class="btn btn-success">


</form>

</div>
</div>



</div>	
</div>
@endsection

