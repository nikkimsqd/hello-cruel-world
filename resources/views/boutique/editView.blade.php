@extends('layouts.boutique')
@extends('boutique.sections')




@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Product</h3>
				</div>

				<form action="/hinimo/public/editproduct/{{$product['id']}}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
				  <div class="box-body">
					<div class="col-md-6">
					    <div class="form-group">
					      <label>Product Name</label>
							<input type="text" name="productName" class="input form-control" value="{{ $product['productName'] }}" required>
					    </div>

					    <div class="form-group">
					      <label>Product Description</label>
					      <textarea name="productDesc" rows="3" cols="50" class="input form-control" required>{{ $product['productDesc'] }}</textarea>
					    </div>

					    <div class="form-group">
					      <label>Product Category</label>
					      <select class="form-control select2" name="gender" id="gender-select">
							@if($product['gender'] == "Womens")
								<option value="Mens">Mens</option>
								<option selected value="Womens">Womens</option>

							@else
								<option selected value="Mens">Mens</option>
								<option value="Womens">Womens</option>
								
							@endif
						  </select><br>

						  <select class="form-control select2" name="category">

						  	@if($product['gender'] == "Womens")
							  	@foreach($womensCategories as $womensCategory)
								  	@if($product->getCategory['categoryName'] === $womensCategory['categoryName'])
									<option selected value="{{$womensCategory['id']}}">{{$womensCategory['categoryName']}}</option>
									@else
									<option value="{{$womensCategory['id']}}">{{$womensCategory['categoryName']}}</option>
									@endif
							  	@endforeach
						  	@elseif($product['gender'] == "Mens")
							  	@foreach($mensCategories as $mensCategory)
								  	@if($product->getCategory['categoryName'] === $mensCategory['categoryName'])
									<option selected value="{{$mensCategory['id']}}">{{$mensCategory['categoryName']}}</option>
									@else
									<option value="{{$mensCategory['id']}}">{{$mensCategory['categoryName']}}</option>
									@endif
							  	@endforeach
						  	@endif

						  </select>
					    </div>

					    <div class="form-group">
					      	<label>Product Availability</label><br>
					      	@if($product->forRent != null && $product->forSale != null)
							<input type="checkbox" id="forRent" name="forRent" value="true" checked> <label for="forRent"> For Rent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" id="forSale" name="forSale" value="true" checked> <label for="forSale">For Sale</label>

					      	@elseif($product->forRent != null)
					    	<input type="checkbox" id="forRent" name="forRent" value="true" checked> <label for="forRent">For Rent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" id="forSale" name="forSale" value="true"> <label for="forSale">For Sale</label>

							@elseif($product->forSale != null)
							<input type="checkbox" id="forRent" name="forRent" value="true"> <label for="forRent">For Rent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" id="forSale" name="forSale" value="true" checked> <label for="forSale">For Sale</label>

							@else
							<input type="checkbox" id="forRent" name="forRent" value="true"> <label for="forRent">For Rent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" id="forSale" name="forSale" value="true"> <label for="forSale">For Sale</label>
							@endif
					    </div>

				    	<?php $var = 'display:none;'; ?>
					    @if($product['forSale'] != null)
				    	<?php $var = ''; ?>
					    @endif
					    <div class="form-group" id="forSalePrice" style="{{$var}}">
					      <label>Retail Price</label>
						  <input type="number" name="productPrice" class="input form-control" value="{{ $product['productPrice'] }}" required>
					    </div>

				    	<?php $var = 'display:none;'; ?>
					    @if($product['forRent'] != null)
				    	<?php $var = ''; ?>
					    @endif

				 	    <div class="form-group" id="forRentPrice" style="{{$var}}">
					        <label>Rent Price</label>
					        <input type="number" name="rentPrice" value="{{ $product['rentPrice'] }}" class="input form-control" required>
					     </div>

					    <div class="form-group">
					      	<label>Product Status</label><br>
					      	@if($product->productStatus == "Available")
					      	<input type="radio" id="available" name="productStatus" value="Available" checked> <label for="available"> Available</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" id="nAvailable" name="productStatus" value="Not Available"> <label for="nAvailable"> Not Available</label>
					      	@else
					      	<input type="radio" id="available" name="productStatus" value="Available"> <label for="available"> Available</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" id="nAvailable" name="productStatus" value="Not Available" checked> <label for="nAvailable"> Not Available</label>
							@endif
					    </div>

					    <div class="form-group">
					    	<label>Add Image:</label>
							<input type="file" name="file[]" multiple>
					    </div>

					    <label>Add Tags:</label>
					    <div class="form-group tags">
					       @foreach($prodtags as $prodtag)
					       @if($prodtag['productID'] == $product['id'])
					       <input type="checkbox" name="tags[]" id="{{$prodtag->tag['name']}}" value="{{$prodtag->tag['id']}}" checked>
					       <label for="{{$prodtag->tag['name']}}">{{$prodtag->tag['name']}}</label>
					       @endif
					       @endforeach

					       @foreach($tags as $tag)
					       @if($tag['id'] != $prodtag->tag['id'])
					       <input type="checkbox" name="tags[]" id="{{$tag['name']}}" value="{{$tag['id']}}">
					       <label for="{{$prodtag['tagID']}}">{{$tag['name']}}</label>
					       @endif
					       @endforeach
					      </div>
						</div>

					<div class="col-md-6">
						<?php $counter = 1; ?>
					    @foreach( $product->productFile as $image)
				            @if($counter == 1)
				                <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: auto; object-fit: cover;margin: 10px;">
				            @else
				            @endif
				            <?php $counter++; ?>
				            @endforeach
					</div>
				  </div> <!-- box-body -->

				  <div class="box-footer" style="text-align: right;">
				  	<a href="/hinimo/public/viewproduct/{{$product['id']}}" class="btn btn-warning"><i class="fa fa-arrow-left"> Back</i></a>
					<input type="submit" name="btn_add" value="Update Product" class="btn btn-primary">
				  </div>
	<section class="content">

				</form> 

			</div>
		</div> <!-- main column -->
	</div> <!-- row -->
</section>

<style type="text/css">

.tags label {
  display: inline-block;
  width: auto;
  padding: 10px;
  border: solid 1px #ccc;
  transition: all 0.3s;
  background-color: #e3e2e2;
  border-radius: 5px;
}

.tags input[type="checkbox"] {
  display: none;
}

.tags input[type="checkbox"]:checked + label {
  border: solid 1px #e7e7e7;
  background-color: #ef1717;
  color: #fff;
}

</style>
@endsection



@section('scripts')
<script type="text/javascript">
	
	$('#forRent').change(function() {

      if($('#forRent').is(':checked')) {
      	$('#forRentPrice').show();
      	$('#forRentPrice').prop('required', true);
      } else { 
      	$('#forRentPrice').find('input').prop('required', false);	
      	$('#forRentPrice').hide();

      }

  	});

  	$('#forSale').change(function() {

      if($('#forSale').is(':checked')) {
      	$('#forSalePrice').show();
      	$('#forSalePrice').prop('required', true);
      } else {
      	$('#forSalePrice').find('input').prop('required', false);
      	$('#forSalePrice').hide();

      }

  	});


</script>
@endsection