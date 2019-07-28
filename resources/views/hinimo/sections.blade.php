@section('titletext')
	Hinimo | {{$page_title}}
@endsection

@section('auth')
<div class="classynav" style="padding-right: 50px;">
    <ul>
        <li><a href="{{url('login')}}">Login</a></li>  
        <li><a href="{{url('register')}}">Signup</a></li>
        <li><a href="{{url('register-boutique')}}">Sell on Hinimo</a></li>  
    </ul>
    
</div>
@endsection

@section('boutiques')
    <ul class="dropdown">
    	@foreach($boutiques as $boutique)
        <li><a href="{{url('/boutique').'/'.$boutique['id']}}">{{$boutique['boutiqueName']}}</a></li>
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

@section('transactions')
<!-- User Login Info -->
   <!--  <div class="user-login-info">
         <a href="{{url('/user-transactions')}}"><img src="{{ asset('essence/img/core-img/view.svg') }}"><span></span></a>
    </div> -->
@endsection

@section('userinfo')
<!-- User Login Info -->
    <div class="user-login-info">
         <a href="{{url('/user-account')}}"><img src="{{ asset('essence/img/core-img/user.svg') }}">
            @if($notificationsCount > 0)
                <span>{{$notificationsCount}}</span>
            @endif
        </a>
    </div>
@endsection


@section('cartbutton')
<!-- Cart Area -->
    <div class="cart-area">
        <a href="#" id="essenceCartBtn"><img src="{{ asset('essence/img/core-img/bag.svg') }}" alt="">
        @if($cartCount > 0)
    		<span>{{$cartCount}}</span>
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
<!-- if($userID != null) -->
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

            <?php $subtotal = 0; ?>
            @if($cart != null)
            <!-- Cart List Area -->
            <div class="cart-list">
                @foreach($cart->items as $item)
                <div class="single-cart-item">
                    <a href="#" class="product-image">
                        @if($item->product != null)
                            @foreach($item->product->productFile as $file)
                            <img src="{{ asset('/uploads').$file['filename'] }}" class="cart-thumb" alt="">
                            <?php break; ?>
                            @endforeach

                            <!-- Cart Item Desc -->
                            <div class="cart-item-desc">
                              <span cart-item-id="{{$item['id']}}" class="delete product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                                <span class="badge">{{$item->product->owner['boutiqueName']}}</span>
                                <h6>{{$item->product['productName']}}</h6>
                                <!-- <p class="size">Size: S</p> -->
                                <!-- <p class="color">Color: Red</p> -->
                                <p class="price">₱{{number_format($item->product['price'])}}</p>
                                <?php $price = $item->product['price']; ?>
                            </div>
                        @else
                            @foreach($item->set->items as $setItem)
                            @foreach($setItem->product->productFile as $image)
                            <img src="{{ asset('/uploads').$image['filename'] }}" alt="">
                            <?php break; ?>
                            @endforeach
                            @endforeach

                            <!-- Cart Item Desc -->
                            <div class="cart-item-desc">
                              <span cart-item-id="{{$item['id']}}" class="delete product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                                <span class="badge">{{$item->set->owner['boutiqueName']}}</span>
                                <h6>{{$item->set['setName']}}</h6>
                                <!-- <p class="size">Size: S</p> -->
                                <!-- <p class="color">Color: Red</p> -->
                                <p class="price">₱{{number_format($item->set['price'])}}</p>
                                <?php $price = $item->set['price']; ?>
                            </div>
                        @endif
                    </a>
                </div>
                <?php
                    $subtotal += $price;
                ?>
                @endforeach
            </div>
            <!-- Cart Summary -->
            <div class="cart-amount-summary">

                <h2>Summary</h2>
                <ul class="summary-table">
                    <li><span>subtotal:</span> <span>₱{{ number_format($subtotal, 2) }}</span></li>
                    <!-- <li><span>delivery:</span> <span>Free</span></li> -->
                    <!-- <li><span>discount:</span> <span>-15%</span></li> -->
                    <!-- <li><span>total:</span> <span>$232.00</span></li> -->
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="{{url('checkout')}}" class="btn essence-btn">proceed to checkout</a>
                </div>
            </div>
            @else
            <div class="cart-amount-summary">

                <h2>You have nothing on your cart</h2>
                
            </div>
            @endif
        </div>
    </div>
<!-- ##### Right Side Cart End ##### -->
<!-- endif -->

<style type="text/css">
    .price{bottom: 20px; position: absolute;}
</style>


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


@section('script2')

<script type="text/javascript">

$(function(){
    $('body').on('click', '.delete', function(){
  var itemID = $(this).attr('cart-item-id');
  var itemDiv = $(this).closest('.single-cart-item');


  $.ajax({
      url: "/hinimo/public/removeItem/"+itemID,
      success:function(data){
        if(data.item){
            // itemDiv.remove();
            location.reload();
        }
      }
  });

});
});


</script>

@endsection
