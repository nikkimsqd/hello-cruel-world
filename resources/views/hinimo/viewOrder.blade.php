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
                        
                        <?php
                        $total = $order['total'];
                        $minimumPaymentRequired = $total * 0.50;
                        // $measurementID = $mto['measurementID'];
                        $balance = $order['total'];

                        if(count($payments) > 0){
                            foreach($order->payments as $payment){
                                $minimumPaymentRequired = $payment['balance'];
                                $balance = $payment['balance'];
                            }
                        }
                        ?>

                        <div class="order-details-confirmation"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h5>Your Order</h5>
                            </div>

                            <ul class="order-details-form mb-4">
                                <li><span>Boutique Name</span> <span>{{$order->boutique['boutiqueName']}}</span></li>
                                <li><span>Order ID</span> <span>{{$order['id']}}</span></li>
                                <li><span></span><span>Product/s</span><span></span>
                                 
                                </li>
                                @foreach($order->cart->items as $item)
                                @if($item->product != null)
                                    @if($item->product->owner['id'] == $order['boutiqueID'])
                                    <li>
                                        <span>{{$item->product['productName']}}</span>
                                        <span>₱{{$item->product['price']}}</span>
                                    </li>
                                    @endif
                                @else
                                    @if($item->set->owner['id'] == $order['boutiqueID'])
                                    <li>
                                        <span>{{$item->set['setName']}}</span>
                                        <span>₱{{$item->set['price']}}</span>
                                    </li>
                                    @endif
                                @endif
                                @endforeach
                                <li><span>Delivery Address</span><span>{{$order->address['completeAddress']}}</span></li>


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
                                @if(count($payments) == 0)
                                <li style="background-color: #ffe9e9;"><span>Required Minimum Downpayment</span> <span>50% = ₱{{$minimumPaymentRequired}}</span></li>
                                @endif
                            </ul>

                            @if($order['status'] == "For Pickup" || $order['status'] == "For Delivery")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <input type="submit" class="btn essence-btn" disabled value="Item Received">
                            </div>
                            @elseif($order['status'] == "On Delivery" || $order['status'] == "Delivered")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <a href="{{url('receiveOrder/'.$order['id'])}}" class="btn essence-btn">Item Received</a>
                            </div>
                            <!-- elseif($order['status'] == "On Rent") -->
                            @endif
                        </div><br><br> <!-- card closing -->

                        @if(count($payments) > 0)
                        <?php $counter = 1; ?>
                        <div class="order-details-confirmation"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h5>Payment History</h5>
                            </div>
                            <ul class="order-details-form mb-4">
                                @foreach($order->payments as $payment)
                                <li class="payment-heading"><span></span><span><h6>Payment Transaction {{$counter}}</h6></span><span></span></li>

                                <li><span>Transaction ID</span> <span>{{$payment['id']}}</span></li>

                                <li><span>Amount Paid</span> <span>₱{{$payment['amount']}}
                                <li><span>Balance</span> 
                                    <span>
                                    @if($payment['balance'] == 0)
                                    -
                                    @else
                                    ₱{{$payment['balance']}}
                                    @endif
                                    </span>
                                </li>

                                <li><span>Paypal Payment ID</span> <span>{{$payment['paypalOrderID']}}</span></li>

                                <?php $counter++; ?>
                                @endforeach
                            </ul>
                        </div><br><br> <!-- card closing -->
                        @endif

                        @if($order['paymentStatus'] != "Fully Paid")
                        <span>You are required to pay first so boutique can start on working with your item</span>
                        <h5>Pay here:</h5>
                        <div class="col-md-3" id="paypal-button-container">
                            <input type="text" id="amount" class="form-control mb-10">
                            <input type="text" id="orderTransactionID" value="{{$order['id']}}" hidden>
                            <input type="text" id="total" value="{{$total}}" hidden>
                            <input type="text" id="minimumPaymentRequired" value="{{$minimumPaymentRequired}}" hidden>
                            <input type="text" id="balance" value="{{$balance}}" hidden>
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
    .mb-10{margin-bottom: 10px;}
    .payment-heading{background-color: aliceblue;}
</style>

<!-- </div> -->
@endsection


@section('scripts')

<script src="https://www.paypal.com/sdk/js?currency=PHP&client-id=AamTreWezrZujgbQmvQoAQzyjY1UemHZa0WvMJApWAVsIje-yCaVzyR9b_K-YxDXhzTXlml17JeEnTKm"></script>
<script>
    
    var orderTransactionID = $('#orderTransactionID').val();
    var total = $('#total').val();
    var balance = $('#balance').val();

    if(orderTransactionID != null){ //gi butang ko ni para dili mo gawas ang error alert sa paypal
    paypal.Buttons({
        createOrder: function(data, actions) {
            var total = parseInt($('#total').val());
            var minimumPaymentRequired = parseInt($('#minimumPaymentRequired').val());
            var amount = parseInt($('#amount').val());
        
            if(amount){
                if(amount >= minimumPaymentRequired){
                    if(amount <= total){
                        return actions.order.create({
                            purchase_units: [{
                            amount: {
                            value: amount,
                            currencyCode: 'PHP'
                            }
                            }]
                        });
                    }
                }
            }
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
                orderTransactionID: orderTransactionID,
                total: total,
                details: details,
                balance: balance
              })
            }).then(function (){
                location.reload();
            });
          });
        },
        onError: function (err) {
            alert("An error has occured during the transaction. Please try again.");
        }
    }).render('#paypal-button-container');
    } //if closing
</script>

@endsection