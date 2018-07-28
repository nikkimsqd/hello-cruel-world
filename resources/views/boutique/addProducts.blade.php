@extends('layouts.admin')


@section('titletext')
  Boutique de Filipina
@endsection



@section('content')
<div class="page">
<div id="content-wrapper" style="background-color: white;">

<hr>

<div class="row">
<div class="col-md-4 col-md-offset-4">
	<br>
	<form action="{{ url('/saveproduct') }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	Product Name:
	<input type="text" name="productName" class="input form-control"><br><br>

	Product Description:
	<!-- <input type="text" name="productDesc" class="input form-control"><br><br> -->
	<textarea name="productDesc" rows="4" cols="50" class="input form-control"></textarea><br><br>

	Product Price:
	<input type="number" name="productPrice" class="input form-control"><br><br>

	Product Category:
	<select>
		<option> </option>
		<option value="Womens">Womens</option>
		<option value="Mens">Mens</option>
	</select>
	
	<select name="category">
		<option> </option>
	@foreach($categories as $category)
		<option value="{{ $category['categoryName'] }}">{{ $category['categoryName'] }}</option>
		@endforeach
		
	</select>
	<br><br>

	Add Image:
	<input type="file" name="file[]" multiple><br><br>

	<input type="submit" name="btn_add" value="Add Product">
		
	</form>
	<br>
</div>
</div>

</div>
</div>


@endsection