@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('bg/breadcumb.jpg')}});">
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
                        
                        @if($bidding->order['status'] == "For Alterations")
                             <div class="row">
                                <div class="col-md-12">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><h5>Your schedule for alterations will be on:</h5></td>
                                        <td style="text-align: right;"><h5>{{date('M d, Y',strtotime($bidding->order['alterationDateStart'])).' - '.date('M d, Y',strtotime($bidding->order['alterationDateEnd']))}}</h5></td>
                                    </tr>
                                </table>
                                    <p>You are required to visit the boutique at this time interval. If you failed to pay your visit, the boutique will deliver your item to you with the exact measurements you have given without any alterations.</p>
                                </div>
                             </div>
                             @endif

                        <div class="order-details-confirmation"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h5>Your Order</h5>
                            </div>

                            <ul class="order-details-form mb-4">
                                <li><span>Order ID</span> <span>{{$bidding->order['id']}}</span></li>
                                <li><span>Boutique Name</span> <span>{{$bidding->bid->owner['boutiqueName']}}</span></li>
                                <li><span>Address of Delivery</span> <span>{{$bidding->order['deliveryAddress']}}</span></li>
                                


                                <li><span>Subtotal</span> <span>{{$bidding->order['subtotal']}}</span></li>
                                <li><span>Delivery Fee</span> <span>{{$bidding->order['deliveryfee']}}</span></li>
                                <li><span>Total</span> <span>{{$bidding->order['total']}}</span></li>
                                <li><span>Status</span> 
                                    @if($bidding->order['status'] == "For Pickup")
                                    <span style="color: #0315ff;">To be picked up by courier</span>
                                    @else
                                    <span style="color: #0315ff;">{{$bidding->order['status']}}</span>
                                    @endif
                                </li>
                                <li><span>Payment Status</span> <span style="color: red;">{{$bidding->order['paymentStatus']}}</span></li>
                            </ul>
                        </div><br><br> <!-- card closing -->

                        @if($bidding->order['paymentStatus'] == "Not Yet Paid")
                        <h5>Pay here:</h5>
                        <div class="col-md-3" id="paypal-button-container">
                            <input type="text" id="orderTransactionID" value="{{$bidding->order['id']}}" hidden>
                        </div><br><br>
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-md-12">


                        <section class="single_product_details_area d-flex align-items-center">
                            <!-- Single Product Thumb -->
                            <div class="single_product_thumb clearfix">
                                <!-- <div class="product_thumbnail_slides owl-carousel"> -->
                                    @foreach($bidding->productFile as $image)
                                    <img src="{{ asset('/uploads').$image['filename'] }}" alt="">
                                    @endforeach
                                <!-- </div> -->
                            </div>

                            <?php
                                $measurements = json_decode($bidding->measurement->data);
                            ?>

                            <!-- Single Product Description -->
                            <div class="single_product_desc clearfix">
                                <span>By: &nbsp; {{$bidding->owner['fname'].' '.$bidding->owner['lname']}}</span>
                                <!-- <h4>Maximum Price Limit: ₱{{ $bidding['maxPriceLimit'] }}</h4> -->
                                <p class="product-price"></p>
                                <p class="product-price"><b>Maximum Price Limit:</b> &nbsp;  ₱{{ $bidding['maxPriceLimit'] }}</p>
                                <p><b>Bidding End Date:</b> &nbsp; {{ date('M d, Y',strtotime($bidding['endDate'])) }}</p>
                                <p><b>Deadline of Product:</b> &nbsp; {{ date('M d, Y',strtotime($bidding['deadlineOfProduct'])) }}</p>
                                <hr>
                                <p><b>Your notes/instructions:</b></p>
                                <p class="">{{ $bidding['notes'] }}</p>
                                <hr>
                                <p><b>Your Measurements:</b></p>
                                @foreach($measurements as $measurementName => $measurement)
                                <p>{{$measurementName.': '. $measurement}}</p>
                                @endforeach
                                <p><b>Your height:</b> &nbsp; {{ $bidding['height'] }}</p>
                                <hr>
                                <p><b>Your chosen Bid</b></p>
                                <p><b>Boutique Name:</b> &nbsp; {{$bidding->bid->owner['boutiqueName']}}</p>
                                <p><b>Boutique's plan:</b> &nbsp; {{$bidding->bid['plans']}}</p>
                                <p class="product-price"><b>Bid:</b> &nbsp; ₱{{$bidding->bid['bidAmount']}}</p>
                            </div>
                        </section><br><br>
                
            </div>
        </div>
    </div>
</div>

<!-- </div> -->
<style type="text/css">
    p{line-height: 1.5; margin-bottom: 0; font-size: 16px;}
    .product-desc{margin-bottom: 1rem;}
    .price{text-align: right;}
    .payment-info{color: #0000;}
    .back_to_page{background-color: #ff084e; border-radius: 0;  box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.3); color: #ffffff; font-size: 18px;  height: 40px; line-height: 40px; right: 60px; left: 20px; top: 110px; text-align: center;  width: 40px; position: fixed; z-index: 2147483647; display: block;}
    /*a:hover{font-size: 18px; color: #ffffff;}*/
</style>
@endsection


@section('scripts')

<script src="https://www.paypal.com/sdk/js?client-id=AamTreWezrZujgbQmvQoAQzyjY1UemHZa0WvMJApWAVsIje-yCaVzyR9b_K-YxDXhzTXlml17JeEnTKm"></script>
<script>
    
    var orderTransactionID = document.getElementById('orderTransactionID').value;
    // console.log(orderTransactionID);
    paypal.Buttons({
        createOrder: function(data, actions) {
          // Set up the transaction
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '0.01'
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          // Capture the funds from the transaction
          return actions.order.capture().then(function(details) {
            // Show a success message to your buyer
            // alert('Transaction completed by ' + details.payer.name.given_name);
            // alert('Transaction completed by ' + details.payer);
            return fetch('/hinimo/public/paypal-transaction-complete', {

              method: 'post',
              headers: {
                'content-type': 'application/json'
              },
              body: JSON.stringify({
                orderID: data.orderID,
                orderTransactionID: orderTransactionID
              })
            });
          });
        }
    }).render('#paypal-button-container');
</script>

@endsection