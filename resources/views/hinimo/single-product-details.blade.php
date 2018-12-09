@extends('layouts.hinimo')


@section('titletext')
	Hinimo
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
    <div class="nav-brand classynav">
        <ul>
            <li> <a href="#"><span><img src="{{ asset('essence/img/core-img/user.png') }}" style="width: auto;"></span></a>
            <ul class="dropdown">
                <li><a href="user-account/{{$user['id']}}">My account</a></li>
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





@section('body')

<!-- ##### Single Product Details Area Start ##### -->
    <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                @foreach($product->productFile as $image)
                <img src="{{ asset('/uploads').$image['filename'] }}" alt="">
                @endforeach
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span>{{$product->owner->fname}}</span>
            <a href="cart.html">
                <h2>{{ $product['productName'] }}</h2>
            </a>
            <p class="product-price"><span class="old-price">$65.00</span>{{ $product['productPrice'] }}</p>
            <p class="product-desc">{{ $product['productDesc'] }}</p>

            <!-- Form -->
            <form class="cart-form clearfix" method="post">
                <!-- Select Box -->
                <div class="select-box d-flex mt-50 mb-30">
                    <select name="select" id="productSize" class="mr-5">
                        <option value="value">Size: XL</option>
                        <option value="value">Size: X</option>
                        <option value="value">Size: M</option>
                        <option value="value">Size: S</option>
                    </select>
                    <select name="select" id="productColor">
                        <option value="value">Color: Black</option>
                        <option value="value">Color: White</option>
                        <option value="value">Color: Red</option>
                        <option value="value">Color: Purple</option>
                    </select>
                </div>
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                    <button name="addtocart" class="btn essence-btn">Add to cart</button>
                    <!-- Favourite -->
                    <div class="product-favourite ml-4">
                        <a href="#" class="favme fa fa-heart"></a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->


@endsection




@section('scripts')
<script type="text/javascript">

$('.essence-btn').on('click', function(){
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