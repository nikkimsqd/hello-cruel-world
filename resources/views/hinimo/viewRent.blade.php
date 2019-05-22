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
                                <li><span>Rent ID</span> <span>{{$rent['rentID']}}</span></li>
                                <li><span>Product/s</span> <span>{{$rent->product['productName']}}</span></li>
                                <li><span>Date to use</span> <span>{{date('M d, Y',strtotime($rent['dateToUse']))}}</span></li>
                                <li><span>Location to be used</span> <span>{{$rent['locationToBeUsed']}}</span></li>
                                <li><span>Your notes</span> <span>{{$rent['additionalNotes']}}</span></li>
                                <li><span>Date to be returned</span> 
                                    @if($rent['dateToBeReturned'] != null)
                                    <span>{{$rent['dateToBeReturned']}}</span>
                                    @else
                                    <span><i>(Date not yet set by seller)</i></span>
                                    @endif
                                </li>
                                <li><span>Status</span> <span>{{$rent['status']}}</span></li>


                                <li><span>Subtotal</span> <span>{{$rent['subtotal']}}</span></li>
                                <li><span>Deliver Fee</span> <span>{{$rent['deliveryFee']}}</span></li>
                                <li><span>Total</span> <span>{{$rent['total']}}</span></li>
                            </ul>
                        </div> <!-- card closing -->

                    </div>
                </div>
            </div>b
        </div>
    </div>
</div>

<!-- </div> -->



@endsection