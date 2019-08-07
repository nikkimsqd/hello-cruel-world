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
                             @if($mto->order['status'] == "For Alterations")
                             <div class="row">
                                <div class="col-md-12">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><h5>Your schedule for fitting will be on:</h5></td>
                                        <td style="text-align: right;"><h5>{{date('M d, Y',strtotime($mto->order['alterationDateStart'])).' - '.date('M d, Y',strtotime($mto->order['alterationDateEnd']))}}</h5></td>
                                    </tr>
                                </table>
                                    <p>You are required to visit the boutique at this time interval. If you failed to pay your visit, the boutique will deliver your item to you with the exact measurements you have given without any alterations.</p>
                                </div>
                             </div>
                             @endif

                            @if($mto['orderID'] != null)
                                <div class="order-details-confirmation"> <!-- card opening -->
                                    <div class="cart-page-heading">
                                        <h5>Your Order Details</h5>
                                    </div>
                                    <?php
                                    if($mto->measurement != null){
                                        $measurements = json_decode($mto->measurement->data);
                                    }
                                    ?>

                                    <ul class="order-details-form mb-4">
                                        <li><span>Order ID</span> <span>{{$mto->order['id']}}</span></li>
                                        <li><span>Address of Delivery</span> <span>{{$mto->order->address['completeAddress']}}</span></li>
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
                                            @if($mto->order['paymentStatus'] == "Not Yet Paid")
                                            <span style="color: red; text-align: right;">{{$mto->order['paymentStatus']}}<br><i>(You are first required to pay so the boutique can start processing your item.)</i></span>
                                            @else
                                            <span style="color: red; text-align: right;">{{$mto->order['paymentStatus']}}</span>
                                            @endif
                                        </li>
                                    </ul>
                                    @if($mto->order['status'] == "For Pickup" || $mto->order['status'] == "For Delivery")
                                    <div class="notif-area cart-area" style="text-align: right;">
                                        <input type="submit" class="btn essence-btn" disabled value="Item Received">
                                    </div>
                                    @elseif($mto->order['status'] == "On Delivery" || $mto->order['status'] == "Delivered")
                                    <div class="notif-area cart-area" style="text-align: right;">
                                        <a href="{{url('receiveOrder/'.$mto->order['id'])}}" class="btn essence-btn">Item Received</a>
                                    </div>
                                    <!-- elseif($mto['status'] == "On Rent") -->
                                    @endif
                                </div> <!-- card closing --><br><br>

                                @if($mto->order['paymentStatus'] == "Not Yet Paid")
                                <h5>Pay here:</h5>
                                <div class="col-md-3" id="paypal-button-container">
                                    <input type="text" id="mtoOrderID" value="{{$mto->order['id']}}" hidden>
                                    <input type="text" id="mtoID" value="{{$mto['id']}}" hidden>
                                    <input type="text" id="total" value="{{$mto->order['total']}}" hidden>
                                </div><br><br>
                                @endif
                            @endif


                                <div class="order-details-confirmation">
                                    <div class="cart-page-heading">
                                        <h5>Your Made-to-Order</h5>
                                    </div>

                                    <ul class="order-details-form mb-4">
                                        @if($mto['status'] == "Cancelled")
                                            <li><span></span><span style="color: red;">MTO has been cancelled</span><span></span></li>
                                        @elseif($mto['status'] != "Cancelled" && $mto['status'] != "Active")
                                            <li style="color: red;"><span>MTO has been declined</span><span>Reason: {{$mto->declineDetails['reason']}}</span></li>
                                        @endif
                                        <li><span>MTO ID</span> <span>{{$mto['id']}}</span></li>
                                        <li><span>Boutique Name</span> <span>{{$mto->boutique['boutiqueName']}}</span></li>
                                        <li><span>Deadline of product</span> <span>{{date('M d, Y',strtotime($mto['deadlineOfProduct']))}}</span></li>
                                        <li><span>Quantity</span> <span>{{$mto['quantity']}} pcs.</span></li>
                                        <li><span>Number of wearers</span> <span>{{$mto['numOfPerson']}}</span></li>
                                        

                                        <li><span>Instructions/Notes</span> <span>{{$mto['notes']}}</span></li>
                                        <li><span>Fabric</span> 
                                            <span>
                                            @if($mto['fabChoice'] == "provide")
                                            <i>[You chose to provide boutique the fabric]</i>
                                            @elseif($mto['fabChoice'] == "askboutique")
                                            <i>[You chose to let boutique provide the fabric]</i>
                                            @endif
                                        </span>
                                        </li>
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
                            @if($mto['fabChoice'] != null && $mto['price'] != null)
                                <h5 class="normal">Boutique's price for item:</h5>
                                <div class="row">
                                    <div class="col-md-5"> 
                                        <h4 class="normal">Price: <b>₱{{ucfirst($mto['price'])}}</b></h4>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{url('inputAddress/'.$mto['id'].'/acceptFabricPrice')}}" class="btn essence-btn">Accept Offer</a>
                                    </div>
                                </div><br>
                            @endif

                            <!-- if nangayo si boutique ang pa provide'on ni client -->
                            @if($mto['fabSuggestion'] != null)
                                <h5 class="normal">Boutique's suggestion of fabric with price:</h5>
                                <div class="row">
                                    <div class="col-md-5">
                                        <h5 class="normal">Fabric Type: <b>{{ucfirst($mto['fabSuggestion'])}}</b></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- <br> -->
                                        <a href="{{url('inputAddress/'.$mto['id'].'/acceptSuggestedFabricPrice')}}" class="btn essence-btn">Accept Offer</a><br><br>
                                    </div>
                                </div><br>
                            @endif

                            <div class="cart-area" style="text-align: right;">
                                <a href="{{url('cancelMto/'.$mto['id'])}}" class="btn essence-btn">Cancel MTO</a>
                                <br><br>
                            </div>
                        @endif <!-- IF WALA PAY ORDER ANG MTO CLOSING -->


                        <div class="col-12 col-md-11" id="measurements">
                            <div class="regular-page-content-wrapper section-padding-80">
                                <div class="regular-page-text">
                                @if($mto['measurementID'] == null)
                                    <form action="{{url('submitMeasurementforMto')}}" method="post">
                                        {{csrf_field()}}
                                        <h4>Submit Measurements</h4><br>

                                        <div class="row"> 
                                            <div class="col-md-8">
                                                @for($counter = 1; $mto['numOfPerson'] >= $counter; $counter++)
                                                <h5>Enter name for Person {{$counter}}</h5>
                                                <input type="text" name="person[{{$counter}}]" class="form-control"><br>

                                                <div class="row"> 
                                                    <div class="col-md-8">
                                                        @foreach($mrequests as $mrequest)
                                                            <?php $measurementNames = json_decode($mrequest->measurements); ?>

                                                            <h6>Measurement for {{$mrequest->category['categoryName']}}</h6>
                                                            @foreach($measurementNames as $measurementName)

                                                                <label>{{$measurementName}}</label>
                                                                <input type="text" name="{{$counter}}[{{$mrequest->category['categoryName']}}][{{$measurementName}}]" placeholder="{{$measurementName}}" class="form-control"><br>

                                                            @endforeach<br>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endfor
                                                <input type="submit" name="btn_submit" value="Submit">
                                            </div>
                                        </div>


                                        <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>
                                    </form>
                                @else
                                    <h4>Measurements Submitted</h4><br>
                                <div class="row">
                                    <div class="col-md-12" style="column-count: 2">
                                    @foreach($measurements as $measurement)
                                        @foreach($measurement as $person)
                                        @if(is_array($person)) <!-- filter if naay array si person -->
                                            @foreach($person as $personData)
                                            @if(is_object($personData)) <!-- filter if naay object si personData -->
                                                <?php $personDataArray = (array) $personData; ?> <!-- convert object to array para ma access -->
                                                @foreach($personDataArray as $measurementName => $dataObject) <!-- get name and data -->
                                                    <?php $dataArray = (array) $dataObject; ?> <!-- convert to array gihapon kay object pa ang variable -->
                                                    <label><b>{{strtoupper($measurementName)}}</b></label><br>
                                                    @foreach($dataArray as $dataName => $data)
                                                        <label>{{$dataName}}: &nbsp; {{$data}}"</label><br>
                                                    @endforeach
                                                @endforeach
                                            @endif
                                            @endforeach
                                            <hr>
                                        @else
                                            <label><b>Name:</b> {{strtoupper($person)}}</label><br>
                                        @endif
                                        @endforeach
                                    @endforeach
                                    </div>
                                </div>

                                @endif
                                </div>
                            </div>
                        </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style type="text/css">
    .normal{font-weight: normal;}
    .table{margin-bottom: 0;}
    .order-details-confirmation .order-details-form li{padding: 20px 10px;}
</style>

<!-- </div> -->
@endsection

@section('scripts')

<script src="https://www.paypal.com/sdk/js?client-id=AamTreWezrZujgbQmvQoAQzyjY1UemHZa0WvMJApWAVsIje-yCaVzyR9b_K-YxDXhzTXlml17JeEnTKm"></script>
<script>
    
    var mtoOrderID = document.getElementById('mtoOrderID').value;
    var mtoID = document.getElementById('mtoID').value;
    var total = document.getElementById('total').value;
  
    paypal.Buttons({
        createOrder: function(data, actions) {
          // Set up the transaction
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: total
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
        },
        onError: function (err) {
            alert("An error has occured during the transaction. Please try again.");
        }
    }).render('#paypal-button-container');</script>

@endsection