@extends('layouts.admin')


@section('titletext')
  Boutique de Filipina
@endsection



@section('content')
<div class="page">
<div id="content-wrapper" style="background-color: white;">
<hr>


<section class="shop_grid_area section-padding-80">
<div class="container">
<div class="row">

<div class="col-8 col-md-8 col-lg-9">
<!-- <div class="shop_grid_product_area">
<div class="row">
<div class="col-12">

</div>
</div>


</div> -->
	<br>
	<a href="/hinimo/public/addproduct/">Add Products here</a>
	<br><br>



	<div class="product-topbar d-flex align-items-center justify-content-between">
        <!-- Total Products -->
        <div class="total-products">
            <p><span>186</span> products found</p>
        </div>
    </div>


    <div class="row">
    	@foreach($products as $product) <!--  -------------WALA PAKO NAHUMAN ARIIII---------------- -->
            <!--         {{$product->productFile}} -->
<!-- Single Product -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="single-product-wrapper">
                <!-- Product Image -->
                <div class="product-img">

                <?php 
                $counter = 1;
                ?> 

                @foreach( $product->productFile as $image)   
        
                @if($counter == 1)
                    <img src="{{ asset('/uploads').$image['filename'] }}" alt="">
                    <img class="hover-img" src="{{ asset('/uploads').$product->productFile  }}" alt="">
                @elseif($counter == 2)
                    <!-- Hover Thumb -->
                    <img class="hover-img" src="{{ asset('/uploads').$product->productFile  }}" alt="">
                    @endif
                    <?php $counter++; ?>
                @endforeach
                
                
                    <!-- Favourite -->
                    <div class="product-favourite">
                        <a href="#" class="favme fa fa-heart"></a>
                    </div>
                </div>

                <!-- Product Description -->
                <div class="product-description">
                    <span>{{ $product->owner['username'] }}</span>
                    <a href="single-product-details.html">
                        <h6>{{ $product['productName'] }}</h6>
                    </a>
                    <p class="product-price">{{ $product['productPrice'] }}</p>

                    <!-- Hover Content -->
                    <div class="hover-content">
                        <!-- Add to Cart -->
                        <div class="add-to-cart-btn">
                            <a href="#" class="btn essence-btn">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Single Product End -->
		@endforeach

<br><br>
</div>



</div>
</div>
</div>
</section>




</div>


@endsection