@section('titletext')
	Hinimo | Shop
@endsection

@section('auth')
<div class="classynav" style="padding-right: 50px;">
    <ul>
        <li><a href="login">Login</a></li>  
        <li><a href="register">Signup</a></li>
        <li><a href="register-boutique">Sell on Hinimo</a></li>  
    </ul>
    
</div>
@endsection

@section('boutiques')
    <ul class="dropdown">
    	@foreach($boutiques as $boutique)
        <li><a href="{{url('/boutiques').'/'.$boutique['id']}}">{{$boutique['boutiqueName']}}</a></li>
        @endforeach
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
    <div class="user-login-info">
         <a href="{{url('/user-account')}}"><img src="{{ asset('essence/img/core-img/user1.svg') }}"></a>
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


@section('logout')
<!-- Cart Area -->
    <div class="cart-area">
        <a href="{{ route('logout') }}" id="essenceCartBtn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="{{ asset('essence/img/core-img/long-arrow-right.svg') }}" alt="">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
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
                            <span class="badge">{{ $cart->product->owner['boutiqueName'] }}</span>
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
                    <a href="/hinimo/public/cart" class="btn essence-btn">open cart</a>
                </div>
            </div>
        </div>
    </div>
<!-- ##### Right Side Cart End ##### -->


@endsection


@section('footer_menu')
<!-- Footer Menu -->
<div class="footer_menu">
    <ul>
        <li><a href="{{url('/shop')}}">Shop</a></li>
        <li><a href="{{url('/biddings')}}">Biddings</a></li>
        <li><a href="contact.html">Contact</a></li>
    </ul>
</div>
@endsection