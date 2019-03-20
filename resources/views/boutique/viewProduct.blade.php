@extends('layouts.boutique')


@section('titletext')
  Boutique de Filipina
@endsection

@section('page_title')
  View Product
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

    <?php 
        $counter = 1;
    ?>

    
<div class="row">
  <div class="col-md-12">
    <div class="box">

      <div class="box-header with-border">
        <h3 class="box-title">{{ $product['productName'] }}</h3>
      </div>

      <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <h4>Product Name</h4>
              <p>{{ $product['productName'] }}</p>
            </div>

            <h4>Product Description</h4>
            <p>{{ $product['productDesc'] }}</p>

            <h4>Product Price</h4>
            <p>{{ $product['productPrice'] }}</p>


            <h4>Product Category</h4>
            <p>{{ $product->gender.', '.$product->category}}<p>

            <h4>Product Status</h4>
            <p>{{ $product['productStatus'] }}</p>

            <h4>Item Availability:</h4>
            @if($product['forRent'] == true && $product['forSale'])
            <p>Item is for RENT & for SALE.</p>
            @elseif($product['forSale'] == true)
            <p>Item is for SALE only.</p>
            @elseif($product['forRent'] == true)
            <p>Item is for RENT only.</p>
            @else
            <p>You have not yet set the availability for this item.</p>
            @endif

            <h4>Is item customizable?</h4>
            <p>{{$product['customizable']}}</p>
          </div>

          <div class="col-md-5">
            <?php $counter = 1; ?>
              @foreach( $product->productFile as $image)
               @if($counter == 1)
                <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: auto; object-fit: cover;margin: 10px;">
              @else
              @endif
              <?php $counter++; ?>
              @endforeach
          </div>
      </div>

      <div class="box-footer" style="text-align: right;">
        <a href="/hinimo/public/products" class="btn btn-warning"><i class="fa fa-arrow-left"> Back to products</i></a>
        <a href="/hinimo/public/editView/{{$product['productID']}}" class="btn btn-success"><i class="fa fa-edit"> Edit</i></a>
        <a href="/hinimo/public/delete/{{$product['productID']}}" class="btn btn-danger"><i class="fa fa-trash"> Delete</i></a>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
  h4{font-weight: bold;}
</style>


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
        <li><a href="/hinimo/public/products"><i class="fa fa-circle-o"></i> View Products</a></li>
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