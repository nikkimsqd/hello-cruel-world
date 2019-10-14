@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')
<section class="content">
<div class="row">
<div class="col-md-12">

<div class="box">

<div class="box-header with-border">
  <h3 class="box-title">Fill up the form below</h3>
</div>


<form action="{{ url('/saveproduct') }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
  <div class="box-body">
  	<div class="col-md-6">

      <div class="form-group">
        <h4>Add Image:</h4>
        <input type="file" name="file[]" multiple required>
      </div>
      
	    <div class="form-group">
	     <h4>Product Name</h4>
			 <input type="text" name="productName" class="input form-control" placeholder="Enter product name" required>
	    </div>

	    <div class="form-group">
	      <h4>Product Description</h4>
	      <textarea name="productDesc" rows="3" cols="50" class="input form-control" required></textarea>
	    </div>

      <div class="form-group">
        <h4>Is this a ready-to-wear item?:</h4>
        <input type="radio" id="yes" name="itemType" class="minimal-red rtw-choice" value="yes" required>
        <label for="yes">Yes</label>&nbsp;&nbsp;&nbsp;
        <input type="radio" id="no" name="itemType" class="minimal-red rtw-choice" value="no" required>
        <label for="no">No</label>&nbsp;&nbsp;&nbsp;
      </div>
      
      <div class="form-group rtwSizes" hidden>
        <h4 class="excluded">Choose available sizes:</h4>
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
        <input type="number" id="XSquantity" name="sizes[xs]" class="input form-control">
      </div>
      
      <div class="form-group" id="Squantity" hidden>
        <label>Enter quantity for S:</label>
        <input type="number" id="Squantity" name="sizes[s]" class="input form-control">
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

      <div class="form-group">
        <h4>Product Category</h4>
        <select class="form-control select2" name="gender" id="gender-select" required>
          <option disabled selected="selected"> </option>
          <option value="Womens">Womens</option>
          <option value="Mens">Mens</option>
        </select>
        <br>
        <select class="form-control select2" name="category" id="category-select" disabled required>
          <option disabled selected="selected"></option>
        </select>
        <br>
        <select class="form-control select2" name="subcategory" id="subcategory-select" disabled required>
          <option disabled selected="selected"></option>
        </select>

        <br>
        <div class="col-md-12" id="measurement-choices" style="column-count: 2">
        </div>

        <br><br>
        <div class="col-md-12" id="measurement-input">
        </div>
      </div>
      
      <label>Add Tags:</label>
      <div class="input-group">
        <input type="text" id="input-tag" placeholder="Add Tag ..." class="form-control">
          <span class="input-group-btn">
            <a class="btn btn-primary" id="add-tag">Add</a>
          </span>
      </div><br>

      <div class="form-group tags" id="inputted-tags">
      </div>
    </div> <!-- column closing -->

    <div class="col-md-6">
      

      
      <div class="form-group">
        <h4>In-Stock:</h4>
        <input type="number" name="quantity" id="quantity" class="input form-control" required>
      </div>

      <div class="form-group">
        <h4>Item Availability:</h4>
        <!-- <div class="icheckbox_minimal-blue"> -->
        <input type="checkbox" id="forRent" name="forRent" class="minimal" value="true"> For Rent &nbsp;&nbsp;&nbsp;
        <!-- </div> -->
        <input type="checkbox" id="forSale" name="forSale" class="minimal-red" value="true"> For Sale
      </div>

      <div class="form-group" id="forSalePrice" hidden>
        <h4>Retail Price</h4>
        <input type="number" name="retailPrice" class="input form-control" autofocus><br>
      </div>

      <div class="form-group" id="forRentPrice" hidden>
        <h4>Rent Price</h4>
        <input type="number" name="rentPrice" class="input form-control" autofocus>

        <h4>Deposit Amount</h4>
        <input type="number" name="cashban" class="input form-control"><br>

        <h4>Penalty Amount if item is returned late (per day)</h4>
        <input type="number" name="penaltyAmount" class="input form-control"><br>

        <h4>Duration of days item is available for rent</h4>
        <input type="number" name="limitOfDays" class="input form-control"><br>

        <h4>Amount of fine incase item is lost by user</h4>
        <input type="number" name="fine" class="input form-control"><br>

      </div>

  	</div>
  </div><!-- /.box-body -->

  <div class="box-footer" style="text-align: right;">
  	<a href="products" class="btn btn-warning"><i class="fa fa-arrow-left"> Back to Products</i></a>
	<input type="submit" name="btn_add" value="Add Product" class="btn btn-primary">
  </div>

