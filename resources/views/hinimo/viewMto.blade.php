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
                                        <li><span>Status</span> 
                                            @if($mto['status'] == "On Rent")
                                            <span style="color: #0315ff;">{{$mto['status']}}</span></li>
                                            @else
                                            <span style="color: #0315ff;">{{$mto->order['status']}}</span></li>
                                            @endif

                                        <li><span></span><span>Payment Info</span><span></span></li>
                                        <li><span>Subtotal</span> <span>{{$mto->order['subtotal']}}</span></li>
                                        <li><span>Delivery Fee</span> <span>{{$mto->order['deliveryfee']}}</span></li>
                                        <li><span>Total</span> <span>{{$mto->order['total']}}</span></li>
                                        <li><span>Payment Status</span>
                                            <span style="color: red; text-align: right;">{{$mto['paymentStatus']}}</span>
                                        </li>
                                    </ul>
                                    @if($mto->order['status'] == "For Pickup" || $mto->order['status'] == "For Delivery")
                                    <div class="notif-area cart-area" style="text-align: right;">
                                        <input type="submit" class="btn essence-btn" disabled value="Item Recieved">
                                    </div>
                                    @elseif($mto->order['status'] == "On Delivery" || $mto->order['status'] == "Delivered")
                                    <div class="notif-area cart-area" style="text-align: right;">
                                        <a href="{{url('receiveRent/'.$mto['id'])}}" class="btn essence-btn">Item Recieved</a>
                                    </div>
                                    <!-- elseif($mto['status'] == "On Rent") -->
                                    @endif
                                </div> <!-- card closing --><br><br>
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
                                        @if($mto['price'] != null)
                                            <li><span>Price</span> <span style="color: #0315ff;">{{$mto['price']}}</span></li>
                                        @else
                                            <li><span>Price</span> <span style="color: #0315ff;">Boutique has not set a price yet.</span></li>
                                        @endif
                                    </ul>
                                </div><br><br>

                                @if($mto['price'] != null)
                                <h5>Boutique's price for item with the fabric of your choice:</h5>
                                <div class="row">
                                    <div class="col-md-5">
                                        @if($mto['fabricID'] != null && $mto['fabricChoice'] == null)
                                            @foreach($fabrics as $fabric)
                                            @if($fabric['id'] == $mto['fabricID'])
                                                <h5 class="normal">Fabric Type: <b>{{ucfirst($fabric['name'])}}</b></h5>
                                                <h5 class="normal">Fabric Color: <b>{{ucfirst($fabric['color'])}}</b></h5>
                                                <h5 class="normal">Price: <b>{{ucfirst($fabricSuggestion->price)}}</b></h5>
                                            @endif
                                            @endforeach
                                        @elseif($mto['fabricID'] == null && $mto['fabricChoice'] != null)
                                            <h5 class="normal">Fabric Type: <b>{{ucfirst($fabricChoice->fabricType)}}</b><h5>
                                            <h5 class="normal">Fabric Color: <b>{{ucfirst($fabricChoice->fabricColor)}}</b><h5>
                                            <h5 class="normal">Price: <b>{{$mto['price']}}</b></h5>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <form>
                                            @if($mto['fabricID'] != null && $mto['fabricChoice'] == null)
                                                @foreach($fabrics as $fabric)
                                                @if($fabric['id'] == $mto['fabricID'])
                                                <input name="fabricID" value="{{$fabric['id']}}">
                                                    <h5 class="normal">Fabric Type: <b>{{ucfirst($fabric['name'])}}</b></h5>
                                                    <h5 class="normal">Fabric Color: <b>{{ucfirst($fabric['color'])}}</b></h5>
                                                    <h5 class="normal">Price: <b>{{ucfirst($fabricSuggestion->price)}}</b></h5>
                                                @endif
                                                @endforeach
                                            @elseif($mto['fabricID'] == null && $mto['fabricChoice'] != null)
                                                <h5 class="normal">Fabric Type: <b>{{ucfirst($fabricChoice->fabricType)}}</b><h5>
                                                <h5 class="normal">Fabric Color: <b>{{ucfirst($fabricChoice->fabricColor)}}</b><h5>
                                                <h5 class="normal">Price: <b>{{$mto['price']}}</b></h5>
                                            @endif
                                            <input type="submit" name="" class="btn essence-btn" value="Accept Offer">
                                        </form>
                                    </div>
                                </div>
                                @endif

                                @if($mto['fabricSuggestion'] != null && $mto['orderID'] == null)
                                <h5>Boutique Recommends you this:</h5>
                                <div class="row">
                                    <div class="col-md-5">
                                        @foreach($fabrics as $fabric)
                                        @if($fabric['id'] == $fabricSuggestion->fabricID)
                                            <h5 class="normal">Fabric Type: <b>{{ucfirst($fabric['name'])}}</b></h5>
                                            <h5 class="normal">Fabric Color: <b>{{ucfirst($fabric['color'])}}</b></h5>
                                            <h5 class="normal">Price: <b>{{ucfirst($fabricSuggestion->price)}}</b></h5>
                                        @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-3">
                                        <form action="" method="get">
                                            <input name="fabricSuggestion" value="{{$fabricSuggestion->price}}" hidden>
                                            <input name="priceSuggestion" value="{{$fabricSuggestion->price}}" hidden>
                                            <input type="submit" name="" class="btn essence-btn" value="Accept Offer">
                                        </form>
                                    </div>
                                </div>
                                @endif
                                 <!------------- SA UBOS NANI --------------->
                                @if($mto['offerPrice'] != null && $mto['finalPrice'] == null)
                                <div id="offer-price" class="row">
                                    <div class="col-md-6">
                                        <h5 for="first_name">Boutique's offer price:</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <form action="{{url('acceptOffer')}}" method="post">
                                            {{csrf_field()}}
                                        <h5 for="first_name">{{$mto['offerPrice']}}</h5>

                                        <input type="text" name="offerPrice" value="{{$mto['offerPrice']}}" hidden>
                                        <input type="text" name="boutiqueID" value="{{$mto->boutique['id']}}" hidden>
                                        <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="submit" name="btn_submit" class="btn essence-btn" value="Accept offer">
                                    </form>
                                        <!-- <a href="" class="btn essence-btn">Accept offer</a> -->
                                    </div>
                                </div>
                                @endif

                                @if($mto['finalPrice'] != null && $mto['deliveryAddress'] == null)
                                    <h5>Add address for delivery:</h5>(address is not working as of the moment kay wala pa ang api)
                                    <div class="row">
                                        <div class="col-md-7">
                                            <form action="{{url('/submitAddress')}}" method="post">
                                                {{csrf_field()}}
                                            <input type="text" name="address" class="form-control" required>
                                            <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" name="btn_submit" class="btn essence-btn" value="Submit">
                                        </form>
                                        </div>
                                    </div><br><br>
                                @endif



                                @if($mto['status'] == "In-Progress")
                                @if($mto['paymentStatus'] == "Not Yet Paid" && $mto['total'] != null)
                                    <h5>Pay here:</h5>
                                    <div class="col-md-3" id="paypal-button-container">
                                        <input type="text" id="mtoID" value="{{$mto['id']}}" hidden>
                                    </div>
                                @endif
                                @endif

                                
                            </div>

                            <!-- <div class="col-md-4">
                                <div class="order-details-confirmation"> 
                                    <div class="cart-page-heading">
                                        <h5>Chat</h5>
                                    </div>

                                    <ul class="order-details-form mb-4">

                                    </ul>
                                </div>
                            </div> -->
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
    
    var mtoID = document.getElementById('mtoID').value;
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
            return fetch('/hinimo/public/paypal-transaction-complete', {

              method: 'post',
              headers: {
                'content-type': 'application/json'
              },
              body: JSON.stringify({
                orderID: data.orderID,
                mtoID: mtoID
              })
            });
          });
        }
    }).render('#paypal-button-container');</script>

@endsection