@extends('layouts.boutique')


@section('titletext')
  Boutique de Filipina
@endsection

@section('page_title')
Add Products
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
        <li><a href="/hinimo/public/tags"><i class="fa fa-circle-o"></i> Tags</a></li>
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



@section('content')
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
        <label>Product Price</label>
        <input type="number" name="productPrice" class="input form-control">
      </div>
	</div>

	<div class="col-md-6">
	    <div class="form-group">
	      <label>Product Category</label>
	      <select class="form-control select2" name="gender" id="gender-select">
			<option selected="selected"> </option>
			<option value="Womens">Womens</option>
			<option value="Mens">Mens</option>
		  </select><br>

		  <select class="form-control select2" name="category">
			<option> </option>
			@foreach($categories as $category)
			<option value="{{ $category['id'] }}">{{ $category['categoryName'] }}</option>
			@endforeach
		  </select>
	    </div>

      <div class="form-group">
       <label>Item Availability:</label><br>
       <input type="checkbox" name="forRent" class="minimal-red" value="true"> For Rent &nbsp;&nbsp;&nbsp;
       <input type="checkbox" name="forSale" class="minimal-red" value="true"> For Sale
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
	</div>
  </div><!-- /.box-body -->

  <div class="box-footer" style="text-align: right;">
  	<a href="products" class="btn btn-warning"><i class="fa fa-arrow-left"> Back to Products</i></a>
	<input type="submit" name="btn_add" value="Add Product" class="btn btn-primary">
  </div>

</form>

</div>


</div> <!-- main column -->
</div> <!-- row -->



<script type="text/javascript">

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