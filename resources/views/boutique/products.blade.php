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


    <div class="row">
    	@foreach($products as $product) <!--  -------------WALA PAKO NAHUMAN ARIIII---------------- -->
            <!--         {{$product->productFile}} -->
<!-- Single Product -->
        <div class="col-md-12 col-lg-3">
            <div class="single-product-wrapper">
                <!-- Product Image -->
                <div class="product-img">

                <?php 
                $counter = 1;
                ?> 

                @foreach( $product->productFile as $image)   
        
                @if($counter == 1)
                    <img src="{{ asset('/uploads').$image['filename'] }}" alt="">
                @elseif($counter == 2)
                    <!-- Hover Thumb -->
                    <!-- <img class="hover-img" src="{{ asset('/uploads').$product->productFile  }}" alt=""> -->
                    @endif
                    <?php $counter++; ?>
                @endforeach
                
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
                            <a href="viewproduct/{{ $product['productID'] }}" class="btn essence-btn">View Product</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Single Product End -->
		@endforeach

<br><br>
</div>

<!-- <div class="row">
@foreach($products as $product)

<div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Carousel</h3>
            </div>
            <!-- /.box-header -->
            <!-- <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
           
                <div class="carousel-inner">
            @foreach( $product->productFile as $image)
                
                  <div class="item">
                    <img src="{{ asset('/uploads').$image['filename'] }}">

                  </div>



            @endforeach
                </div>

                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
                
              </div>
            </div> -->
            <!-- /.box-body -->
        
          <!-- </div> -->
          <!-- /.box -->
        <!-- </div> -->
        <!-- /.col -->
        <!-- @endforeach -->
        <!-- </div> --> 



</div>

<!-- ------------------------NEW OPTION------------------------------ -->



<div class="row">
@foreach($products as $product)


    <div class="col-md-3">

        <div class="box"> 

        <?php 
            $counter = 1;
        ?>

        @foreach( $product->productFile as $image)

        @if($counter == 1)
            <img src="{{ asset('/uploads').$image['filename'] }}" style="width: 100%; align-self: center; padding: 20px;">
        @else
            
        @endif

        <?php $counter++; ?>
        @endforeach

        <a href="single-product-details.html">
            <h6>{{ $product['productName'] }}</h6>
        </a>

        <h2></h2>

        <div class="hover-content">
            <!-- Add to Cart -->
            <div class="add-to-cart-btn">
                <a href="viewproduct/{{ $product['productID'] }}" class="btn essence-btn">View Product</a>
            </div>
        </div>
        </div>

    </div>


@endforeach
</div>






</section>




</div>


@endsection