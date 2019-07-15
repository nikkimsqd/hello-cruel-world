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

                        <div class="order-details-confirmation"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h5>Your Order</h5>
                            </div>

                            <ul class="order-details-form mb-4">
                                <li><span>Boutique Name</span> <span>{{$order->boutique['boutiqueName']}}</span></li>
                                <li><span>Order ID</span> <span>{{$order['id']}}</span></li>
                                <li><span></span><span>Product/s</span><span></span>
                                    <!-- <span>
                                        @foreach($order->cart->items as $item)
                                        @if($item->product->owner['id'] == $order['boutiqueID'])
                                            {{$item->product['productName']}}, 
                                        @endif
                                        @endforeach
                                    </span> -->
                                </li>
                                @foreach($order->cart->items as $item)
                                @if($item->product->owner['id'] == $order['boutiqueID'])
                                <li>
                                    <span>{{$item->product['productName']}}</span>
                                    <span>₱{{$item->product['price']}}</span>
                                </li>
                                @endif
                                @endforeach
                                <li><span>Delivery Address</span><span>{{$order['deliveryAddress']}}</span></li>


                                <li style="background-color: aliceblue;"><span>Subtotal</span> <span>₱{{$order['subtotal']}}</span></li>
                                <li style="background-color: aliceblue;"><span>Delivery Fee</span> <span>₱{{$order['deliveryfee']}}</span></li>
                                <li style="background-color: aliceblue;"><span>Total</span> <span style="color: red;">₱{{$order['total']}}</span></li>
                                <li><span>Status</span> 
                                    @if($order['status'] == "For Pickup")
                                    <span style="color: #0315ff;">To be picked up by courier</span>
                                    @else
                                    <span style="color: #0315ff;">{{$order['status']}}</span>
                                    @endif
                                </li>
                                <li><span>Payment Status</span> <span style="color: red;">{{$order['paymentStatus']}}</span></li>
                            </ul>

                            @if($order['status'] == "For Pickup" || $order['status'] == "For Delivery")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <input type="submit" class="btn essence-btn" disabled value="Item Recieved">
                            </div>
                            @elseif($order['status'] == "On Delivery" || $order['status'] == "Delivered")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <a href="{{url('receiveOrder/'.$order['id'])}}" class="btn essence-btn">Item Recieved</a>
                            </div>
                            <!-- elseif($order['status'] == "On Rent") -->
                            @endif
                        </div><br><br> <!-- card closing -->

                        @if($order['paymentStatus'] == "Not Yet Paid")
                        <h5>Pay here:</h5>
                        <div class="col-md-3" id="paypal-button-container">
                            <input type="text" id="orderTransactionID" value="{{$order['id']}}" hidden>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .order-details-confirmation .order-details-form li{padding: 20px 10px;}
</style>

<!-- </div> -->
@endsection


@section('scripts')

<script src="https://www.paypal.com/sdk/js?client-id=AamTreWezrZujgbQmvQoAQzyjY1UemHZa0WvMJApWAVsIje-yCaVzyR9b_K-YxDXhzTXlml17JeEnTKm"></script>
<script>
    
    var orderTransactionID = document.getElementById('orderTransactionID').value;

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
            return fetch('/hinimo/public/paypal-transaction-complete', {

              method: 'post',
              headers: {
                'content-type': 'application/json'
              },
              body: JSON.stringify({
                paypalOrderID: data.orderID,
                orderTransactionID: orderTransactionID
              })
            });
          });
        }
    }).render('#paypal-button-container');
</script>

@endsection