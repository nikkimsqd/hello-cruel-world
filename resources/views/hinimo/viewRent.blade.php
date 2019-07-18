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
                <div id="rent-details" class="regular-page-content-wrapper section-padding-80">
                    <div class="regular-page-text">

                        @if($rent->order['status'] == "For Alterations")
                        <div class="row">
                            <div class="col-md-12">
                            <table class="table table-borderless">
                                <tr>
                                    <td><h5>Your schedule for alterations will be on:</h5></td>
                                    <td style="text-align: right;"><h5>{{date('M d, Y',strtotime($rent->order['alterationDateStart'])).' - '.date('M d, Y',strtotime($rent->order['alterationDateEnd']))}}</h5></td>
                                </tr>
                            </table>
                                <p>You are required to visit the boutique at this time interval. If you failed to pay your visit, the boutique will deliver your item to you with the exact measurements you have given without any alterations.</p>
                            </div>
                        </div>
                        @endif

                        @if($rent->order['status'] == "On Rent")
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="color: red; text-align: center;">You are required to visit the boutique personally on returning the item and claiming your deposit.</h5><br>
                            </div>
                        </div>

                        @endif
                             
                        @if($rent->order['status'] == "For Pickup" || $rent->order['status'] == "For Delivery" || $rent->order['status'] == "On Delivery" || $rent->order['status'] == "Delivered" || $rent->order['status'] == "Completed"|| $rent->order['status'] == "On Rent")
                        <div class="order-details-confirmation"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h5>Your Order Details</h5>
                            </div>

                            <ul class="order-details-form mb-4">
                                <li><span>Boutique Name</span> <span>{{$rent->order->boutique['boutiqueName']}}</span></li>
                                <li><span>Order ID</span> <span>{{$rent->order['id']}}</span></li>
                                <li><span>Product/s</span>
                                    @if($rent->order['cartID'] != null)
                                    <span>$rent->order->cart['id']</span>
                                    @elseif($rent->order['rentID'] != null)
                                    <span>{{$rent->product['productName']}}</span>
                                    @endif
                                </li>
                                <li><span>Date to be returned</span><span>{{date('M d, Y',strtotime($rent['dateToBeReturned']))}}</span></li>
                                <li><span>Delivery Address</span> <span>{{$rent->order['deliveryAddress']}}</span></li>
                                <li><span>Status</span> 
                                    @if($rent->order['status'] == "On Rent")
                                    <span style="color: red; font-weight: bold">{{$rent->order['status']}}</span></li>
                                    @elseif($rent->order['status'] == "For Pickup")
                                    <span style="color: #0315ff; font-weight: bold">To be picked up by courier</span></li>
                                    @else
                                    <span style="color: #0315ff; font-weight: bold">{{$rent->order['status']}}</span></li>
                                    @endif

                                <li><span></span><span>Payment Info</span><span></span></li>
                                <li><span>Subtotal</span> <span>₱{{$rent->order['subtotal']}}</span></li>
                                <li><span>Deposit Amount</span> <span>₱{{$rent->product->rentDetails['depositAmount']}}</span></li>
                                <li><span>Delivery Fee</span> <span>₱{{$rent->order['deliveryfee']}}</span></li>
                                <li><span>Total</span> <span style="color: red; font-weight: bold;">₱{{$rent->order['total']}}</span></li>
                                <li><span>Payment Status</span>
                                    <span style="color: red;">{{$rent->order['paymentStatus']}}</span>
                                </li>
                            </ul>
                            @if($rent->order['status'] == "For Pickup" || $rent->order['status'] == "For Delivery")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <input type="submit" class="btn essence-btn" disabled value="Item Recieved">
                            </div>
                            @elseif($rent->order['status'] == "On Delivery" || $rent->order['status'] == "Delivered")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <a href="{{url('receiveRent/'.$rent['rentID'])}}" class="btn essence-btn">Item Recieved</a>
                            </div>
                            @elseif($rent->order['status'] == "On Rent")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <input type="submit" class="btn essence-btn" hidden value="Item Recieved">
                            </div>
                            @endif
                        </div> <!-- card closing --><br><br>
                        @endif

                        <div class="order-details-confirmation"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h5>Your Rent Details</h5>
                            </div>

                            <ul class="order-details-form mb-4">
                                <li><span>Boutique Name</span> <span>{{$rent->order->boutique['boutiqueName']}}</span></li>
                                <li><span>Rent ID</span> <span>{{$rent['rentID']}}</span></li>
                                <li><span>Product/s</span> <span>{{$rent->product['productName']}}</span></li>
                                <li><span>Date to use</span> <span>{{date('M d, Y',strtotime($rent['dateToUse']))}}</span></li>
                                <li><span>Your notes / instructions</span> <span>{{$rent['additionalNotes']}}</span></li>
                                <li><span>Date to be returned</span> <span>{{date('M d, Y',strtotime($rent['dateToBeReturned']))}}</span></li>
                                <li><span>Required Deposit Amount</span> <span>₱{{$rent->product->rentDetails['depositAmount']}}</span></li>
                                <li><span>Penalty Amount</span> <span>₱{{$rent->product->rentDetails['penaltyAmount']}}</span></li>
                                @if($rent->order['status'] == "Pending" && $rent->order['status'] == "In-Progress")
                                <li><span>Status</span> <span style="color: #0315ff;">{{$rent->order['status']}}</span></li>
                                    <li><span></span><span>Payment Info</span><span></span></li>
                                    <li><span>Subtotal</span> <span>₱{{$rent->order['subtotal']}}</span></li>
                                    <li><span>Deposit Amount</span> <span>₱{{$rent->product->rentDetails['depositAmount']}}</span></li>
                                    <li><span>Delivery Fee</span> <span>₱{{$rent->order['deliveryfee']}}</span></li>
                                        <li><span>Total</span> <span style="color: red; font-weight: bold;">₱{{$rent->order['total']}}</span></li>
                                        <li><span>Payment Status</span> 
                                            @if($rent->order['paymentStatus'] == "Not Yet Paid")
                                            <span style="color: red; text-align: right;">{{$rent->order['paymentStatus']}}<br><i>(You are first required to pay so the boutique can start processing your item.)</i></span>
                                            @else
                                            <span style="color: #0315ff;">{{$rent->order['paymentStatus']}}</span>
                                            @endif
                                        </li>
                                @endif
                            </ul>
                        </div> <!-- card closing --> <br>

                        

                        @if($rent->order['paymentStatus'] == "Not Yet Paid")
                        <h5>Pay here:</h5>
                        <div class="col-md-3" id="paypal-button-container">
                            <input type="text" id="rentID" value="{{$rent['rentID']}}" hidden>
                            <input type="text" id="rentOrderID" value="{{$rent->order['id']}}" hidden>
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
    
    var rentOrderID = document.getElementById('rentOrderID').value;
    var rentID = document.getElementById('rentID').value;
    // console.log(rentID);
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
                paypalOrderID: data.orderID,
                rentOrderID: rentOrderID,
                rentID: rentID
              })
            });
          });
        },
        onError: function (err) {
            alert("An error has occured during the transaction. Please try again.");
        }
    }).render('#paypal-button-container');
</script>

@endsection