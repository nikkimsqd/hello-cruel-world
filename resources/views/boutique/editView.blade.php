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
	<input type="text" name="productName" class="input form-control" value="{{ $product['productName'] }}"><br><br>

	Product Description:
	<textarea name="productDesc" rows="4" cols="50" class="input form-control">{{ $product['productDesc'] }}</textarea><br><br>

	Product Price:
	<input type="number" name="productPrice" class="input form-control" value="{{ $product['productPrice'] }}"><br><br>


	Product Category:

	<select class="form-control select2">
	@if($product->getCategory->gender == "Womens")
		<option value="Mens">Mens</option>
		<option selected value="Womens">Womens</option>

	@else
		<option selected value="Mens">Mens</option>
		<option value="Womens">Womens</option>
		
	@endif
	</select>

	<br>
	<select class="form-control select2" name="category">
	@foreach($categories as $category)
	@if($product->getCategory->categoryName == $category['categoryName'])
		<option selected value="{{$category->id}}">{{$category->categoryName}}</option>
	@else
		<option value="{{$category->id}}">{{$category->categoryName}}</option>
	@endif
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