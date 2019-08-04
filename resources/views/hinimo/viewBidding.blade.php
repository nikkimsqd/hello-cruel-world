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
                                <li><span>Payment Status</span> 
                                    <span style="color: red; text-align: right;">
                                        {{$bidding->order['paymentStatus']}}
                                        @if($bidding->order['paymentStatus'] == "Not Yet Paid" && $bidding['measurementID'] != null)
                                        <br><i style="color: red;">(You are required to pay first so the boutique can start processing your item.)</i>
                                        @elseif($bidding->order['paymentStatus'] == "Not Yet Paid" && $bidding['measurementID'] == null)
                                        <br><i style="color: red;">(You can start processing your payment after you submit your measurements.)</i>
                                        @endif
                                    </span>
                                </li>
                            </ul>
                            
                            @if($bidding->order['status'] == "For Pickup" || $bidding->order['status'] == "For Delivery")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <input type="submit" class="btn essence-btn" disabled value="Item Recieved">
                            </div>
                            @elseif($bidding->order['status'] == "On Delivery" || $bidding->order['status'] == "Delivered")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <a href="{{url('receiveOrder/'.$bidding->order['id'])}}" class="btn essence-btn">Item Recieved</a>
                            </div>
                            <!-- elseif($order['status'] == "On Rent") -->
                            @endif

                        </div><br><br> <!-- card closing -->

                        @if($bidding->order['paymentStatus'] == "Not Yet Paid" && $bidding['measurementID'] != null)
                        
                        <h5>Pay here:</h5>
                        <div class="col-md-3" id="paypal-button-container">
                            <input type="text" id="orderTransactionID" value="{{$bidding->order['id']}}" hidden>
                            <input type="text" id="total" value="{{$bidding->order['total']}}" hidden>
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
                    if($bidding->measurement != null){
                        $measurements = json_decode($bidding->measurement->data);
                    }
                    ?>

                    <!-- Single Product Description -->
                    <div class="single_product_desc clearfix">
                        <span>By: &nbsp; {{$bidding->owner['fname'].' '.$bidding->owner['lname']}}</span>
                        <!-- <h4>Maximum Price Limit: ₱{{ $bidding['maxPriceLimit'] }}</h4> -->
                        <p class="product-price"></p>
                        <p class="product-price"><b>Maximum Price Limit:</b> &nbsp;  ₱{{ $bidding['quotationPrice'] }}</p>
                        <p><b>Bidding End Date:</b> &nbsp; {{ date('M d, Y',strtotime($bidding['endDate'])) }}</p>
                        <p><b>Deadline of Product:</b> &nbsp; {{ date('M d, Y',strtotime($bidding['deadlineOfProduct'])) }}</p>
                        <hr>
                        <p><b>Your notes/instructions:</b></p>
                        <p class="">{{ $bidding['notes'] }}</p>
                        <p><b>Quantity:</b> &nbsp; {{$bidding['quantity']}}pcs.</p>
                        <!-- <hr>
                        @if($bidding->measurement != null)
                        <a href="" data-toggle="modal" data-target="#measurementsModal">View measurements here</a>
                        @else
                        <p>You have not submitted any measurememnts</p>
                        @endif -->
                        <hr>
                        <p><b>Your chosen Bid</b></p>
                        <p><b>Boutique Name:</b> &nbsp; {{$bidding->bid->owner['boutiqueName']}}</p>
                        @if($bidding->bid['fabricName'] != null)
                        <p><b>Boutique's Fabric Choice:</b> &nbsp; {{$bidding->bid['fabricName']}}</p>
                        @endif
                        <p class="product-price"><b>Bid:</b> &nbsp; ₱{{$bidding->bid['quotationPrice']}}</p>
                    </div>
                </section><br><br><hr>
            </div>
            <div class="col-12 col-md-11" id="measurements">
                <div class="regular-page-content-wrapper section-padding-80">
                    <div class="regular-page-text">
                    @if($bidding['measurementID'] == null)
                        <form action="{{url('submitMeasurementforBidding')}}" method="post">
                            {{csrf_field()}}
                            <h4>Submit Measurements</h4><br>

                            <div class="row"> 
                                <div class="col-md-8">
                                    @for($counter = 1; $bidding['quantity'] >= $counter; $counter++)
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


                            <input type="text" name="biddingID" value="{{$bidding['id']}}" hidden>
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

<!-- MODAL -->
<div class="modal fade" id="measurementsModal" role="dialog">
    <div class="modal-dialog modal-md">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><b>Measurements Submitted</b></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
                <!-- <p><b>Measurements Submitted:</b></p> -->
                @if($bidding['measurementID'] != null)
                @foreach($measurements as $measurement)
                    @foreach($measurement as $person)
                    @if(is_array($person)) <!-- filter if naay array si person -->
                        @foreach($person as $personData)
                        @if(is_object($personData)) <!-- filter if naay object si personData -->
                            <?php $personDataArray = (array) $personData; ?> <!-- convert object to array para ma access -->
                            @foreach($personDataArray as $measurementName => $dataObject) <!-- get name and data -->
                                <?php $dataArray = (array) $dataObject; ?> <!-- convert to array gihapon kay object pa ang variable -->
                                <p><b>{{strtoupper($measurementName)}}</b></p>
                                @foreach($dataArray as $dataName => $data)
                                    <p>{{$dataName}}: &nbsp; {{$data}}"</p>
                                @endforeach
                            @endforeach
                        @else
                            <p>haynakoo</p>
                        @endif
                        @endforeach
                        <hr>
                    @else
                        <p><b>Name:</b> {{strtoupper($person)}}</p>
                    @endif
                    @endforeach
                @endforeach
                @endif
          </div>

          <div class="modal-footer">
            <!-- <input type="submit" class="btn essence-btn" value="Place Request"> -->
            <input type="submit" class="btn essence-btn" value="Cancel">
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
    var total = document.getElementById('total').value;
    // console.log(orderTransactionID);
    paypal.Buttons({
        createOrder: function(data, actions) {
          // Set up the transaction
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: total, 
                currencyCode: 'PHP'
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
        },
        onError: function (err) {
            alert("An error has occured during the transaction. Please try again.");
        }
    }).render('#paypal-button-container');
</script>

@endsection