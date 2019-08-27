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

				<form action="{{url('editproduct/'.$product['id'])}}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
				  <div class="box-body">
						<div class="col-md-6">
					    <div class="form-group">
					    	<h4>Edit Image:</h4>
							<input type="file" name="file[]" multiple>
					    </div>

					    <div class="form-group">
					      <h4>Product Name</h4>
							<input type="text" name="productName" class="input form-control" value="{{ $product['productName'] }}" required>
					    </div>

					    <div class="form-group">
					      <h4>Product Description</h4>
					      <textarea name="productDesc" rows="3" cols="50" class="input form-control" required>{{ $product['productDesc'] }}</textarea>
					    </div>

					    <div class="form-group">
				      	<h4>Product Status</h4>
				      	@if($product->productStatus == "Available")
				      		<input type="radio" id="available" name="productStatus" value="Available" checked> <label for="available"> Available</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="radio" id="nAvailable" name="productStatus" value="Not Available"> <label for="nAvailable"> Not Available</label>
				      	@else
				      		<input type="radio" id="available" name="productStatus" value="Available"> <label for="available"> Available</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="radio" id="nAvailable" name="productStatus" value="Not Available" checked> <label for="nAvailable"> Not Available</label>
							@endif
					    </div>

							<div class="form-group">
								<h4>Is this a ready-to-wear item?:</h4>
								@if($product['rtwID'] != null)
								<input type="radio" id="yes" name="itemType" class="minimal-red rtw-choice" value="yes" checked>
								<label for="yes">Yes</label>&nbsp;&nbsp;&nbsp;
								<input type="radio" id="no" name="itemType" class="minimal-red rtw-choice" value="no">
								<label for="no">No</label>&nbsp;&nbsp;&nbsp;
								@else
								<input type="radio" id="yes" name="itemType" class="minimal-red rtw-choice" value="yes">
								<label for="yes">Yes</label>&nbsp;&nbsp;&nbsp;
								<input type="radio" id="no" name="itemType" class="minimal-red rtw-choice" value="no" checked>
								<label for="no">No</label>&nbsp;&nbsp;&nbsp;
								@endif
							</div>
	      
							@if($product['rtwID'] != null)
				      <div class="form-group rtwSizes">
								<?php
									$checked = [];

									if($product->rtwDetails['xs'] != null){
										array_push($checked, 'xs');
									}
									if($product->rtwDetails['s'] != null){
										array_push($checked, 's');
									}
									if($product->rtwDetails['m'] != null){
										array_push($checked, 'm');
									}
									if($product->rtwDetails['l'] != null){
										array_push($checked, 'l');
									}
									if($product->rtwDetails['xl'] != null){
										array_push($checked, 'xl');
									}
									if($product->rtwDetails['xxl'] != null){
										array_push($checked, 'xxl');
									}

									foreach($checked as $check){
										echo($check);
									}
									echo " Mao ni naa sa db";
								?>
				        <h4>Choose available sizes:</h4>
								@if(in_array('xs', $checked))
				        	<input type="checkbox" name="sizes" id="XS" value="XS" class="sizes" checked>
				        	<label for="XS">XS</label>
				        @else
					        <input type="checkbox" name="sizes" id="XS" value="XS" class="sizes">
					        <label for="XS">XS</label>
				        @endif

								@if(in_array('s', $checked))
					        <input type="checkbox" name="sizes" id="S" value="S" class="sizes" checked>
					        <label for="S">S</label>
				        @else
					        <input type="checkbox" name="sizes" id="S" value="S" class="sizes">
					        <label for="S">S</label>
				        @endif

								@if(in_array('m', $checked))
					        <input type="checkbox" name="sizes" id="M" value="M" class="sizes" checked>
					        <label for="M">M</label>
				        @else
					        <input type="checkbox" name="sizes" id="M" value="M" class="sizes">
					        <label for="M">M</label>
				        @endif

								@if(in_array('l', $checked))
					        <input type="checkbox" name="sizes" id="L" value="L" class="sizes" checked>
					        <label for="L">L</label>
				        @else
					        <input type="checkbox" name="sizes" id="L" value="L" class="sizes">
					        <label for="L">L</label>
				        @endif

								@if(in_array('xl', $checked))
					        <input type="checkbox" name="sizes" id="XL" value="XL" class="sizes" checked>
					        <label for="XL">XL</label>
				        @else
					        <input type="checkbox" name="sizes" id="XL" value="XL" class="sizes">
					        <label for="XL">XL</label>
				        @endif

								@if(in_array('xxl', $checked))
					        <input type="checkbox" name="sizes" id="XXL" value="XXL" class="sizes" checked>
					        <label for="XXL">XXL</label>
				        @else
					        <input type="checkbox" name="sizes" id="XXL" value="XXL" class="sizes">
					        <label for="XXL">XXL</label>
				        @endif
				      </div>
				      
				      <!-- INPUT FIELDS -->
							@if(in_array('xs', $checked))
				      <div class="form-group" id="XSquantity">
				        <label>Enter quantity for XS:</label>
				        <input id="XS" type="number" name="XSquantity" class="input form-control" value="{{$product->rtwDetails['xs']}}">
				      </div>
			        @else
				      <div class="form-group" id="XSquantity" hidden>
				        <label>Enter quantity for XS:</label>
				        <input type="number" name="XSquantity" class="input form-control">
				      </div>
			        @endif
				      
							@if(in_array('s', $checked))
				      <div class="form-group" id="Squantity">
				        <label>Enter quantity for S:</label>
				        <input type="number" name="Squantity" class="input form-control" value="{{$product->rtwDetails['s']}}">
				      </div>
			        @else
			        <div class="form-group" id="Squantity" hidden>
				        <label>Enter quantity for S:</label>
				        <input type="number" name="Squantity" class="input form-control">
				      </div>
			        @endif
				      
							@if(in_array('m', $checked))
				      <div class="form-group" id="Mquantity">
				        <label>Enter quantity for M:</label>
				        <input type="number" name="Mquantity" class="input form-control" value="{{$product->rtwDetails['m']}}">
				      </div>
			        @else
			        <div class="form-group" id="Mquantity" hidden>
				        <label>Enter quantity for M:</label>
				        <input type="number" name="Mquantity" class="input form-control">
				      </div>
			        @endif
				      
							@if(in_array('l', $checked))
				      <div class="form-group" id="Lquantity" >
				        <label>Enter quantity for L:</label>
				        <input type="number" name="Lquantity" class="input form-control" value="{{$product->rtwDetails['l']}}">
				      </div>
			        @else
			        <div class="form-group" id="Lquantity" hidden>
				        <label>Enter quantity for L:</label>
				        <input type="number" name="Lquantity" class="input form-control">
				      </div>
			        @endif
				      
							@if(in_array('xl', $checked))
				      <div class="form-group" id="XLquantity">
				        <label>Enter quantity for XL:</label>
				        <input type="number" name="XLquantity" class="input form-control" value="{{$product->rtwDetails['xl']}}">
				      </div>
			        @else
			        <div class="form-group" id="XLquantity" hidden>
				        <label>Enter quantity for XL:</label>
				        <input type="number" name="XLquantity" class="input form-control">
				      </div>
			        @endif
				      
							@if(in_array('xxl', $checked))
				      <div class="form-group" id="XXLquantity">
				        <label>Enter quantity for XXL:</label>
				        <input type="number" name="XXLquantity" class="input form-control" value="{{$product->rtwDetails['xxl']}}">
				      </div>
			        @else
			        <div class="form-group" id="XXLquantity" hidden>
				        <label>Enter quantity for XXL:</label>
				        <input type="number" name="XXLquantity" class="input form-control">
				      </div>
			        @endif
			        @else
      
				      <div class="form-group rtwSizes" hidden>
				        <label class="excluded">Choose available sizes:</label>
				        <input type="checkbox" name="sizes" id="XS" value="XS" class="sizes">
				        <label for="XS">XS</label>
				        <input type="checkbox" name="sizes" id="S" value="S" class="sizes">
				        <label for="S">S</label>
				        <input type="checkbox" name="sizes" id="M" value="M" class="sizes">
				        <label for="M">M</label>
				        <input type="checkbox" name="sizes" id="L" value="L" class="sizes">
				        <label for="L">L</label>
				        <input type="checkbox" name="sizes" id="XL" value="XL" class="sizes">
				        <label for="XL">XL</label>
				        <input type="checkbox" name="sizes" id="XXL" value="XXL" class="sizes">
				        <label for="XXL">XXL</label>
				      </div>
      
				      <div class="form-group" id="XSquantity" hidden>
				        <label>Enter quantity for XS:</label>
				        <input type="number" name="XSquantity" class="input form-control">
				      </div>
				      
				      <div class="form-group" id="Squantity" hidden>
				        <label>Enter quantity for S:</label>
				        <input type="number" name="Squantity" class="input form-control">
				      </div>
				      
				      <div class="form-group" id="Mquantity" hidden>
				        <label>Enter quantity for M:</label>
				        <input type="number" name="Mquantity" class="input form-control">
				      </div>
				      
				      <div class="form-group" id="Lquantity" hidden>
				        <label>Enter quantity for L:</label>
				        <input type="number" name="Lquantity" class="input form-control">
				      </div>
				      
				      <div class="form-group" id="XLquantity" hidden>
				        <label>Enter quantity for XL:</label>
				        <input type="number" name="XLquantity" class="input form-control">
				      </div>
				      
				      <div class="form-group" id="XXLquantity" hidden>
				        <label>Enter quantity for XXL:</label>
				        <input type="number" name="XXLquantity" class="input form-control">
				      </div>
				      @endif <!-- end sa if(in_array('xs', checked)) -->

					    <div class="form-group">
					      <h4>Product Category</h4>
					      <select class="form-control select2" name="gender" id="gender-select">
								@if($product->getCategory['gender'] === "Womens")
								<option selected value="Womens">Womens</option>
								<option value="Mens">Mens</option>

								@elseif($product->getCategory['gender'] === "Mens")
								<option value="Womens">Womens</option>
								<option selected value="Mens">Mens</option>
								<!-- @else
								<option selected disabled></option>
								<option value="Womens">Womens</option>
								<option  value="Mens">Mens</option> -->
								@endif
						  	</select><br>

							  @if($product['category'] != null)
				        <select class="form-control select2" name="category" id="category-select" required>
				        	@foreach($categories as $category)
				        	@if($category['id'] == $product['category'])
				          	<option value="{{$category['id']}}" selected>{{$category['categoryName']}}</option>
				          @else
				          	<option value="{{$category['id']}}">{{$category['categoryName']}}</option>
				          @endif
				          @endforeach
				        </select><br>
				        @endif

				        <div class="col-md-12 mb-10" id="measurement-choices" style="column-count: 2">
				        	@if($product['measurementNames'] != null)
				        	<?php
				        		$measurementNames = json_decode($product['measurementNames']);
				        		$selectedMeasurements = [];
				        	?>
				        	@foreach($measurementNames as $measurementName)
										<?php array_push($selectedMeasurements, $measurementName); ?>
									@endforeach

				        	@foreach($product->getCategory->getMeasurements as $getMeasurements)
										@if(in_array($getMeasurements['mName'], $selectedMeasurements))
					        	<input type="checkbox" id="{{$getMeasurements['id']}}" name="{{$product->getCategory['id']}}[{{$getMeasurements['mName']}}]" value="{{$getMeasurements['mName']}}" class="mb-10 measurements" checked>&nbsp;
										<label for="{{$getMeasurements['id']}}">{{$getMeasurements['mName']}}</label><br>
										@else
					        	<input type="checkbox" id="{{$getMeasurements['id']}}" name="{{$product->getCategory['id']}}[{{$getMeasurements['mName']}}]" value="{{$getMeasurements['mName']}}" class="mb-10 measurements">&nbsp;
										<label for="{{$getMeasurements['id']}}">{{$getMeasurements['mName']}}</label><br>
										@endif
									@endforeach
									@endif
				        </div>

				        <br><br>
				        <div class="col-md-12" id="measurement-input">
				        	@if($product['measurements'] != null)
				        	<?php $measurements = json_decode($product['measurements']); ?>
				        	@foreach($measurements as $measurement => $value)
										<label for="">{{$measurement}}</label><br> &nbsp; 
										<input type="text" name="measurementData[{{$measurement}}]" class="mb-10" placeholder="" value="{{$value}}">&nbsp; <br>
									@endforeach
									@endif
				        </div>
 
							  <!--<select class="form-control select2" name="category">

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

							  </select> -->
				    	</div>


				    	@if(count($prodtags) > 0)
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
							@endif

						</div>
