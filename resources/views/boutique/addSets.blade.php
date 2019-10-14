@extends('layouts.boutique')
@extends('boutique.sections')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{url('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li><a href="{{url('sets')}}">Sets</a></li>
  <li class="active">{{$page_title}}</li>
</ol>
@endsection

@section('content')
<section class="content">
<div class="row">
<div class="col-md-12">

<div class="box">

<div class="box-header with-border">
  <h3 class="box-title">Add Set</h3>
</div>


<form action="{{ url('/saveset') }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
  <div class="box-body">
    <div class="row">
      <div class="col-md-12">

        <!-- ----------------------------------------------------------------- -->
        <div class="col-md-12 view-item">
         <!--  <div class="row">
            
          </div> -->
        </div>
        <hr>
        <!-- <div class="row"> -->
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-3">
              <select class="form-control" name="gender" id="gender-select" required>
                  <option disabled selected="selected">Select gender</option>
                  <option value="Womens">Womens</option>
                  <option value="Mens">Mens</option>
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-control" name="category" id="category-select" disabled required>
                <option disabled selected="selected"></option>
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-control select2" name="subcategory" id="subcategory-select" disabled required>
                <option disabled selected="selected"></option>
              </select>
            </div>
          </div>
          <br>
          <div class="row item-choices" style="max-height: 450px; overflow-y: scroll; border: 1px solid #e1e1e1;">
            <h4>&nbsp;&nbsp; Select Items:</h4>

            <!-- @foreach($products as $product)
              <div class="col-md-2">
                  <?php $counter = 1; ?>
                  @foreach( $product->productFile as $image)
                      @if($counter == 1)
                          <label class="product-top product-top{{$product['id']}}">
                              <input type="checkbox" name="products[]" class="product" value="{{$product['id']}}">
                              <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: 200px; object-fit: cover;">
                          </label>
                      @endif
                      <?php $counter++; ?>
                  @endforeach
              </div>
            @endforeach -->
          </div>
        </div>


        <!-- </div> -->
        <!-- ----------------------------------------------------------------- -->
        <br><br><br><br><br><br>

        <div class="row">
        	<div class="col-md-6">
            
      	    <div class="form-group">
      	     <label>Set Name</label>
      			 <input type="text" name="setName" class="input form-control" placeholder="Enter set name" required>
      	    </div>

      	    <div class="form-group">
      	      <label>Set Description</label>
      	      <textarea name="setDesc" rows="3" cols="50" class="input form-control" required></textarea>
      	    </div>

            <div class="form-group">
              <label>In-Stock:</label><br>
              <input type="number" name="quantity" class="input form-control">
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
              <label>Item Availability:</label><br>
              <input type="checkbox" id="forRent" name="forRent" class="minimal-red" value="true">
              <label for="forRent">For Rent </label> &nbsp;&nbsp;&nbsp;
              <input type="checkbox" id="forSale" name="forSale" class="minimal-red" value="true"> 
              <label for="forSale">For Sale</label>
            </div>

            <div class="form-group" id="forSalePrice" hidden>
              <label>Retail Price</label>
              <input type="number" name="retailPrice" class="input form-control" autofocus><br>
            </div>

            <div class="form-group" id="forRentPrice" hidden>
              <label>Rent Price</label> <br>
              <input type="number" name="rentPrice" class="input form-control" autofocus><br>

              <label>Deposit Amount</label>
              <input type="number" name="depositAmount" class="input form-control"><br>

              <label>Penalty Amount if item is returned late (per day)</label>
              <input type="number" name="penaltyAmount" class="input form-control"><br>

              <label>Duration of days item is available for rent</label>
              <input type="number" name="limitOfDays" class="input form-control"><br>

              <label>Amount of fine incase item is lost by user</label>
              <input type="number" name="fine" class="input form-control"><br>

              <!-- <label>Cities item is available for rent</label><br>
              <label id="city-id" hidden>Select Cities:</label>
              <div name="cities" id="city-select" style="column-count: 3">
                @foreach($cities as$city)
                <input type="checkbox" name="locationsAvailable[]" value="{{$city['citymunCode']}}" id="{{$city['citymunDesc']}}"> {{$city['citymunDesc']}}<br>
                @endforeach
              </div> -->
            </div>

        	</div>
        </div>

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

  .product-top{
    height: 250px;
    width: 100%;
    overflow: hidden;
  }

  .product[type=checkbox] { 
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
  }

  .product[type=checkbox] + img {
    cursor: pointer;
  }

  .product[type=checkbox]:checked + img {
    /*outline: 2px solid #f00;*/
    border: 6px solid #c62525;
    border-radius: 2px; 
    opacity: 0.9;
  }

  .view-item{
    margin-bottom: 15px;
  }

</style>

@endsection




@section('scripts')

<script type="text/javascript">

$('.products').addClass("active");
$('.allsets').addClass("active");

$('#forRent').on('change', function() {
  $('#forRentPrice').attr('hidden',!this.checked)
});

$('#forSale').on('change', function() {
    $('#forSalePrice').attr('hidden',!this.checked)
});

$('#gender-select').on('change', function(){
  $('#category-select').empty();
  $('.view-item').empty();
  $('.item-choices').empty();
  $('.tags').empty();
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
  var gender = $('#gender-select').val();
  var categoryID = $(this).val();
  // var fileAddress = "<?= asset('/uploads') ?>";

  $('.item-choices').empty();
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


}); 

$('#subcategory-select').on('change', function(){
  var gender = $('#gender-select').val();
  var categoryID = $('#category-select').val();
  var subcategoryID = $(this).val();
  var fileAddress = "<?= asset('/uploads') ?>";

  console.log(subcategoryID);
  $('.item-choices').empty();

  $.ajax({
    url: "{{url('getProductsforSet')}}/"+categoryID+'/'+subcategoryID,
    success:function(data){

      if(data.productsArray != 0){
        data.productsArray.forEach(function(product){
          var productID = product.id;
          var picture = data.productURL[productID][0]; //contains the filename

          // console.log('product');
          $('.item-choices').append(
            '<div class="col-md-2">'+ 
              '<label class="product-top product-top'+product.id+'">' +
                '<input type="checkbox" name="choices-products[]" class="product " id="item-product" value="'+product.id+'">' +
                '<img src="'+ fileAddress + picture +'" style="width:100%; height: 200px; object-fit: cover;">' +
              '</label>'+
            '</div>'
          );
        });
      }else{
          $('.item-choices').append('<br><h4>&nbsp;&nbsp;<i>You currently dont have a product that is available for ready-to-wear in the selected category.</i></h4><br>');
          // console.log('asasa');
      }
    }
  });
});


$(".item-choices").on('change', '.product', function(){
  var productID = $(this).val();
  var fileAddress = "<?= asset('/uploads') ?>";

  $.ajax({
    url:"{{url('getProductforSet')}}/"+productID, 
    dataType: 'json',
    success:function(data){
      var picture = data.productURL[productID][0]; //contains the filename

      console.log(data.sizes);

      $('.view-item').append(
          '<div class="row" style="margin-bottom: 10px;">'+
            '<div class="col-md-5">'+ 
                '<img src="'+ fileAddress + picture +'" style="width:100%; height: 400px; object-fit: cover;">' +

            '</div>'+
            '<div class="col-md-5">'+ 
                '<input type="checkbox" name="products[]" value="'+data.product.id+'" checked hidden>' +
                '<h4>Product Name: <b>'+data.product.productName+'</b></h4>' +
                '<h4>Product Description: <b>'+data.product.productDesc+'</b></h4>' +
                  data.sizes +
            '</div>'+
          '</div> <hr>'
      );

    }
  });

});


$('#add-tag').on('click', function(){
  var tag = $('#input-tag').val();

  $('#inputted-tags').append(
    '<input type="text" name="tags[]" class="selected-tags" id="'+ tag +'" value="'+ tag +'" hidden>'+
    '<label for="'+ tag +'">'+ tag +'</label> ');

  $('#input-tag').val('');
  $('#input-tag').prop('autofocus', true);

});

$('body').on('click', '.selected-tags', function(){
  var tag = $(this).val();
  console.log(tag);
  $('#'+tag).remove();
  $('label[for='+tag+']').remove();
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


// $('#province-select').on('change', function(){
//   $('#city-select').empty();
//   $('#brgy-select').empty();
//   var provCode = $(this).val();
  
//   // $('#city-select').prop('disabled',false);;

//   $.ajax({
//     url: "/hinimo/public/boutique-getCity/"+provCode,
//     success:function(data){
//       $('#city-select').append('<option selected disabled value=""></option>');
//         data.cities.forEach(function(city){

//         if(city === null){
//         console.log(provCode);
//         }else{
//           $('#city-select').prop('disabled',false);
//           $('#city-select').apendp(
//           '<option value="'+city.citymunCode+'">'+city.citymunDesc+'</option>'
//           );
//         }
//       });
//     }
//   }); //ajaxclosing
// });


$('#province-select').on('change', function(){
  $('#city-select').empty();
  // $('#brgy-select').empty();
  var provCode = $(this).val();
  
  // $('#city-select').prop('disabled',false);;

  $.ajax({
    url: "/hinimo/public/boutique-getCity/"+provCode,
    success:function(data){

      $('#city-id').prop('hidden',false);

        data.cities.forEach(function(city){
        console.log(city);
         $('#city-select').append(
        '<input type="checkbox" name="locationsAvailable[]" value="'+city.citymunCode+'" id="'+city.citymunDesc+'"> '+city.citymunDesc+'<br>'
        );
      });
    }
  }); //ajaxclosing
});


// $('#city-select').on('change', function(){
//   // console.log("adadad");

//   $('#brgy-select').empty();

//   var citymunCode = $(this).val();

//   $.ajax({
//      url: "/hinimo/public/boutique-getBrgy/"+citymunCode,
//     success:function(data){
//       $('#barangay-id').prop('hidden',false);

//       data.brgys.forEach(function(brgy){
//         $('#brgy-select').append(
//         '<input type="checkbox" name="locationsAvailable[]" value="'+brgy.brgyCode+'" id="'+brgy.brgyDesc+'"> '+brgy.brgyDesc+'<br>'
//         );
//       });
//     }
//   });
// });

</script>
@endsection