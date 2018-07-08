@extends('layouts.boutique')


@section('titletext')
	Hinimo
@endsection

@section('title')
	Login
@endsection


@section('content')

<div class="page">
<!-- <section id="home" style="height: 200px; background-image: url('silk1.jpg');  background-size:cover; ">
</section> -->
<section id="home" style="height: 170px;  background-size:cover; ">
</section>
<div class="container-fluid">
<br><br><br>


<!-- =====================logout================ -->
<div class="row col-md-11 no-gutters" style="text-align: right;">
	<form>
		<input type="submit" name="btn_logout" value="Logout" class="btn btn-default">
	</form>
	<br>
</div>


<!-- ================commands============ -->
<div class="row col-md-11 no-gutters" style="text-align: right;">
	<input type="submit" name="" value="Change Email" class="btn btn-default">

	<input type="submit" name="" value="Update Password" class="btn btn-default">

</div>

<br><br><br><br><br>

<div class="row col-md-10 col-md-offset-1 animate-box services colorlib-heading">
	<h2>My Account</h2>
	<p>Nikki Mosqueda</p>
	<p>Email: nikkimoda@ymail.com</p>


          

         


</div> <!-- class="row col-md-10 col-md-offset-1 -->
</div> <!-- class="container-fluid" -->
</div> <!-- page -->



@endsection