@extends('layouts.hinimo')


@section('titletext')
	Hinimo | Shop
@endsection


@section('body')
	

<div class="page">

<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>dresses</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Catagories</h6>

                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">

                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#womens">
                                        <a href="#">Womens</a>
                                        <ul class="sub-menu collapse show" id="womens">
                                		@foreach($categories as $category)
                                		@if($category['gender'] == "Womens")
                                            <li><a href="#">{{ $category['categoryName'] }}</a></li>
                                            @else
                                            @endif
                                        @endforeach
                                        </ul>
                                    </li>

                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#mens">
                                        <a href="#">Mens</a>
                                        <ul class="sub-menu collapse" id="mens">
                                		@foreach($categories as $category)
                                		@if($category['gender'] == "Mens")
                                            <li><a href="#">{{ $category['categoryName'] }}</a></li>
                                            @else
                                            @endif
                                        @endforeach
                                        </ul>
                                    </li>
                                   
                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget price mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Filter by</h6>
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Price</p>

                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div data-min="49" data-max="360" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="49" data-value-max="360" data-label-result="Range:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <div class="range-price">Range: $49.00 - $360.00</div>
                                </div>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget color mb-50">
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Color</p>
                            <div class="widget-desc">
                                <ul class="d-flex">
                                    <li><a href="#" class="color1"></a></li>
                                    <li><a href="#" class="color2"></a></li>
                                    <li><a href="#" class="color3"></a></li>
                                    <li><a href="#" class="color4"></a></li>
                                    <li><a href="#" class="color5"></a></li>
                                    <li><a href="#" class="color6"></a></li>
                                    <li><a href="#" class="color7"></a></li>
                                    <li><a href="#" class="color8"></a></li>
                                    <li><a href="#" class="color9"></a></li>
                                    <li><a href="#" class="color10"></a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <!-- <div class="widget brands mb-50"> -->
                            <!-- Widget Title 2 -->
                            <!-- <p class="widget-title2 mb-30">Brands</p>
                            <div class="widget-desc">
                                <ul>
                                    <li><a href="#">Asos</a></li>
                                    <li><a href="#">Mango</a></li>
                                    <li><a href="#">River Island</a></li>
                                    <li><a href="#">Topshop</a></li>
                                    <li><a href="#">Zara</a></li>
                                </ul>
                            </div> -->
                        <!-- </div> -->


                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9"> <!-- Products show area -->
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span>186</span> products found</p>
                                    </div>
                                    <!-- Sorting -->
                                    <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                                        <form action="#" method="get">
                                            <select name="select" id="sortByselect">
                                                <option value="value">Highest Rated</option>
                                                <option value="value">Newest</option>
                                                <option value="value">Price: $$ - $</option>
                                                <option value="value">Price: $ - $$</option>
                                            </select>
                                            <input type="submit" class="d-none" value="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row"> <!-- Products Display -->
                        	@foreach($products as $product)
	                        <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
	                        <div class="single-product-wrapper">
	                            <!-- Product Image -->
                                <?php 
                                    $counter = 1;
                                ?>
                            
                            @foreach($product->productFile as $image)
                                
	                            <div class="product-img">
	                            @if($counter == 1)    
                                    <img src="{{ asset('/uploads').$image['filename'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
	                            @else
                                @endif
	                                <!-- Favourite -->
	                                <div class="product-favourite">
	                                    <a href="#" class="favme fa fa-heart"></a>
	                                </div>
	                            </div>
                                
                                <?php $counter++; ?>
                                @endforeach

	                            <!-- Product Description -->
	                            <div class="product-description">
	                                <span>{{ $product->owner['username'] }}</span>
	                                <a href="single-product-details/{{$product['productID']}}">
	                                    <h6>{{ $product['productName'] }}</h6>
	                                </a>
	                                <p class="product-price">${{ number_format($product['productPrice']) }}</p>

	                                <!-- Hover Content -->
	                                <div class="hover-content">
	                                    <!-- Add to Cart -->
	                                    <div class="add-to-cart-btn">
	                                    	<input type="text" name="productID" value="{{$product['productID']}}" hidden>
	                                        <a href="#" class="btn essence-btn">Add to Cart</a>
	                                    </div>
	                                </div>
	                            </div>
                            </div>
	                        </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination mt-50 mb-70">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">21</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->


	
		

