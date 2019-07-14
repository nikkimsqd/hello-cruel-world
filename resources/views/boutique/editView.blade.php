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
							@if($product->getCategory['gender'] === "Womens")
								<option selected value="Womens">Womens</option>
								<option value="Mens">Mens</option>

							@elseif($product->getCategory['gender'] === "Mens")
								<option value="Womens">Womens</option>
								<option selected value="Mens">Mens</option>
							@else
								<option selected disabled></option>
								<option value="Womens">Womens</option>
								<option  value="Mens">Mens</option>
							@endif
						  </select><br>

						  <select class="form-control select2" name="category">

						  @foreach($categories as $category)
						  @if($category['gender'] == $product->getCategory['gender'])
							  @if($category['categoryName'] == $product->getCategory['categoryName'])
							  	<option value="{{$category['id']}}" selected>{{$category['categoryName']}}</option>
							  @endif
							  @if($category['categoryName'] != $product->getCategory['categoryName'])
							  	<option value="{{$category['id']}}">{{$category['categoryName']}}</option>
							  @endif
						  @endif
						  @endforeach

						  </select>
					    </div>

					    <div class="form-group">
					      	<label>Product Availability</label><br>
					      	@if($product['rpID'] != null && $product['price'] != null)
							<input type="checkbox" id="forRent" name="forRent" value="true" checked> <label for="forRent"> For Rent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" id="forSale" name="forSale" value="true" checked> <label for="forSale">For Sale</label>

					      	@elseif($product['rpID'] != null)
					    	<input type="checkbox" id="forRent" name="forRent" value="true" checked> <label for="forRent">For Rent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" id="forSale" name="forSale" value="true"> <label for="forSale">For Sale</label>

							@elseif($product['price'] != null)
							<input type="checkbox" id="forRent" name="forRent" value="true"> <label for="forRent">For Rent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" id="forSale" name="forSale" value="true" checked> <label for="forSale">For Sale</label>

							@else
							<input type="checkbox" id="forRent" name="forRent" value="true"> <label for="forRent">For Rent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" id="forSale" name="forSale" value="true"> <label for="forSale">For Sale</label>
							@endif
					    </div>

				    	<?php $var = 'display:none;'; ?>
					    @if($product['price'] != null)
				    	<?php $var = ''; ?>
					    @endif
					    <div class="form-group" id="forSalePrice" style="{{$var}}">
					      <label>Retail Price</label>
						  <input type="number" name="productPrice" class="input form-control" value="{{ $product['price'] }}" required>
					    </div>

				    	<?php $var = 'display:none;'; ?>
					    @if($product['rpID'] != null)
				    	<?php $var = ''; ?>
					    @endif

				 	    <div class="form-group" id="forRentPrice" style="{{$var}}">
					        <label>Rent Price</label>
					        <input type="number" name="rentPrice" value="{{$product->rentDetails['price']}}" class="input form-control" required><br>

					        <label>Deposit Amount</label>
					        <input type="number" name="depositAmount" class="input form-control" value="{{$product->rentDetails['depositAmount']}}"><br>

					        <label>Penalty Amount if item is returned late (per day)</label>
					        <input type="number" name="penaltyAmount" class="input form-control" value="{{$product->rentDetails['penaltyAmount']}}"><br>

					        <label>Duration of days item is available for rent</label>
					        <input type="number" name="limitOfDays" class="input form-control" value="{{$product->rentDetails['limitOfDays']}}"><br>

					        <label>Amount of fine incase item is lost by user</label>
					        <input type="number" name="fine" class="input form-control" value="{{$product->rentDetails['fine']}}"><br>

					        <label>Locations item is available for rent</label><br>

                        	<?php $locs = json_decode($product->rentDetails['locationsAvailable']); ?>
                        	<!-- PLAN: TO ADD LIST FOR THE AVAILABLE PRODUCTS. DILI LANG SILA ISUD SA MGA SELECTS BELOW -->
					        <label>Select Region:</label>
					        <select name="region" class="form-control" id="region-select">
					          <option selected="selected"> </option>
					          @foreach($regions as $region)
					          	<option value="{{$region['regCode']}}">{{$region['regDesc']}}</option>
					          @endforeach
					        </select><br>

					        <label>Select Province:</label>
					        <select name="province" class="form-control" id="province-select" value="{{$product->rentDetails['price']}}">
					        </select><br>

					        <label id="city-id" hidden>Select Cities:</label>
					        <div name="cities" id="city-select" style="column-count: 3">
				        	@foreach($locs as $loc)
					        	@foreach($cities as $city)
                            	@if($city['citymunCode'] == $loc)
					        	<input type="checkbox" name="locationsAvailable[]" value="{{$city['citymunDesc']}}" id="{{$loc}}">{{$city['citymunDesc']}} <br>
					        	@endif
                            	@endforeach
				        	@endforeach

					        </div><br>

					        <!-- <label>Select City:</label>
					        <select name="locationsAvailable" class="form-control" id="city-select"  value="{{$product->rentDetails['price']}}">
					        </select><br> -->
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
					       <input type="checkbox" name="tags[]" id="{{$tag['id']}}" value="{{$tag['id']}}">
					       <label for="{{$tag['id']}}">{{$tag['name']}}</label>
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


  	$('#gender-select').on('change', function(){
	  $('#category-select').empty();

	  var gender = $(this).val();
	  // console.log(gender);

	  // $('#category-select').prop('disabled',false);

	  $.ajax({
	    url: "/hinimo/public/getCategory/"+gender,
	    success:function(data){ 

	      $('#category-select').append('<option selected disabled value=""></option>');
	      data.categories.forEach(function(category){
	        $('#category-select').append('<option value="'+category.id+'">'+category.categoryName+'</option>');
	      });
	    }
	  });
	});


// LOCATIONS-----------------------------------------------------------------------------
$("#region-select").on('change', function(){
  $('#province-select').empty();
  $('#city-select').empty();
  $('#brgy-select').empty();
  var regCode = $(this).val();

  $('#city-select').prop('disabled',true);
  $('#province-select').prop('disabled',false);
            

  $.ajax({
    url: "/hinimo/public/boutique-getProvince/"+regCode,
    success:function(data){

      $('#province-select').append('<option selected disabled value=""></option>');
        data.provinces.forEach(function(province){
          $('#province-select').append(
              '<option value="'+province.provCode+'">'+province.provDesc+'</option>'
              );
        });
    }
  });
});


$('#province-select').on('change', function(){
  $('#city-select').empty();
  $('#brgy-select').empty();
  var provCode = $(this).val();
  
  // $('#city-select').prop('disabled',false);;

  $.ajax({
    url: "/hinimo/public/boutique-getCity/"+provCode,
    success:function(data){

      $('#city-id').prop('hidden',false);
        data.cities.forEach(function(city){
        // console.log(city);
         $('#city-select').append(
        '<input type="checkbox" name="locationsAvailable[]" value="'+city.citymunCode+'" id="'+city.citymunDesc+'"> '+city.citymunDesc+'<br>'
        );
      });
    }
  }); //ajaxclosing
});


</script>
@endsection