<!-- 
						<div class="col-md-6">
							<?php $counter = 1; ?>
					    @foreach( $product->productFile as $image)
		            @if($counter == 1)
	                <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: auto; object-fit: cover;margin: 10px;">
		            @else
		            @endif
		            <?php $counter++; ?>
		            @endforeach
						</div> -->

						<div class="col-md-6">

				      <div class="form-group">
				        <h4>In-Stock:</h4>
				        <input type="number" name="quantity" id="quantity" class="input form-control" value="{{$product['quantity']}}">
				      </div>

					    <div class="form-group">
				      	<h4>Product Availability</h4>
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
						  	<input type="number" name="productPrice" class="input form-control" value="{{ $product['price'] }}">
					    </div>

					    <?php $var = 'display:none;'; ?>
					    @if($product['rpID'] != null)
				    	<?php $var = ''; ?>
					    @endif

				 	    <div class="form-group" id="forRentPrice" style="{{$var}}">
				        <label>Rent Price</label>
				        <input type="number" name="rentPrice" value="{{$product->rentDetails['price']}}" class="input form-control"><br>

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
				        <!-- <label>Select Region:</label>
				        <select name="region" class="form-control" id="region-select">
				          <option selected="selected"> </option>
				          @foreach($regions as $region)
				          	<option value="{{$region['regCode']}}">{{$region['regDesc']}}</option>
				          @endforeach
				        </select><br> -->

				        <!-- <label>Select Province:</label>
				        <select name="province" class="form-control" id="province-select" value="{{$product->rentDetails['price']}}">
				        </select><br> -->

				        <label id="city-id" hidden>Select Cities:</label>
				        <div name="cities" id="city-select" style="column-count: 3">
				        	@foreach($cities as $city)
				        	<input type="checkbox" name="locationsAvailable[]" value="{{$city['citymunCode']}}" id="{{$city['id']}}"> {{$city['citymunDesc']}} <br>
                          	@endforeach

				        </div><br>

				        <!-- <label>Select City:</label>
				        <select name="locationsAvailable" class="form-control" id="city-select"  value="{{$product->rentDetails['price']}}">
				        </select><br> -->
					    </div>
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
  h4{font-weight: bold;}
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

  .rtwSizes .excluded{
    display: block;
    padding: 0;
    border: none;
    background-color: unset;
    border-radius: 0;
    transition: unset;
    color: inherit;
    width: unset;
  }
  
  .rtwSizes label {
    display: inline-block;
    width: auto;
    padding: 10px;
    border: solid 1px #ccc;
    transition: all 0.3s;
    background-color: #e3e2e2;
    border-radius: 5px;
  }

  .rtwSizes input[type="checkbox"] {
    display: none;
  }

  .rtwSizes input[type="checkbox"]:checked + label {
    border: solid 1px #e7e7e7;
    background-color: #ef1717;
    color: #fff;
  }

  .mb-10{
  	margin-bottom: 10px;
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


	$('.rtw-choice').on('change', function() {
	  var value = $(this).val();

	  if(value == 'yes'){
	    $('.rtwSizes').attr('hidden', !this.checked);
	    // rtw = 'yes';

			if($("#XS").prop("checked") == true){
	    	$('#XSquantity').attr('hidden', !this.checked);
				// console.log($("#XS").val());
			}else{
	    	$('#XSquantity').attr('hidden', this.checked);
	    	// console.log($("#XSquantity").find("input").val());
			}

			if($("#S").prop("checked") == true){
	    	$('#Squantity').attr('hidden', !this.checked);
				// console.log($("#S:checked").val());
			}else{
	    	$('#Squantity').attr('hidden', this.checked);
			}
			
			if($("#M").prop("checked") == true){
	    	$('#Mquantity').attr('hidden', !this.checked);
				// console.log($("#M:checked").val());
			}else{
	    	$('#Mquantity').attr('hidden', this.checked);
			}
			
			if($("#L").prop("checked") == true){
	    	$('#Lquantity').attr('hidden', !this.checked);
				// console.log($("#L:checked").val());
			}else{
	    	$('#Lquantity').attr('hidden', this.checked);
			}
			
			if($("#XL").prop("checked") == true){
	    	$('#XLquantity').attr('hidden', !this.checked);
				// console.log($("#XL:checked").val());
			}else{
	    	$('#XLquantity').attr('hidden', this.checked);
			}
			
			if($("#XXL").prop("checked") == true){
	    	$('#XXLquantity').attr('hidden', !this.checked);
				// console.log($("#XXL:checked").val());
			}else{
	    	$('#XXLquantity').attr('hidden', this.checked);
			}
			

	    $('#measurement-choices').empty();
	    $('#measurement-input').empty(); //para ma wala ang existing if ever naa

	  }else{
	    $('.rtwSizes').attr('hidden', this.checked);
	    // $(".sizes").prop("checked", false);
	    $('#XSquantity').attr('hidden', this.checked);
	    $('#Squantity').attr('hidden', this.checked);
	    $('#Mquantity').attr('hidden', this.checked);
	    $('#Lquantity').attr('hidden', this.checked);
	    $('#XLquantity').attr('hidden', this.checked);
	    $('#XXLquantity').attr('hidden', this.checked);
	    // rtw = 'no';
	  }
	});

	$('.sizes').on('change', function() {
	  var value = $(this).val();
	  var totalQuantity;
	  // console.log(value);

	  if(value == 'XS'){
	    $('#XSquantity').attr('hidden', !this.checked);
	  }else if(value == 'S'){
	    $('#Squantity').attr('hidden', !this.checked);
	  }else if(value == 'M'){
	    $('#Mquantity').attr('hidden', !this.checked);
	  }else if(value == 'L'){
	    $('#Lquantity').attr('hidden', !this.checked);
	  }else if(value == 'XL'){
	    $('#XLquantity').attr('hidden', !this.checked);
	  }else if(value == 'XXL'){
	    $('#XXLquantity').attr('hidden', !this.checked);
	  }

	  if($("#XS").prop("checked") == false){
    	$("#XSquantity").find("input").val(null);
    	// console.log($("#XSquantity").find("input").val())
		}
		if($("#S").prop("checked") == false){
    	$("#Squantity").find("input").val(null);
		}
		if($("#M").prop("checked") == false){
    	$("#Mquantity").find("input").val(null);
		}
		if($("#L").prop("checked") == false){
    	$("#Lquantity").find("input").val(null);
		}
		if($("#XL").prop("checked") == false){
    	$("#XLquantity").find("input").val(null);
		}
		if($("#XXL").prop("checked") == false){
    	$("#XXLquantity").find("input").val(null);
		}

	  // totalQuantity = $('#Squantity').val() + $('#Mquantity').val() + $('#Lquantity').val() + $('#XLquantity').val() + $('#XXLquantity').val() + $('#XLquantity').val();
	  // console.log(totalQuantity);

	  // $('#quantity').append(totalQuantity);

	});

	$('#gender-select').on('change', function(){
	  $('#measurement-choices').empty();
	  $('#measurement-input').empty();
	  $('#category-select').empty();

	  var gender = $(this).val();

	  $('#category-select').prop('disabled',false);

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

	$('#category-select').on('change', function(){
		var rtw = $(".rtw-choice:checked").val();
	  var categoryID = $(this).val();
	  $('#measurement-choices').empty();
	  $('#measurement-input').empty();
	  // console.log(rtw);

	  if(rtw == 'no'){
	  $.ajax({
	    url:"/hinimo/public/getMeasurements/"+categoryID,
	    success:function(data){
	      data.measurements.forEach(function(measurement){
	        var measurementID = measurement.id;
	        // $('#measurement-input').append('<input type="text" name="mCategory[]" class="form-control" value="'+measurement.id+'" hidden>');
	        $('#measurement-choices').append('<input type="checkbox" id="'+ measurement.id +'" name="'+ categoryID +'['+measurement.mName +']" value="'+measurement.mName+'" class="mb-10 measurements">&nbsp;');
	        $('#measurement-choices').append('<label for="'+ measurement.id +'">'+ measurement.mName +'</label><br>');

	        
	      });
	    }
	  });
	  }
	});

	$('body').on('change', '.measurements', function() {
	  var measurement = $(this).val();
	  // console.log(measurement);
	  $('#measurement-input').append('<label for="">'+measurement +'</label><br> &nbsp;');
	  $('#measurement-input').append('<input type="text" name="measurementData['+measurement +']" class="mb-10" placeholder="'+measurement+'">&nbsp; <br>');
	  // $('#forRentPrice').attr('hidden',!this.checked)
	}); 

</script>
@endsection