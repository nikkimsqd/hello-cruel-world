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
            <div class="col-12 col-md-12">
                <div class="regular-page-content-wrapper section-padding-80">
                    <div class="regular-page-text">

                        <div class="notif-area cart-area" style="text-align: right;">
                            <a href="" class="btn essence-btn" data-toggle="modal" data-target="#notificationsModal">Chat with seller here</a>
                            <br><br><br>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="order-details-confirmation">
                                    <div class="cart-page-heading">
                                        <h5>Your Made to Order</h5>
                                    </div>
                                    <?php
                                        $measurements = json_decode($mto->measurement->data)
                                    ?>

                                    <ul class="order-details-form mb-4">
                                        <li><span>MTO ID</span> <span>{{$mto['id']}}</span></li>
                                        <li><span>Date of use of the product</span> <span>{{$mto['dateOfUse']}}</span></li>
                                        <li><span>Height</span> <span>{{$mto['height']}} cm</span></li>
                                        <li><span>Category of item</span> <span>{{$mto->category['categoryName']}}</span></li>
                                        <li><span>Measurements</span> 
                                            <span style="text-align: right;">
                                                @foreach($measurements as $measurementName => $measurement)
                                                {{$measurementName.': '. $measurement}} <br>
                                                @endforeach
                                            </span></li>

                                        <li><span>Instructions/Notes</span> <span>{{$mto['notes']}}</span></li>
                                        @if($mto['finalPrice'] != null)
                                        <li><span>Price</span> <span>{{$mto['finalPrice']}}</span></li>
                                        @endif
                                    </ul>
                                </div><br><br>

                                 <!------------- SA UBOS NANI --------------->
                                @if($mto['offerPrice'] != null && $mto['finalPrice'] == null)
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 for="first_name">Boutique's offer price:</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5 for="first_name">{{$mto['offerPrice']}}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="" class="btn essence-btn">Accept offer</a>
                                    </div>
                                </div>
                                @endif
                                @if($mto['status'] == "In-Progress")
                                <!-- insert code here if naa nay address & payment si customer -->
                                    <h5>Add address for delivery:</h5>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <input type="text" name="address" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" name="btn_submit" class="btn essence-btn" value="Submit">
                                        </div>
                                    </div><br><br>
                                    <h5>Pay here:</h5>
                                    @if($mto['paymentStatus'] == "Not Yet Paid")
                                    <div class="col-md-3" id="paypal-button-container">
                                        <input type="text" id="mtoID" value="{{$mto['id']}}" hidden>
                                    </div>
                                    @endif
                                @endif
                            </div>

                            <div class="col-md-4">
                                <div class="order-details-confirmation"> 
                                    <div class="cart-page-heading">
                                        <h5>Chat</h5>
                                    </div>

                                    <ul class="order-details-form mb-4">
                                        <!-- <li><span>MTO ID</span> <span>{{$mto['id']}}</span></li> -->
                                    </ul>
                                </div>
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
            alert('Transaction completed by ' + details.payer);
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