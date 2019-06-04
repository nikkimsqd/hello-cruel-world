@extends('layouts.boutique')
@extends('boutique.sections')





@section('content')
<section class="content">
<div class="row">
<div class="col-md-12">

<div class="box">

<div class="box-header with-border">
  <h3 class="box-title">Add Product</h3>
</div>


<form action="{{ url('/saveproduct') }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
  <div class="box-body">
  	<div class="col-md-6">
	    <div class="form-group">
	     <label>Product Name</label>
			 <input type="text" name="productName" class="input form-control" placeholder="Enter product name">
	    </div>

	    <div class="form-group">
	      <label>Product Description</label>
	      <textarea name="productDesc" rows="3" cols="50" class="input form-control"></textarea>
	    </div>

      <div class="form-group">
        <label>Product Category</label>
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
      </div>
  	</div>

  	<div class="col-md-6">
      <div class="form-group">
       <label>Item Availability:</label><br>
       <input type="checkbox" id="forRent" name="forRent" class="minimal-red" value="true"> For Rent &nbsp;&nbsp;&nbsp;
       <input type="checkbox" id="forSale" name="forSale" class="minimal-red" value="true"> For Sale
      </div>

      <div class="form-group">
        <label>Retail Price</label>
        <input type="number" id="forSalePrice" name="productPrice" class="input form-control" disabled>
      </div>

      <div class="form-group">
        <label>Rent Price</label>
        <input type="number" id="forRentPrice" name="rentPrice" class="input form-control" disabled>
      </div>

      <div class="form-group">
       <label>Is item customizable?</label><br>
         <input type="radio" name="customizable" class="minimal-red" value="Yes"> Yes
         <input type="radio" name="customizable" class="minimal-red" value="No"> No
      </div>

	    <div class="form-group">
	     <label>Add Image:</label>
			 <input type="file" name="file[]" multiple>
	    </div>

      <label>Add Tags:</label>
      <div class="form-group tags">
       @foreach($tags as $tag)
       <input type="checkbox" name="tags[]" id="{{$tag['name']}}" value="{{$tag['id']}}">
       <label for="{{$tag['name']}}">{{$tag['name']}}</label>
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

</style>

@endsection




@section('scripts')

<script type="text/javascript">

  $('#forRent').on('change', function() {
      $('#forRentPrice').attr('disabled',!this.checked)
  });

  $('#forSale').on('change', function() {
      $('#forSalePrice').attr('disabled',!this.checked)
  });

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