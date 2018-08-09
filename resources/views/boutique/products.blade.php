@extends('layouts.admin')


@section('titletext')
  Boutique de Filipina
@endsection

@section('header')
  Products
@endsection

@section('content')
<div class="page">
<div id="content-wrapper">
<hr>


<section class="shop_grid_area">
<div class="container">


	<br>
	<a href="/hinimo/public/addproduct/">Add Products here</a>
	<br><br>



	<div class="product-topbar d-flex align-items-center justify-content-between">
        <!-- Total Products -->
        <div class="total-products">
            <p><span>186</span> products found</p>
        </div>
    </div>

</div>


<!-- ------------------------NEW OPTION------------------------------ -->



<div class="row">
@foreach($products as $product)


    <div class="col-md-3">

        <div class="box" style="padding: 20px;">
        <div style="padding-right: 20px; padding-left: 20px;">
        <div class="row" style="width: auto; height: 400px;">

        <?php 
            $counter = 1;
        ?>

        @foreach( $product->productFile as $image)

        @if($counter == 1)
            <img src="{{ asset('/uploads').$image['filename'] }}" style="max-width: 100%; max-height: 100%; ">
        @else
            
        @endif

        <?php $counter++; ?>
        @endforeach
        </div>

        <div class="row">

        <a href="single-product-details.html">
            <h6>{{ $product['productName'] }}</h6>
        </a>

        <h2></h2>


        <div class="hover">
            <!-- Add to Cart -->
            <div class="add-to-cart-btn">
                <a href="viewproduct/{{ $product['productID'] }}" class="btn btn-block btn-primary">View Product</a>
            </div>
        </div>

        </div>
    	</div>
        </div>
    </div>


@endforeach
</div>






</section>




</div>


@endsection