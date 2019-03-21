@extends('layouts.boutique')


@section('titletext')
  Boutique de Filipina
@endsection

@section('page_title')
Edit Products
@endsection

@section('logo')
<!-- LOGO -->
    <a href="/hinimo/public/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>H</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Hinimo</span>
    </a>
@endsection

@section('content')

<div class="row">
<div class="col-md-12">

<div class="box">

<div class="box-header with-border">
  <h3 class="box-title">Edit Product</h3>
</div>


<form action="/hinimo/public/editproduct/{{$product['productID']}}" method="post" enctype="multipart/form-data">
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

	    @if($product['forSale'] != null)
	    <div class="form-group" id="forSalePrice">
	      <label>Retail Price</label>
		  <input type="number" name="productPrice" class="input form-control" value="{{ $product['productPrice'] }}" required>
	    </div>
	    @endif

	    @if($product['forRent'] != null)
	    <div class="form-group" id="forRentPrice">
	        <label>Rent Price</label>
	        <input type="number" name="rentPrice" value="{{ $product['rentPrice'] }}" class="input form-control" required>
	     </div>
	     @endif

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
			<label>Is item customizable?</label><br>
			@if($product['customizable'] == "Yes")
			<input type="radio" id="yes" name="customizable" class="" value="Yes" checked> <label for="yes">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" id="no" name="customizable" class="" value="No"> <label for="no">No</label>
			@else
			<input type="radio" id="yes" name="customizable" class="" value="Yes"> <label for="yes">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" id="no" name="customizable" class="" value="No" checked> <label for="no">No</label>
			@endif
      	</div>

	    <div class="form-group">
	    	<label>Add Image:</label>
			<input type="file" name="file[]" multiple>
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
  	<a href="/hinimo/public/viewproduct/{{$product['productID']}}" class="btn btn-warning"><i class="fa fa-arrow-left"> Back</i></a>
	<input type="submit" name="btn_add" value="Update Product" class="btn btn-primary">
  </div>

</form> 

</div>


</div> <!-- main column -->
</div> <!-- row -->


@endsection


@section('sidebar')
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{$boutique['boutiqueName']}}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>

   <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
   
    <li>
      <a href="/hinimo/public/dashboard">
        <i class="fa fa-th"></i> <span>Dashboard</span>
        <span class="pull-right-container">
          <!-- <small class="label pull-right bg-green">new</small> -->
        </span>
      </a>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Products</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/hinimo/public/products/"><i class="fa fa-circle-o"></i> View Products</a></li>
        <li><a href="/hinimo/public/categories"><i class="fa fa-circle-o"></i> Categories</a></li>
        <li><a href="/hinimo/public/weddinggowns"><i class="fa fa-circle-o"></i> Wedding gowns</a></li>
        <li><a href="/hinimo/public/dashboard"><i class="fa fa-circle-o"></i> Entourage Set</a></li>
        <li><a href="/hinimo/public/dashboard"><i class="fa fa-circle-o"></i> Accessories</a></li>
      </ul>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Transactions</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Made-to-Orders</a></li>
        <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Rent</a></li>
      </ul>
    </li>

  </ul>
</section>
<!-- /.sidebar -->

@endsection

@section('scripts')

<script type="text/javascript">
	
	$('#forRent').change(function() {

      if($('#forRent').is(':checked')) {
      	$('#forRentPrice').show();
      } else {
      	$('#forRentPrice').hide();
      }

  	});

  	$('#forSale').change(function() {

      if($('#forSale').is(':checked')) {
      	$('#forSalePrice').show();
      } else {
      	$('#forSalePrice').hide();
      }

  	});


</script>

@endsection