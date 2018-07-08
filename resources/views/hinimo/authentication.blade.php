@extends('layouts.userindex')


@section('titletext')
	Hinimo
@endsection

@section('title')
	Login
@endsection


@section('content')

<div class="page">
<section id="home" style="height: 200px; background-image: url('header.jpg');  background-size:cover; ">
</section>

<div class="container-fluid">
<br><br><br>
<div class="row col-md-8 col-md-offset-2 animate-box services colorlib-heading">
<div class="col-md-6 col-md-offset-3">

<form action="" method="post">
		
	<h2>Login</h2>
	<input type="email" name="email" placeholder="Email" class="input form-control"><br>
	
	<input type="password" name="password" placeholder="Password" class="input form-control"><br>

	<input type="submit" name="btn_login" class="btn btn-success">

</form>
</div>
</div>


<div class="row col-md-8 col-md-offset-2 animate-box services colorlib-heading ">
<div class="col-md-6 col-md-offset-3">

<form action="" method="post">
		
	<h2>Sign Up</h2>
	<input type="text" name="fname" placeholder="First Name" class="input form-control"><br>
	<input type="text" name="lname" placeholder="Last Name" class="input form-control"><br>
	<input type="email" name="email" placeholder="Email" class="input form-control"><br>
	<input type="email" name="email" placeholder="Confirm Email" class="input form-control"><br>
	<input type="password" name="password" placeholder="Password" class="input form-control"><br>
	<input type="password" name="password" placeholder="Confirm Password" class="input form-control"><br>

	<input type="submit" name="btn_signup" class="btn btn-success">


</form>

</div>
</div>



</div>



@endsection