</div> <!-- page -->

@endsection


@section('search')
<!-- Search Area -->
    <div class="search-area">
        <form action="#" method="post">
            <input type="search" name="search" id="headerSearch" placeholder="Type for search">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
    </div>
@endsection


@section('favorites')
<!-- Favourite Area -->
    <div class="favourite-area">
        <a href="#"><img src="{{ asset('essence/img/core-img/heart.svg') }}" alt=""></a>
    </div>
@endsection

@section('userinfo')

<!-- User Login Info -->
    <div class="user-login-info classynav">
        <ul>
            <li> <a href="#"><img src="{{ asset('essence/img/core-img/user.svg') }}"></a>
            <ul class="dropdown">
                <li><a href="user-account/{{$userid}}">My account</a></li>
                <li><a href="shop.html">My Purchase</a></li>
                <li><a href="shop.html">Logout</a></li>
            </ul>
            </li>
        </ul>
    
    </div>

@endsection


@section('cartbutton')

<!-- Cart Area -->
    <div class="cart-area">
        <a href="#" id="essenceCartBtn"><img src="{{ asset('essence/img/core-img/bag.svg') }}" alt="">
        @if($cartCount > 0)
    		<span>{{$cartCount}}</span>
        @else
        @endif
        </a>
    </div>

@endsection


@section('cart')

<!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div id="cart-area" class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="{{ asset('essence/img/core-img/bag.svg') }}" alt=""> 
            @if($cartCount > 0)
            	<span>{{$cartCount}}</span>
            @else
            @endif
            </a>
        </div>

        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list">
                <!-- Single Cart Item -->
                <?php
                	$subtotal = 0;
                ?>
                @foreach($carts as $cart)
                <div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img src="{{ asset('/uploads').$cart->productFile['filename'] }}" class="cart-thumb" alt="">

                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <span id="delete" class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                            <span class="badge">{{ $cart->owner['username'] }}</span>
                            <h6>{{ $cart->product['productName'] }}</h6>
                            <!-- <p class="size">Size: S</p> -->
                            <!-- <p class="color">Color: Red</p> -->
                            <p class="price">${{ number_format($cart->product['productPrice']) }}</p>
                        </div>
                    </a>
                </div>
                <?php
                	$subtotal += $cart->product['productPrice'];
                ?>
                @endforeach
            </div>

            <!-- Cart Summary -->
            <div class="cart-amount-summary">

                <h2>Summary</h2>
                <ul class="summary-table">
                    <li><span>subtotal:</span> <span>${{ number_format($subtotal, 2) }}</span></li>
                    <!-- <li><span>delivery:</span> <span>Free</span></li> -->
                    <!-- <li><span>discount:</span> <span>-15%</span></li> -->
                    <!-- <li><span>total:</span> <span>$232.00</span></li> -->
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="checkout" class="btn essence-btn">proceed to check out</a>
                </div>
            </div>
        </div>
    </div>
<!-- ##### Right Side Cart End ##### -->


@endsection

@section('scripts')
<script type="text/javascript">

$('.add-to-cart-btn').on('click', function(){
	var productID = $(this).find("input").val();
	var image = $(this).closest('.product-description').siblings('.product-img').find('img').attr('src');

	$.ajax({
		url: "addtoCart/"+productID,
		// type: "POST",
		// data: {id: productID}
	});


	$.ajax({
		url: "getCart/"+productID,
		success:function(data){
			// $("#product").html(data.product)x	
			$(".cart-list").append('<div class="single-cart-item">' +
                    '<a href="#" class="product-image">' +
                        '<img src="'+ image +'" class="cart-thumb" alt="">' +

                     
                        '<div class="cart-item-desc">' +
                          '<span id="delete" class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>' +
                            '<span class="badge">'+ data.owner.fname +'</span>' +
                            '<h6>'+ data.product.productName +'</h6>' +
                            '<p class="price">$'+ data.product.productPrice +'</p>' +
                        '</div>' +
                    '</a>' +
                '</div>'
                );

		}

	}); //second ajax
	
 }); //main ending




</script>
@endsection



