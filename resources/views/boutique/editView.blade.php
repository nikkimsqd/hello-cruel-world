@extends('layouts.boutique')


@section('titletext')
  Boutique de Filipina
@endsection

@section('page_title')
Edit Products
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
			<input type="text" name="productName" class="input form-control" value="{{ $product['productName'] }}">
	    </div>

	    <div class="form-group">
	      <label>Product Description</label>
	      <textarea name="productDesc" rows="3" cols="50" class="input form-control">{{ $product['productDesc'] }}</textarea>
	    </div>

	    <div class="form-group">
	      <label>Product Price</label>
		  <input type="number" name="productPrice" class="input form-control" value="{{ $product['productPrice'] }}">
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
			<option selected value="{{$womensCategory['id']}}">{{$womensCategory['categoryName']}}</option>
		  	@endforeach
		  	@elseif($product['gender'] == "Mens")
		  	@foreach($mensCategories as $mensCategory)
			<option selected value="{{$mensCategory['id']}}">{{$mensCategory['categoryName']}}</option>
		  	@endforeach
		  	@endif


			<!-- @foreach($categories as $category)
			@if($product['category'] == $category['id'])
				<option selected value="{{$category['id']}}">{{$category['categoryName']}}</option>
			@else
				<option value="{{$category['id']}}">{{$category['categoryName']}}</option>
			@endif
			@endforeach -->
		  </select>
	    </div>

	    <div class="form-group">
	      	<label>Product Status</label><br>
	      	@if($product->productStatus == "Available")
	      	<label><input type="radio" name="productStatus" value="Available" checked> Available</label>
			<label><input type="radio" name="productStatus" value="Not Available"> Not Available</label>
	      	@else
	      	<label><input type="radio" name="productStatus" value="Available"> Available</label>
			<label><input type="radio" name="productStatus" value="Not Available" checked> Not Available</label>
			@endif
	    </div>

	    <div class="form-group">
	      	<label>Product Availability</label><br>
	      	@if($product->forRent != null && $product->forSale != null)
			<input type="checkbox" name="forRent" value="true" checked> For Rent
			<input type="checkbox" name="forSale" value="true" checked> For Sale
	      	@elseif($product->forRent != null)
	    	<input type="checkbox" name="forRent" value="true" checked> For Rent
			<input type="checkbox" name="forSale" value="true"> For Sale
			@elseif($product->forSale != null)
			<input type="checkbox" name="forRent" value="true"> For Rent
			<input type="checkbox" name="forSale" value="true" checked> For Sale
			@else
			<input type="checkbox" name="forRent" value="true"> For Rent
			<input type="checkbox" name="forSale" value="true"> For Sale
			@endif
	    </div>

	    <div class="form-group">
			<label>Is item customizable?</label><br>
			@if($product['customizable'] == "Yes")
			<input type="radio" name="customizable" class="minimal-red" value="Yes" checked> Yes
			<input type="radio" name="customizable" class="minimal-red" value="No"> No
			@else
			<input type="radio" name="customizable" class="minimal-red" value="Yes"> Yes
			<input type="radio" name="customizable" class="minimal-red" value="No" checked> No
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
  	<a href="/hinimo/public/products" class="btn btn-warning"><i class="fa fa-arrow-left"> Back to Products</i></a>
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