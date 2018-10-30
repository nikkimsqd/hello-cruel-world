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
	<select class="form-control select2" name="gender" id="gender-select">
		<option selected="selected"> </option>
		<option value="Womens">Womens</option>
		<option value="Mens">Mens</option>
	</select>
	<br>
	<select class="form-control select2" name="category">
		<option> </option>
	@foreach($categories as $category)
		<option value="{{ $category['id'] }}">{{ $category['categoryName'] }}</option>
		@endforeach
		
	</select>
	<br><br>

	<input type="checkbox" name="forRent" value="true" class="checkbox-primary"> For Rent <br>
	<input type="checkbox" name="forSale" value="true" class="checkbox-primary"> For Sale <br><br>

	Add Image:
	<input type="file" name="file[]" multiple><br><br>

	<input type="submit" name="btn_add" value="Add Product">
		
	</form>
	<br>
</div>
</div>

</div>
</div>

<script type="text/javascript">

	$('#gender-select').on('change', function(){
		var gender = $(this).val();

		$.ajax({
			url: "getGender/"+gender,
        success:function(data){

        }
		});

	});
	

</script>


@endsection