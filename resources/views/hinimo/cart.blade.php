@extends('layouts.hinimo')


@section('titletext')
	Hinimo | Cart
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
            <li><a href="#"><img src="{{ asset('essence/img/core-img/user1.svg') }}" style="display: block;"></a>
            <ul class="dropdown">
                <li><a href="user-account/{{$user['id']}}">My account</a></li>
                <li><a href="shop.html">My Purchase</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <li><a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a></li>
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
                    <a href="/hinimo/public/cart" class="btn essence-btn">Open Cart</a>
                </div>
            </div>
        </div>
    </div>
<!-- ##### Right Side Cart End ##### -->
@endsection


@section('body')

<div class="page">

<div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Cart</h2>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="container">
	<br>
	<div class="row">
		<?php
        	$subtotal = 0;
        ?>
		<div class="col-md-12">
		<table class="table">
            @foreach($carts as $cart)
			<tr style="height: 300px;">
				<td width="60%">
					<img src="{{ asset('/uploads').$cart->productFile['filename'] }}" style="width: 200px; height:250px; object-fit: cover; ">
				</td>
				<td width="20%">
                    <h6>{{ $cart->product['productName'] }}</h6>

				</td>
				<td width="10%">
					<a href="removeItem/{{$cart['id']}}"><i>Remove</i></a>
				</td>
				<td width="10%">
					${{ number_format($cart->product['productPrice']) }}
				</td>
			</tr>

			<?php
            	$subtotal += $cart->product['productPrice'];
            ?>
			@endforeach

		</table>
		</div>
	</div>

	<hr>
	<div class="row text-right">
		<div class="col-md-12">
            <div class="cart-amount-summary">
                <!-- <h2>Summary</h2> -->
                <ul class="summary-table">
                    <li><span><b>${{ number_format($subtotal, 2) }}</b></span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="checkout" class="btn essence-btn">proceed to check out</a>
                </div>
            </div>
        </div>
	</div>

	<br><br>


</div>

</div> <!-- page ending -->



@endsection