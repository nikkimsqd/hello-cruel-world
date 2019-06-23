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
            <div class="col-md-11">
                <div id="mto-details" class="regular-page-content-wrapper section-padding-80">
                    <div class="regular-page-text">

                       <!--  <div class="notif-area cart-area" style="text-align: right;">
                            <a href="" class="btn essence-btn" data-toggle="modal" data-target="#notificationsModal">Chat with seller here</a>
                            <br><br><br>
                        </div> -->
                        <div class="row">
                            <div class="col-md-12">
                             <!--    if($mto->order['status'] == "For Pickup" || $mto->order['status'] == "For Delivery" || $mto->order['status'] == "On Delivery" || $mto->order['status'] == "Delivered" || $mto->order['status'] == "Completed") -->
                             @if($mto['orderID'] != null)
                                <div class="order-details-confirmation"> <!-- card opening -->
                                    <div class="cart-page-heading">
                                        <h5>Your Order Details</h5>
                                    </div>

                                    <ul class="order-details-form mb-4">
                                        <li><span>Order ID</span> <span>{{$mto->order['id']}}</span></li>
                                        <li><span>Address of Delivery</span> <span>{{$mto->order['deliveryAddress']}}</span></li>
                                        <li><span>Status</span> 
                                            @if($mto->order['status'] == "For Pickup")
                                            <span style="color: #0315ff;">To be picked up by courier</span>
                                            @else
                                            <span style="color: #0315ff;">{{$mto->order['status']}}</span>
                                            @endif
                                        </li>

                                        <li><span></span><span>Payment Info</span><span></span></li>
                                        <li><span>MTO Item</span> <span>₱{{$mto['price']}}</span></li>
                                        <!-- <li><span>Subtotal</span> <span>{{$mto->order['subtotal']}}</span></li> -->
                                        <li><span>Delivery Fee</span> <span>₱{{$mto->order['deliveryfee']}}</span></li>
                                        <li><span>Total</span> <span style="color: #0315ff;">₱{{$mto->order['total']}}</span></li>
                                        <li><span>Payment Status</span>
                                            <span style="color: red; text-align: right;">{{$mto->order['paymentStatus']}}</span>
                                        </li>
                                    </ul>
                                    @if($mto->order['status'] == "For Pickup" || $mto->order['status'] == "For Delivery")
                                    <div class="notif-area cart-area" style="text-align: right;">
                                        <input type="submit" class="btn essence-btn" disabled value="Item Recieved">
                                    </div>
                                    @elseif($mto->order['status'] == "On Delivery" || $mto->order['status'] == "Delivered")
                                    <div class="notif-area cart-area" style="text-align: right;">
                                        <a href="{{url('receiveOrder/'.$mto->order['id'])}}" class="btn essence-btn">Item Recieved</a>
                                    </div>
                                    <!-- elseif($mto['status'] == "On Rent") -->
                                    @endif
                                </div> <!-- card closing --><br><br>

                                @if($mto->order['paymentStatus'] == "Not Yet Paid")
                                <h5>Pay here:</h5>
                                <div class="col-md-3" id="paypal-button-container">
                                    <input type="text" id="mtoOrderID" value="{{$mto->order['id']}}" hidden>
                                    <input type="text" id="mtoID" value="{{$mto['id']}}" hidden>
                                </div><br><br>
                                @endif
                            @endif


                                <div class="order-details-confirmation">
                                    <div class="cart-page-heading">
                                        <h5>Your Made-to-Order</h5>
                                    </div>
                                    <?php
                                        $measurements = json_decode($mto->measurement->data);
                                        $fabricChoice = json_decode($mto['fabricChoice']);
                                        $fabricSuggestion = json_decode($mto['fabricSuggestion']);
                                    ?>

                                    <ul class="order-details-form mb-4">
                                        @if($mto['status'] == "Cancelled")
                                            <li><span></span><span style="color: red;">MTO has been cancelled</span><span></span></li>
                                        @elseif($mto['status'] != "Cancelled" && $mto['status'] != "Active")
                                            <li style="color: red;"><span>MTO has been declined</span><span>Reason: {{$mto->declineDetails['reason']}}</span></li>
                                        @endif
                                        <li><span>MTO ID</span> <span>{{$mto['id']}}</span></li>
                                        <li><span>Date of use of the product</span> <span>{{$mto['dateOfUse']}}</span></li>
                                        <li><span>Category of item</span> <span>{{$mto->category['categoryName']}}</span></li>
                                        <li><span>Height</span> <span>{{$mto['height']}} cm</span></li>
                                        <li><span>Measurements</span> 
                                            <span style="text-align: right;">
                                                @foreach($measurements as $measurementName => $measurement)
                                                {{$measurementName.': '. $measurement}} <br>
                                                @endforeach
                                            </span></li>

                                        <li><span>Instructions/Notes</span> <span>{{$mto['notes']}}</span></li>
                                        @if($mto['price'] != null && $mto['orderID'] == null)
                                            <li><span>Price</span> <span style="color: #0315ff;">Final Price will be shown here</span></li>
                                        @elseif($mto['price'] != null && $mto['orderID'] != null)
                                            <li><span>Price</span> <span style="color: #0315ff;">₱{{$mto['price']}}</span></li>
                                        @else
                                            <li><span>Price</span> <span style="color: #0315ff;">Boutique has not set a price yet</span></li>
                                        @endif
                                    </ul>
                                </div><br><br>
                                

                        @if($mto['orderID'] == null && $mto['status'] == "Active") <!-- IF WALA PAY ORDER ANG MTO -->
                            <!-- if naay chosen fabric & naghatag ug price si boutique -->
                            @if($mto['fabricID'] != null && $mto['price'] != null)
                                <h5 class="normal">Boutique's price for item with the fabric of your choice:</h5>
                                <div class="row">
                                    <div class="col-md-5">
                                        @foreach($fabrics as $fabric)
                                        @if($fabric['id'] == $mto['fabricID']) 
                                            <h5 class="normal">Fabric Type: <b>{{ucfirst($fabric['name'])}}</b></h5>
                                            <h5 class="normal">Fabric Color: <b>{{ucfirst($fabric['color'])}}</b></h5>
                                            <h5 class="normal">Price: <b>₱{{ucfirst($mto['price'])}}</b></h5>
                                        @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-3">
                                        <br>
                                        <a href="{{url('inputAddress/'.$mto['id'].'/acceptFPrice')}}" class="btn essence-btn">Accept Offer</a>
                                    </div>
                                </div><br>
                            <!-- if ni hatag si customer ug fabric nga wala ni boutique and ni hatag nasad ug price si boutique -->
                            @elseif($mto['fabricChoice'] != null && $mto['price'] != null) <!-- mtoID: 1 -->
                                <h5 class="normal">Boutique's price for item with the fabric of your choice:</h5>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h5 class="normal">Fabric Type: <b>{{ucfirst($fabricChoice->fabricType)}}</b></h5>
                                        <h5 class="normal">Fabric Color: <b>{{ucfirst($fabricChoice->fabricColor)}}</b></h5>
                                        <h5 class="normal">Price: <b>₱{{ucfirst($mto['price'])}}</b></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <br>
                                        <a href="{{url('inputAddress/'.$mto['id'].'/acceptFCPrice')}}" class="btn essence-btn">Accept Offer</a>
                                    </div>
                                </div><br>
                            @endif

                            <!-- if nangayo ug suggestion si user & naay gi suggest si boutique nga fabric -->
                            @if($mto['fabricSuggestion'] != null && $mto['suggestFabric'] != null)
                                <h5 class="normal">Boutique's suggestion of fabric with price:</h5>
                                <div class="row">
                                    <div class="col-md-5">
                                        @foreach($fabrics as $fabric)
                                        @if($fabric['id'] == $fabricSuggestion->fabricID) 
                                            <h5 class="normal">Fabric Type: <b>{{ucfirst($fabric['name'])}}</b></h5>
                                            <h5 class="normal">Fabric Color: <b>{{ucfirst($fabric['color'])}}</b></h5>
                                            <h5 class="normal">Price: <b>₱{{ucfirst($fabricSuggestion->price)}}</b></h5>
                                        @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-3">
                                        <!-- <br> -->
                                        <a href="{{url('inputAddress/'.$mto['id'].'/acceptSFPrice')}}" class="btn essence-btn">Accept Offer</a><br><br>
                                    </div>
                                </div><br>
                            @elseif($mto['fabricSuggestion'] != null && $mto['suggestFabric'] == null)
                                <h5 class="normal">Boutique has a suggestion you might like & consider:</h5>
                                <div class="row">
                                    <div class="col-md-5">
                                        @foreach($fabrics as $fabric)
                                        @if($fabric['id'] == $fabricSuggestion->fabricID) 
                                            <h5 class="normal">Fabric Type: <b>{{ucfirst($fabric['name'])}}</b></h5>
                                            <h5 class="normal">Fabric Color: <b>{{ucfirst($fabric['color'])}}</b></h5>
                                            <h5 class="normal">Price: <b>₱{{ucfirst($fabricSuggestion->price)}}</b></h5>
                                        @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-3">
                                        <br>
                                        <a href="{{url('inputAddress/'.$mto['id'].'/acceptFSPrice')}}" class="btn essence-btn">Accept Offer</a>
                                    </div>
                                </div><br>
                            @endif

                            <div class="cart-area" style="text-align: right;">
                                <a href="{{url('cancelMto/'.$mto['id'])}}" class="btn essence-btn">Cancel MTO</a>
                                <br><br>
                            </div>
                        @endif <!-- IF WALA PAY ORDER ANG MTO CLOSING -->


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="notificationsModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title"><b>Chat</b></h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                
            </div>

            <div class="modal-footer">
              <!-- <input type="submit" class="btn essence-btn" value="Place Request"> -->
              <input type="" class="btn btn-danger" data-dismiss="modal" value="Close">
            </div>
        </div> 
    </div>
</div>

<style type="text/css">
    .normal{font-weight: normal;}
</style>

<!-- </div> -->
@endsection

@section('scripts')

<script src="https://www.paypal.com/sdk/js?client-id=AamTreWezrZujgbQmvQoAQzyjY1UemHZa0WvMJApWAVsIje-yCaVzyR9b_K-YxDXhzTXlml17JeEnTKm"></script>
<script>
    
    var mtoOrderID = document.getElementById('mtoOrderID').value;
    var mtoID = document.getElementById('mtoID').value;
  
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
            return fetch('/hinimo/public/paypal-transaction-complete', {

              method: 'post',
              headers: {
                'content-type': 'application/json'
              },
              body: JSON.stringify({
                paypalOrderID: data.orderID,
                mtoOrderID: mtoOrderID,
                mtoID: mtoID
              })
            });
          });
        }
    }).render('#paypal-button-container');</script>

@endsection