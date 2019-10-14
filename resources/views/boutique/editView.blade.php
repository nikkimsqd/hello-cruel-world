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

				                  		foreach($rtwSizes as $rtwSize => $value){
											array_push($checked, $rtwSize);
										}

										// foreach($checked as $check){
											// var_dump($rtwSizes);
										// }
										// echo " Mao ni naa sa db";
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
		                  		@foreach($rtwSizes as $rtwSize => $value)

									@if(in_array($rtwSize, $checked))
								    <div class="form-group" id="{{strtoupper($rtwSize)}}quantity">
								        <label>Enter quantity for {{$rtwSize}}:</label>
								        <input id="{{strtoupper($rtwSize)}}" type="number" name="sizes[{{$rtwSize}}]" class="input form-control" value="{{$value}}">
								    </div>
							        @else
							      	<div class="form-group" id="{{strtoupper($rtwSize)}}quantity" hidden>
								        <label>Enter quantity for {{$rtwSize}}:</label>
								        <input type="number" name="sizes[{{$rtwSize}}]" class="input form-control">
							      	</div>
							        @endif
								@endforeach

								<!-- @if(in_array('xs', $checked))
							    <div class="form-group" id="XSquantity">
							        <label>Enter quantity for XS:</label>
							        <input id="XS" type="number" name="sizes[xs]" class="input form-control" value="{{$value}}">
							    </div>
						        @else -->
						      	<div class="form-group" id="XSquantity" hidden>
							        <label>Enter quantity for XS:</label>
							        <input type="number" name="sizes[xs]" class="input form-control">
						      	</div>
						        <!-- @endif -->
				      
								<!-- @if(in_array('s', $checked))
						      	<div class="form-group" id="Squantity">
							        <label>Enter quantity for S:</label>
							        <input type="number" name="sizes[s]" class="input form-control" value="{{$value}}">
						      	</div>
						        @else -->
						        <div class="form-group" id="Squantity" hidden>
							        <label>Enter quantity for S:</label>
							        <input type="number" name="sizes[s]" class="input form-control">
							      </div>
						        <!-- @endif -->
					      
								<!-- @if(in_array('m', $checked))
							    <div class="form-group" id="Mquantity">
							        <label>Enter quantity for M:</label>
							        <input type="number" name="sizes[m]" class="input form-control" value="{{$value}}">
						      	</div>
						        @else -->
						        <div class="form-group" id="Mquantity" hidden>
							        <label>Enter quantity for M:</label>
							        <input type="number" name="sizes[m]" class="input form-control">
						      	</div>
						        <!-- @endif -->
					      
								<!-- @if(in_array('l', $checked))
						      	<div class="form-group" id="Lquantity" >
							        <label>Enter quantity for L:</label>
							        <input type="number" name="sizes[l]" class="input form-control" value="{{$value}}">
						      	</div>
						        @else -->
						        <div class="form-group" id="Lquantity" hidden>
							        <label>Enter quantity for L:</label>
							        <input type="number" name="sizes[l]" class="input form-control">
						      	</div>
					        	<!-- @endif -->
					      
								<!-- @if(in_array('xl', $checked))
						      	<div class="form-group" id="XLquantity">
							        <label>Enter quantity for XL:</label>
							        <input type="number" name="sizes[xl]" class="input form-control" value="{{$value}}">
						      	</div>
						        @else -->
						        <div class="form-group" id="XLquantity" hidden>
							        <label>Enter quantity for XL:</label>
							        <input type="number" name="sizes[xl]" class="input form-control">
						      	</div>
						        <!-- @endif -->
					      
								<!-- @if(in_array('xxl', $checked))
						      	<div class="form-group" id="XXLquantity">
							        <label>Enter quantity for XXL:</label>
							        <input type="number" name="sizes[xxl]" class="input form-control" value="{{$value}}">
						      	</div>
						        @else -->
						        <div class="form-group" id="XXLquantity" hidden>
							        <label>Enter quantity for XXL:</label>
							        <input type="number" name="sizes[xxl]" class="input form-control">
						      	</div>
						        <!-- @endif -->

					        @else <!-- //if dili gikan rtw ang item -->
						      	<div class="form-group rtwSizes" hidden>
							        <label class="excluded">Choose available sizes:</label>
							        <input type="checkbox" id="XS" value="XS" class="sizes">
							        <label for="XS">XS</label>
							        <input type="checkbox" id="S" value="S" class="sizes">
							        <label for="S">S</label>
							        <input type="checkbox" id="M" value="M" class="sizes">
							        <label for="M">M</label>
							        <input type="checkbox" id="L" value="L" class="sizes">
							        <label for="L">L</label>
							        <input type="checkbox" id="XL" value="XL" class="sizes">
							        <label for="XL">XL</label>
							        <input type="checkbox" id="XXL" value="XXL" class="sizes">
							        <label for="XXL">XXL</label>
						      	</div>
		      
						      	<div class="form-group" id="XSquantity" hidden>
							        <label>Enter quantity for XS:</label>
							        <input type="number" name="sizes[xs]" class="input form-control">
						      	</div>
							      
						      	<div class="form-group" id="Squantity" hidden>
							        <label>Enter quantity for S:</label>
							        <input type="number" name="sizes[s]" class="input form-control">
						      	</div>
							      
						      	<div class="form-group" id="Mquantity" hidden>
							        <label>Enter quantity for M:</label>
							        <input type="number" name="sizes[m]" class="input form-control">
						      	</div>
							      
						      	<div class="form-group" id="Lquantity" hidden>
							        <label>Enter quantity for L:</label>
							        <input type="number" name="sizes[l]" class="input form-control">
						      	</div>
							      
						      	<div class="form-group" id="XLquantity" hidden>
							        <label>Enter quantity for XL:</label>
							        <input type="number" name="sizes[xl]" class="input form-control">
						      	</div>
							      
						      	<div class="form-group" id="XXLquantity" hidden>
							        <label>Enter quantity for XXL:</label>
							        <input type="number" name="sizes[xxl]" class="input form-control">
						      	</div>
					      	@endif <!-- end sa if(in_array('xs', checked)) -->

						    <div class="form-group">
						      	<h4>Product Category</h4>
						      	<select class="form-control select2" name="gender" id="gender-select">
									@if($product->getsubCategory->getCategory['gender'] === "Womens")
									<option selected value="Womens">Womens</option>
									<option value="Mens">Mens</option>

									@elseif($product->getsubCategory->getCategory['gender'] === "Mens")
									<option value="Womens">Womens</option>
									<option selected value="Mens">Mens</option>
									<!-- else
									<option selected disabled></option>
									<option value="Womens">Womens</option>
									<option  value="Mens">Mens</option> -->
									@endif
							  	</select><br>

							  	@if($product['category'] != null)
						        <select class="form-control select2" name="category" id="category-select" required>
						        	@foreach($categories as $category)
						        	@if($product->getsubCategory->getCategory['gender'] == $category['gender'])
							        	@if($category['id'] == $product['category'])
							          	<option value="{{$category['id']}}" selected>{{$category['categoryName']}}</option>
						          		@else
							          	<option value="{{$category['id']}}">{{$category['categoryName']}}</option>
							          	@endif
						          	@endif
						          	@endforeach
						        </select><br>
						        @endif

							  	@if($product['category'] != null)
						        <select class="form-control select2" name="subcategory" id="subcategory-select" required>
						        	@foreach($subcategories as $subcategory)
							        	@if($product->getsubCategory->getCategory['id'] == $subcategory['categoryID'])
								        	@if($subcategory['id'] == $product['category'])
								          		<option value="{{$subcategory['id']}}" selected>{{$subcategory['subcatName']}}</option>
							          		@else
								          		<option value="{{$subcategory['id']}}">{{$subcategory['subcatName']}}</option>
								          	@endif
							          	@endif
						          	@endforeach
						        </select>
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

						        	@foreach($product->getSubCategory->getCategory->getMeasurements as $getMeasurements)
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

						       
						        <div class="col-md-12" id="measurement-input">
						        	@if($product['measurements'] != null)
						        	<?php $measurements = json_decode($product['measurements']); ?>
						        	@foreach($measurements as $measurement => $value)
										<label for="">{{$measurement}}</label><br> &nbsp; 
										<input type="text" name="measurementData[{{$measurement}}]" class="mb-10" placeholder="" value="{{$value}}">&nbsp; <br>
									@endforeach
									@endif
						        </div>
					    	</div>


					    	@if(count($itemtags) > 0)
						    <h4>Edit Tags:</h4>
					      	<div class="input-group">
						        <input type="text" id="input-tag" placeholder="Add Tag ..." class="form-control">
						          <span class="input-group-btn">
						            <a class="btn btn-primary" id="add-tag">Add</a>
						          </span>
					      	</div><br>

						    <div class="form-group tags" id="inputted-tags">
								@foreach($tags as $tag)
									<input type="text" name="tags[]" id="{{$tag}}" value="{{$tag}}" class="selected-tags" hidden>
									<label for="{{$tag}}">{{$tag}}</label>
								@endforeach
					      	</div>
								<br><span><i>Click on a tag to remove</i></span>
					      	@else
						    <h4>Add Tags:</h4>
					      	<div class="input-group">
						        <input type="text" id="input-tag" placeholder="Add Tag ..." class="form-control">
						          <span class="input-group-btn">
						            <a class="btn btn-primary" id="add-tag">Add</a>
						          </span>
					      	</div><br>

						    <div class="form-group tags" id="inputted-tags">
								@foreach($tags as $tag)
									<input type="text" name="tags[]" id="{{$tag}}" value="{{$tag}}" class="selected-tags" hidden>
									<label for="{{$tag}}">{{$tag}}</label>
								@endforeach
					      	</div>
								<br><br><span><i>Click on a tag to remove</i></span>
							@endif

							</div>

							<!-- <div class="col-md-6">
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

					      <div class="form-group in-stock" hidden>
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
      	$('#forRentPrice').find('input').prop('required', true);
      } else { 
      	$('#forRentPrice').find('input').prop('required', false);	
      	$('#forRentPrice').hide();

      }

  	});

	$('#forSale').change(function() {

    if($('#forSale').is(':checked')) {
    	$('#forSalePrice').show();
    	$('#forSalePrice').find('input').prop('required', true);
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
	  	$('.in-stock').attr('hidden', this.checked);
    	$('#quantity').prop('required', false);
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
	  	$('.in-stock').attr('hidden', !this.checked);
    	$('#quantity').prop('required', true);
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

	$('#XSquantity').on('keyup', 'input', function(){
		var XSquantity = parseInt($('#XSquantity').find('input').val()) || 0;
		var Squantity = parseInt($('#Squantity').find('input').val()) || 0;
		var Mquantity = parseInt($('#Mquantity').find('input').val()) || 0;
		var Lquantity = parseInt($('#Lquantity').find('input').val()) || 0;
		var XLquantity = parseInt($('#XLquantity').find('input').val()) || 0;
		var XXLquantity = parseInt($('#XXLquantity').find('input').val()) || 0;

		var quantity = XSquantity + Squantity + Mquantity + Lquantity + XLquantity + XXLquantity;
		$('#quantity').val(quantity);
		console.log($('#quantity').val());
	});
	$('#Squantity').on('keyup', 'input', function(){
		var XSquantity = parseInt($('#XSquantity').find('input').val()) || 0;
		var Squantity = parseInt($('#Squantity').find('input').val()) || 0;
		var Mquantity = parseInt($('#Mquantity').find('input').val()) || 0;
		var Lquantity = parseInt($('#Lquantity').find('input').val()) || 0;
		var XLquantity = parseInt($('#XLquantity').find('input').val()) || 0;
		var XXLquantity = parseInt($('#XXLquantity').find('input').val()) || 0;

		var quantity = XSquantity + Squantity + Mquantity + Lquantity + XLquantity + XXLquantity;
		$('#quantity').val(quantity);
		console.log($('#quantity').val());
	});
	$('#Mquantity').on('keyup', 'input', function(){
		var XSquantity = parseInt($('#XSquantity').find('input').val()) || 0;
		var Squantity = parseInt($('#Squantity').find('input').val()) || 0;
		var Mquantity = parseInt($('#Mquantity').find('input').val()) || 0;
		var Lquantity = parseInt($('#Lquantity').find('input').val()) || 0;
		var XLquantity = parseInt($('#XLquantity').find('input').val()) || 0;
		var XXLquantity = parseInt($('#XXLquantity').find('input').val()) || 0;

		var quantity = XSquantity + Squantity + Mquantity + Lquantity + XLquantity + XXLquantity;
		$('#quantity').val(quantity);
		console.log($('#quantity').val());
	});
	$('#Lquantity').on('keyup', 'input', function(){
		var XSquantity = parseInt($('#XSquantity').find('input').val()) || 0;
		var Squantity = parseInt($('#Squantity').find('input').val()) || 0;
		var Mquantity = parseInt($('#Mquantity').find('input').val()) || 0;
		var Lquantity = parseInt($('#Lquantity').find('input').val()) || 0;
		var XLquantity = parseInt($('#XLquantity').find('input').val()) || 0;
		var XXLquantity = parseInt($('#XXLquantity').find('input').val()) || 0;

		var quantity = XSquantity + Squantity + Mquantity + Lquantity + XLquantity + XXLquantity;
		$('#quantity').val(quantity);
		console.log($('#quantity').val());
	});
	$('#XLquantity').on('keyup', 'input', function(){
		var XSquantity = parseInt($('#XSquantity').find('input').val()) || 0;
		var Squantity = parseInt($('#Squantity').find('input').val()) || 0;
		var Mquantity = parseInt($('#Mquantity').find('input').val()) || 0;
		var Lquantity = parseInt($('#Lquantity').find('input').val()) || 0;
		var XLquantity = parseInt($('#XLquantity').find('input').val()) || 0;
		var XXLquantity = parseInt($('#XXLquantity').find('input').val()) || 0;

		var quantity = XSquantity + Squantity + Mquantity + Lquantity + XLquantity + XXLquantity;
		$('#quantity').val(quantity);
		console.log($('#quantity').val());
	});
	$('#XXLquantity').on('keyup', 'input', function(){
		var XSquantity = parseInt($('#XSquantity').find('input').val()) || 0;
		var Squantity = parseInt($('#Squantity').find('input').val()) || 0;
		var Mquantity = parseInt($('#Mquantity').find('input').val()) || 0;
		var Lquantity = parseInt($('#Lquantity').find('input').val()) || 0;
		var XLquantity = parseInt($('#XLquantity').find('input').val()) || 0;
		var XXLquantity = parseInt($('#XXLquantity').find('input').val()) || 0;

		var quantity = XSquantity + Squantity + Mquantity + Lquantity + XLquantity + XXLquantity;
		$('#quantity').val(quantity);
		console.log($('#quantity').val());
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
	  $('#subcategory-select').empty();

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
	  $('#tags').empty();
	  $('#subcategory-select').empty();
	  // console.log(rtw);

	    $.ajax({
	      url:"{{url('getSubcategory/')}}/"+categoryID,
	      success:function(data){
	        $('#subcategory-select').append('<option selected disabled value=""></option>');
	        data.subcategories.forEach(function(subcategory){
	          $('#subcategory-select').append('<option value="'+subcategory.id+'">'+subcategory.subcatName+'</option>');
	        });
	      }
	    });


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

    $.ajax({
      url:"{{url('getCategoryTags')}}/"+categoryID,
      success:function(data){
        data.categoryTags.forEach(function(categoryTag){
	        // categoryTags.forEach(function(categoryTag){
	        	console.log(categoryTag);
	          	$('#tags').append(
	            '<input type="checkbox" name="tags[]" id="tag'+ categoryTag.id +'" value="'+ categoryTag.id +'">'+
	            '<label for="tag'+ categoryTag.id +'">'+ categoryTag.tagName +'</label> ');
        	// });
        });
      }
    });
	});

	$('body').on('change', '.measurements', function() {
	  var measurement = $(this).val();
	  // console.log(measurement);
	  $('#measurement-input').append('<label for="">'+measurement +'</label><br> &nbsp;');
	  $('#measurement-input').append('<input type="text" name="measurementData['+measurement +']" class="mb-10" placeholder="'+measurement+'">&nbsp; <br>');
	  // $('#forRentPrice').attr('hidden',!this.checked)
	}); 


	$('#add-tag').on('click', function(){
		var tag = $('#input-tag').val();

		$('#inputted-tags').append(
			'<input type="text" name="tags[]" class="selected-tags" id="'+ tag +'" value="'+ tag +'" hidden>'+
			'<label for="'+ tag +'">'+ tag +'</label> ');

		$('#input-tag').val('');
		$('#input-tag').focus();

	});

	$('body').on('click', '.selected-tags', function(){
		var tag = $(this).val();
		console.log(tag);
		$('#'+tag).remove();
		$('label[for='+tag+']').remove();
	});


</script>
@endsection