</form>

</div>


</div>
</div>
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
</style>

@endsection




@section('scripts')

<script type="text/javascript">

  var rtw;

  $('.products').addClass("active");
  $('.allproducts').addClass("active");

  $('#forRent').on('change', function() {
    $('#forRentPrice').attr('hidden',!this.checked)
  });

  // $('#XSquantity').on('keyup', function(){
  //   console.log($(this).val());
  // });

  $('#forSale').on('change', function() { 
      $('#forSalePrice').attr('hidden',!this.checked)
    // if(this.checked){
    //   $('#forSalePrice').append('<label>Retail Price</label> <br> <input type="number" id="forSalePrice" name="productPrice" class="input form-control">');
    // }else{
    //   $('#forSalePrice').empty();
    // }
  });

  $('.rtw-choice').on('change', function() {
    var value = $(this).val();

    if(value == 'yes'){
      $('.rtwSizes').attr('hidden', !this.checked);
      rtw = 'yes';

      $('#measurement-choices').empty();
      $('#measurement-input').empty(); //para ma wala ang existing if ever naa

    }else{
      $('.rtwSizes').attr('hidden', this.checked);
      $(".sizes").prop("checked", false);
      $('#XSquantity').attr('hidden', this.checked);
      $('#Squantity').attr('hidden', this.checked);
      $('#Mquantity').attr('hidden', this.checked);
      $('#Lquantity').attr('hidden', this.checked);
      $('#XLquantity').attr('hidden', this.checked);
      $('#XXLquantity').attr('hidden', this.checked);
      rtw = 'no';
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

    // totalQuantity = $('#Squantity').val() + $('#Mquantity').val() + $('#Lquantity').val() + $('#XLquantity').val() + $('#XXLquantity').val() + $('#XLquantity').val();
    // console.log(totalQuantity);

    // $('#quantity').append(totalQuantity);

  });

  $('#gender-select').on('change', function(){
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
    var categoryID = $(this).val();
    $('#measurement-choices').empty();
    $('#measurement-input').empty();
    $('#subcategory-select').empty();
    $('#subcategory-select').prop('disabled',false);

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
          $('#measurement-choices').append('<input type="checkbox" id="'+ measurement.id +'" name="'+ categoryID +'['+measurement.mName +']" value="'+measurement.mName+'" class="mb-3 measurements">&nbsp;');
          $('#measurement-choices').append('<label for="'+ measurement.id +'">'+ measurement.mName +'</label><br>');
        });
      }
    });
    }

    // $.ajax({
    //   url:"{{url('getCategoryTags')}}/"+categoryID,
    //   success:function(data){
    //     data.categoryTags.forEach(function(categoryTag){
    //       $('#tags').append(
    //         '<input type="checkbox" name="tags[]" id="'+ categoryTag.id +'" value="'+ categoryTag.id +'">'+
    //         '<label for="'+ categoryTag.id +'">'+ categoryTag.tagName +'</label> ');
    //     });
    //   }
    // });
  }); 

  $('body').on('change', '.measurements', function() {
    var measurement = $(this).val();
    console.log(measurement);
    $('#measurement-input').append('<input type="text" name="measurementData['+measurement +']" class="mb-3" placeholder="'+measurement+'">&nbsp; <br><br>');
    // $('#forRentPrice').attr('hidden',!this.checked)
  });


  $('#add-tag').on('click', function(){
    var tag = $('#input-tag').val();

    $('#inputted-tags').append(
      '<input type="text" name="tags[]" class="selected-tags" id="'+ tag +'" value="'+ tag +'" hidden>'+
      '<label for="'+ tag +'">'+ tag +'</label> ');

    $('#input-tag').val('');
    $('#input-tag').prop('autofocus', true);

  });

  $('body').on('change', '.selected-tags', function(){
    var tag = $(this).val();
    console.log(tag);
    $('#'+tag).remove();
    $('label[for='+tag+']').remove();
  });



</script>
@endsection