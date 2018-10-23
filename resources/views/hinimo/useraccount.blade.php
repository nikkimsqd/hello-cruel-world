@extends('layouts.hinimo')


@section('titletext')
	My Account
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
            <li> <a href="#"><img src="{{ asset('essence/img/core-img/user1.svg') }}"></a>
            <ul class="dropdown">
                <li><a href="user-account/{{$user['id']}}">My account</a></li>
                <li><a href="shop.html">My Purchase</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

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

<div class="page">
<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>My Account</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ##### Breadcumb Area End ##### -->


<!-- ##### Checkout Area Start ##### -->
<div class="checkout_area section-padding-70">
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="row">
                        <div class="col-md-7 cart-page-heading mb-30">
                            <h3>Account Details</h3>
                        </div>

                        <div class="col-md-3">
                            <a href=""><u>Edit Details</u></a>
                        </div>
                    </div>
                    <br>

                    <form action="" method="">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">Name</label>
                                <input type="text" class="form-control" id="first_name" value="{{$user['fname'].' '.$user['lname']}}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">Username</label>
                                <input type="text" class="form-control" id="first_name" value="{{$user['username']}}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">Email</label>
                                <input type="text" class="form-control" id="first_name" value="{{$user['email']}}" disabled>
                            </div>
                        </div>
                    </form>

                    
                </div>
            </div>

           

        </div> <!-- first row -->

        <br><br>
        <div class="row">
            <div class="col-12 col-md-11">
                <div class="mt-50 clearfix">
           
                    <div class="row">
                        <div class="col-md-7 cart-page-heading mb-30">
                            <h3>Addresses</h3>
                        </div>

                        <div class="col-md-3 justify-content-right">
                            <a href="" data-toggle="modal" data-target="#pendingModal"><u>+ New Address</u></a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-9 mb-3">

                        <table class="table">
                            <tr>
                                <td width="60%">
                                    <b>Name</b><br>
                                    number here<br>
                                    <i>address here</i>
                                </td>
                                <td width="20%" align="right">
                                    <br>
                                    <a href="">Set as Default</a>
                                </td>
                                <td width="20%" align="right">
                                    <a href="" class="btn btn-app">
                                        <i class="fa fa-edit"> 
                                        </i>
                                    </a>
                                    <a href="" class="btn btn-app">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>

                        </table>
                        
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<!-- ##### Checkout Area End ##### -->



<div class="modal fade" id="pendingModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><b>Add Address</b></h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>

        <div class="modal-body">
        <form action="" method="post">
            {{csrf_field()}}
            <label>Name:</label>
            <input type="text" name="contactName" class="form-control"><br>

            <label>Phone Number:</label>
            <input type="text" name="contactNumber" class="form-control"><br>

            <label>Region:</label><br>
            <select name="region" class="form-control" id="region-select">
                <option value=""><u>-----------------</u></option>
                @foreach($regions as $region)
                <option value="{{$region['regCode']}}">{{$region['regDesc']}}</option>
                @endforeach
            </select><br><br><br>

            <label>Province:</label><br>
            <select name="province" class="form-control" id="province-select">
                <option value=""><u>-----------------</u></option>
            </select><br><br><br>

            <label>City</label><br>
            <select name="city" class="form-control" id="city-select">
                <option value=""><u>-----------------</u></option>
            </select><br><br><br>

            <label>Barangay</label><br>
            <select name="barangay" class="form-control" id="brgy-select">
                <option value=""><u>-----------------</u></option>
             
                <option value=""></option>
             
            </select><br><br><br>

            <label>Complete Address</label><br>
            <input type="text" name="completeAdd" class="form-control">

           
        </form>
        </div> <!-- modal-body -->

        <div class="modal-footer">
          <input type="submit" name="btn_submit" value="Submit" class="btn btn-success">
        </div>
        <!-- </form> -->

      
    </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal-fade -->





</div> <!-- page -->



@endsection



@section('scripts')
<script type="text/javascript">


$("#region-select").on('change', function(){

    $('#province-select').empty();
    $('#province-select').next().find('.list').empty();
    $('#province-select').next().find('.current').empty();
    $('#city-select').empty();
    $('#city-select').next().find('.list').empty();
    $('#city-select').next().find('.current').empty();
    $('#brgy-select').empty();
    $('#brgy-select').next().find('.list').empty();
    $('#brgy-select').next().find('.current').empty();

    var regCode = $(this).val();
       
    // $('#province-select').prop('disabled',false);
    // alert($('#province-select').prop('disabled'));
    console.log(regCode);


    $.ajax({
        url: "/hinimo/public/getProvince/"+regCode,
        success:function(data){

            data.provinces.forEach(function(province){

                $('#province-select').append(
                    '<option value="'+province.provCode+'">'+province.provDesc+'</option>'
                    );

                $('#province-select').next().find('.list').append(
                    '<li data-value="'+province.provCode+'" class="option">'+province.provDesc+'</li>'
                );
            });
        }
    });
});



$('#province-select').on('change', function(){

    $('#city-select').empty();
    $('#city-select').next().find('.list').empty();
    $('#city-select').next().find('.current').empty();
    $('#brgy-select').empty();
    $('#brgy-select').next().find('.list').empty();
    $('#brgy-select').next().find('.current').empty();

    var provCode = $(this).val();
     // console.log(provCode);

    $.ajax({
        url: "/hinimo/public/getCity/"+provCode,
        success:function(data){


            data.cities.forEach(function(city){
// console.log(city);
                $('#city-select').append(
                '<option value="'+city.citymunCode+'">'+city.citymunDesc+'</option>'
                );

                $('#city-select').next().find('.list').append(
                    '<li data-value="'+city.citymunCode+'" class="option">'+city.citymunDesc+'</li>'
                );
            });
        }
    }); //ajaxclosing
});


$('#city-select').on('change', function(){

    $('#brgy-select').empty();
    $('#brgy-select').next().find('.list').empty();
    $('#brgy-select').next().find('.current').empty();

    var citymunCode = $(this).val();

    $.ajax({
         url: "/hinimo/public/getBrgy/"+citymunCode,
        success:function(data){

            data.brgys.forEach(function(brgy){

                $('#brgy-select').append(
                '<option value="'+brgy.brgyCode+'">'+brgy.brgyDesc+'</option>'
                );

                $('#brgy-select').next().find('.list').append(
                    '<li data-value="'+brgy.brgyCode+'" class="option">'+brgy.brgyDesc+'</li>'
                );
            });
        }
    });

});



</script>

@endsection