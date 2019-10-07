@extends('layouts.boutique')
@extends('boutique.sections')


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
          <label>Quantity:</label><br>
          <input type="number" name="quantity" class="input form-control">
        </div>
        
        <label>Add Tags:</label>
        <div class="form-group tags">
           @foreach($categories as $category)
           @foreach($tags as $tag)
           @if($category['id'] == $tag['categoryID'])
           <input type="checkbox" name="tags[]" id="{{$tag['tagName']}}" value="{{$tag['id']}}">
           <label for="{{$tag['tagName']}}">{{$tag['tagName']}}</label>
           @endif
           @endforeach
           @endforeach
        </div>
      </div> <!-- column closing -->

      <div class="col-md-6">
        <div class="form-group">
          <label>Item Availability:</label><br>
          <input type="checkbox" id="forRent" name="forRent" class="minimal-red" value="true"> For Rent &nbsp;&nbsp;&nbsp;
          <input type="checkbox" id="forSale" name="forSale" class="minimal-red" value="true"> For Sale
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

          <label>Cities item is available for rent</label><br>


          <label id="city-id" hidden>Select Cities:</label>
          <div name="cities" id="city-select" style="column-count: 3">
          @foreach($cities as$city)
          <input type="checkbox" name="locationsAvailable[]" value="{{$city['citymunCode']}}" id="{{$city['citymunDesc']}}"> {{$city['citymunDesc']}}<br>
          @endforeach
          </div>
        </div>

    	</div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <h4>Select Items:</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        @foreach($products as $product)
          <div class="col-md-3">
              <?php $counter = 1; ?>
              @foreach( $product->productFile as $image)
                  @if($counter == 1)
                      <label class="product-top product-top{{$product['id']}}">
                          <input type="checkbox" name="products[]" class="product" value="{{$product['id']}}">
                          <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: 100%; object-fit: cover;">
                      </label>
                  @endif
                  <?php $counter++; ?>
              @endforeach
          </div>
        @endforeach
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
    border: 2px solid #f00;
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
  // if(this.checked){
  //   $('#forSalePrice').append('<label>Retail Price</label> <br> <input type="number" id="forSalePrice" name="productPrice" class="input form-control">');
  // }else{
  //   $('#forSalePrice').empty();
  // }
});

$('#gender-select').on('change', function(){
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