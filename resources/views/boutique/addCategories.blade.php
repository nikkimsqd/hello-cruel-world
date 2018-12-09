@extends('layouts.boutique')


@section('titletext')
  Boutique de Filipina
@endsection



@section('content')
<div class="page">
<div id="content-wrapper" style="background-color: white;">

<hr>

<div class="row">

<div class="col-md-4 col-md-offset-4">
	<a href="/hinimo/public/products/">Back</a>
	<br><br><br>

	<form action="{{ url('/saveCategory') }}" method="post">
	{{ csrf_field() }}
	
	Gender:
		<select class="form-control select2" name="gender" id="gender-select">
			<option selected="selected"> </option>
			<option value="Womens">Womens</option>
			<option value="Mens">Mens</option>
		</select>
		<br>

	Category Name:
	<input type="text" name="categoryName" class="input form-control"><br>
	<input type="text" name="boutiqueID" value="{{$boutique['id']}}" hidden>

	<input type="submit" name="btn_add" value="Add Category">
		
	</form>
	<br>
</div>
</div>

</div>
</div>


@endsection