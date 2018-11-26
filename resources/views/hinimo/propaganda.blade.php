@extends('layouts.hinimo')


@section('titletext')
	My Account
@endsection


@section('boutiques')
    <ul class="dropdown">
        <li><a href="index.html">Boutique 1</a></li>
        <li><a href="shop.html">Boutique 2</a></li>
        Q<li><a href="single-product-details.html">Boutique 3</a></li>
        <li><a href="checkout.html">Boutique 4</a></li>
        <li><a href="blog.html">Boutique 5</a></li>
        <li><a href="single-blog.html">Boutique 6</a></li>
    </ul>
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
    <div class="user-login-info" id="user-info">

        <a href="#"><img src="{{ asset('essence/img/core-img/user1.svg') }}"></a>

        <div class="user-dropdown" style="width: 170%;">
            <div id="dropdown" hidden>
                <a href="/hinimo/public/user-account/{{$userID}}">My account</a><hr>
                <a href="shop.html">My Purchase</a><hr>
                <a href="/hinimo/public/upgrade-user-account">Upgrade</a><hr>
               
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </div>
        </div>
    
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

<div class="page">
<!-- ##### Breadcumb Area Start ##### -->
    <!-- <div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Be a seller!</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<!-- ##### Breadcumb Area End ##### -->


<!-- ##### Blog Wrapper Area Start ##### -->
    <div class="single-blog-wrapper">

        <!-- Single Blog Post Thumb -->
        <div class="single-blog-post-thumb">
            <img src="img/bg-img/bg-8.jpg" alt="">
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="regular-page-content-wrapper section-padding-80">
                        <div class="regular-page-text">
                            <h2>Register your boutique in Hinimo!</h2>
                            <p>Register your boutique in Hinimo and sell your rent your items through our website </p>


                        <a href="/hinimo/public/register-boutique" class="btn essence-btn">CONTINUE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> <!-- page -->





@endsection



@section('scripts')
<script type="text/javascript">
    var session = 0;

$('#user-info').on('click', function(){

    if (session == 0) 
    {
        $('#dropdown').removeAttr('hidden');
        session = session + 1;
        // if ( ) 
            // $('.page').on('click', function(){ });
        // {
        //     $('#dropdown').prop('hidden', true);
        //     session = session - 1;
        // }
    }else
    {
        $('#dropdown').prop('hidden', true);
        session = session - 1;
    }
    // console.log(session);



});

</script>

@endsection