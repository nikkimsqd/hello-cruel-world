@extends('layouts.admin')


@section('titletext')
  Boutique de Filipina
@endsection



@section('content')
<div class="page">
<div id="content-wrapper" style="background-color: white;">
<hr>


<div class="container">
<div class="row">

<div class="col-md-10">

	<br>
	<a href="/hinimo/public/addproduct/">Add Products here</a>
	<br><br>



<!-- ##### Single Product Details Area Start ##### -->
    <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                <img src="img/product-img/product-big-1.jpg" alt="">
                <img src="img/product-img/product-big-2.jpg" alt="">
                <img src="img/product-img/product-big-3.jpg" alt="">
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span>mango</span>
            <a href="cart.html">
                <h2>{{ $product['productName'] }}</h2>
            </a>
            <p class="product-price">{{ $product['productPrice'] }}</p>
            <p class="product-desc">{{ $product['productDesc'] }}</p>

            <!-- Form -->
            <form class="cart-form clearfix" method="post">
            
                    <a href="" class="btn essence-btn">Modify Product Details</a><br>
                    <a href="" class="btn essence-btn">Delete Products</a>
                   
              
            </form>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->







</div>
</div>
</div>



</div>
</div>


@endsection