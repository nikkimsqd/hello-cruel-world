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
<div class="col-md-11">

	Fabric:
	<select>
		<option>Choose Fabric</option>
		<option>Cotton</option>
		<option>Silk</option>
	</select>


<img src="{{ asset('mfemale.jpg') }}" width="180" align="right">




</div> <!-- col -->
</div> <!-- row -->
</div> <!-- container -->	
</div> <!-- page -->


@endsection



