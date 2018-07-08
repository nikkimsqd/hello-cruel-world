@extends('layouts.userindex')

@section('titletext')
	Hinimo
@endsection

@section('content')

<div class="page">
<section id="home" style="height: 200px; background-image: url('silk.jpg');  background-size:cover; ">
</section>

<div class="container-fluid">
<br><br><br>

<div class="row col-md-10 col-md-offset-1 animate-box services colorlib-heading ">

<h2>Choose Preffered Size</h2>
	<div class="row">
		<div class="col-md-4 col-md-offset-1">

			<form action="{{ url('/create-design') }}" method="">
				

				<h1>Mannequin 1</h1>
				<img src="body-a.jpg">
				<p>Sizes: Waist: </p>
				<input type="submit" name="" value="Choose Mannequin"><br><br>

			</form>

		</div> <!-- col -->
		<div class="col-md-4  col-md-offset-1">

			<form action="{{ url('/create-design') }}" method="">
				

				<h1>Mannequin s</h1>
				<img src="body-b.jpg">
				<p>Sizes: Waist: </p>
				<input type="submit" name="" value="Choose Mannequin"><br><br>

			</form>

		</div> <!-- col -->
	</div> <!-- row -->
	<br><br>
	<div class="row">
		<div class="col-md-4  col-md-offset-1">
		<p>or</p>
			<h1>Upload a sample photo:</h1>
			<input type="file" name="">
		</div>
	</div>

	
		

</div> <!-- row outer -->
</div> <!-- container -->	
</div> <!-- page -->


@endsection