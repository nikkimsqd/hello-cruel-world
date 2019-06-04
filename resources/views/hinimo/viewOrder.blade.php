@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>{{$page_title}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ##### Breadcumb Area End ##### -->

<div class="single-blog-wrapper">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-11">
                <div class="regular-page-content-wrapper section-padding-80">
                    <div class="regular-page-text">

                        <div class="order-details-confirmation"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h5>Your Order</h5>
                            </div>

                            <ul class="order-details-form mb-4">
                                <li><span>Order ID</span> <span>{{$order['id']}}</span></li>
                                <li><span>Product/s</span>
                                    @if($order['cartID'] != null)
                                    <span>$order->cart['id']</span>
                                    @elseif($order['rentID'] != null)
                                    <span>{{$order->rent->product['productName']}}</span>
                                    @endif
                                </li>


                                <li><span>Subtotal</span> <span>{{$order['subtotal']}}</span></li>
                                <li><span>Delivery Fee</span> <span>{{$order['deliveryfee']}}</span></li>
                                <li><span>Total</span> <span>{{$order['total']}}</span></li>
                            </ul>
                        </div> <!-- card closing -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- </div> -->



@endsection