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
                                        <td style="text-align: right;"><h5>{{date('M d, Y',strtotime($bidding->order->alteration['dateStart'])).' - '.date('M d, Y',strtotime($bidding->order->alteration['dateEnd']))}}</h5></td>
                                    </tr>
                                </table>
                                    <p>You are required to visit the boutique at this time interval. If you failed to pay your visit, the boutique will deliver your item to you with the exact measurements you have given without any alterations.</p>
                                </div>
                            </div>
                        @endif
                        
                        <?php
                        $total = $bidding->order['total'];
                        $minimumPaymentRequired = $total * 0.50;
                        $measurementID = $bidding['measurementID'];
                        $balance = $bidding->order['total'];

                        if(count($payments) > 0){
                            foreach($bidding->order->payments as $payment){
                                $minimumPaymentRequired = $payment['balance'];
                                $balance = $payment['balance'];
                            }
                        }
                        ?>

                        <div class="order-details-confirmation" id="chat"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h4 style="margin-bottom: 30px;">Chat with seller:&nbsp; {{$bidding->order->boutique['boutiqueName']}}</h4>
                            </div>

                            <div class="chat-body">
                                @foreach($chats as $chat)
                                    @if($chat['senderID'] != $userID)
                                    <span class="sender">{{ $chat->sender->boutique['boutiqueName'] }}</span>
                                    <span class="chatTime">{{ date('d M h:i a',strtotime($chat['created_at'])) }}</span>
                                    <p class="receivedChat">{{$chat['message']}}</p><hr>
                                    @else
                                    <p class="chatTimeMe">{{ date('d M h:i a',strtotime($chat['created_at'])) }}</p>
                                    <p class="sendChat">{{$chat['message']}}</p><hr>
                                    @endif
                                @endforeach
                            </div>

                            <br>
                            <form action="{{url('cSendChat')}}" method="post">
                                {{ csrf_field() }}
                                @if($bidding->order['status'] != "Completed")
                                    <div class="input-group">
                                        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                        <input type="text" name="orderID" value="{{$bidding->order['id']}}" hidden>
                                        <span class="input-group-btn">
                                            <input type="submit" name="btn_submit" class="btn btn-primary" value="Send">
                                        </span>
                                    </div>
                                @else
                                    <div class="input-group">
                                        <input type="text" name="message" placeholder="Type Message ..." class="form-control" disabled>
                                        <span class="input-group-btn">
                                            <input type="submit" name="btn_submit" class="btn btn-primary" value="Send" disabled>
                                        </span>
                                    </div>
                                @endif
                            </form>

                        </div><br><br> <!-- card closing -->

                        <div class="order-details-confirmation"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h4>Your Order</h4>
                            </div>

                            <ul class="order-details-form mb-4">
                                <li><span>Order ID</span> <span>{{$bidding->order['id']}}</span></li>
                                <li><span>Boutique Name</span> <span>{{$bidding->bid->owner['boutiqueName']}}</span></li>
                                <li><span>Address of Delivery</span> <span>{{$bidding->order->address['completeAddress']}}</span></li>
                                


                                <li><span>Subtotal</span> <span>₱{{$bidding->order['subtotal']}}</span></li>
                                <li><span>Delivery Fee</span> <span>₱{{$bidding->order['deliveryfee']}}</span></li>
                                <li><span>Total</span> <span>₱{{$bidding->order['total']}}</span></li>
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
                                        <br><i style="color: red;">(You are required to pay the downpayment first so the boutique can start processing your item.)</i>
                                        @elseif($bidding->order['paymentStatus'] == "Not Yet Paid" && $bidding['measurementID'] == null)
                                        <br><i style="color: red;">(You can start processing your payment after you submit your measurements.)</i>
                                        @endif
                                    </span>
                                </li>
                                @if(count($payments) == 0)
                                <li style="background-color: #ffe9e9;"><span>Required Minimum Downpayment</span> <span>50% = ₱{{round($minimumPaymentRequired)}}</span></li>
                                @endif
                            </ul>
                            
                            @if($bidding->order['status'] == "For Pickup" || $bidding->order['status'] == "For Delivery")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <input type="submit" class="btn essence-btn" disabled value="Item Recieved">
                            </div>
                            @elseif($bidding->order['status'] == "Delivered")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <a href="" class="btn essence-btn white-btn" data-toggle="modal" data-target="#fileForComplain">File for complains</a> &nbsp;&nbsp;&nbsp;
                                <a href="" class="btn essence-btn" data-toggle="modal" data-target="#confirmReceive">Item Recieved</a>
                            </div>
                            <!-- elseif($order['status'] == "On Rent") -->
                            @endif

                        </div><br><br> <!-- card closing -->

                        @if(count($payments) > 0)
                        <?php $counter = 1; ?>
                        <div class="order-details-confirmation"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h4>Payment History</h4>
                            </div>
                            <ul class="order-details-form mb-4">
                                @foreach($bidding->order->payments as $payment)
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

                        @if($bidding->order['paymentStatus'] != "Fully Paid" && $bidding['measurementID'] != null)

                        <h4>Pay here:</h4>
                        <p class="note"><i>Note: PayPal does not accept payments with decimals.</i></p>
                        <div class="col-md-3" id="paypal-button-container">
                            <input type="text" id="total" value="{{$total}}" hidden>
                            <input type="text" id="minimumPaymentRequired" value="{{$minimumPaymentRequired}}" hidden>
                            <input type="text" id="amount" class="form-control mb-10">
                            <input type="text" id="biddingID" value="{{$bidding['id']}}" hidden>
                            <input type="text" id="biddingOrderID" value="{{$bidding->order['id']}}" hidden>
                            <input type="text" id="measurementID" class="form-control mb-10" value="{{$measurementID}}" hidden>
                            <input type="text" id="balance" value="{{$balance}}" hidden>
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

                            <?php $nameOfWearers = json_decode($bidding['nameOfWearers']); ?>

                            @if(count($mrequests) > 0)
                                <div class="row"> 
                                    <div class="col-md-12">

                                        @if($bidding['numOfPerson'] == "equals")
                                            @for($counter = 1; $bidding['quantity'] >= $counter; $counter++)
                                            <h4>Enter name and measurement for Person {{$counter}}</h4>
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
                                            <p style="color: #0315ff;"><i>Please wait for boutique's request...</i></p>

                                        @else
                                            <?php $counter = 1; ?>
                                            @foreach($nameOfWearers as $nameOfWearer => $count)
                                            <h5>Enter measurement of {{ucfirst($nameOfWearer)}}</h5>
                                            <input type="text" name="person[{{$counter}}]" class="form-control" value="{{$nameOfWearer}}" hidden>

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
                                            <?php $counter++; ?>
                                            <hr>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <input type="submit" name="btn_submit" class="btn essence-btn" value="Submit">
                            @else
                                <p style="color: #0315ff;"><i>Please wait for boutique's request. You'll get notified when the boutique has assigned measurements for your item&hellip;</i></p>
                            @endif


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

<div class="modal fade" id="confirmReceive" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h3 class="modal-title"><b>Rent Details</b></h3> -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <h5>Are you sure?</h5>
                <p>Once you clicked YES, there's no turning back!</p>
            </div>

            <div class="modal-footer">
                <a href="{{url('receiveOrder/'.$bidding->order['id'])}}" class="btn essence-btn">YES</a>
            </div>
        </div> 
    </div>
</div>

<div class="modal fade" id="fileForComplain" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Submit your complain</b></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="{{url('fileComplain')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="file" name="file[]" id="imgInp" class="form-control" multiple required><br>
                    <!-- <img id="imgPreview" src="#" alt="" /><br> -->
                    <textarea name="complain" class="form-control" rows="4" required></textarea>
                    <input type="text" name="userID" value="{{$bidding->order->customer['id']}}" hidden>
                    <input type="text" name="orderID" value="{{$bidding->order['id']}}" hidden>
                </div>

                <div class="modal-footer">
                    <input type="submit" name="btn_submit" value="Submit" class="btn essence-btn">
                </div>
            </form>
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
    .mb-10{margin-bottom: 10px;}
    .payment-heading{background-color: aliceblue;}
    h6{margin-bottom: 0;}
    .note{font-size: 14px !important; margin-bottom: 10px !important; color: red; font-weight: bold !important;}
    .order-details-confirmation .order-details-form li{padding: 20px 5px;}
    /*a:hover{font-size: 18px; color: #ffffff;}*/
    .white-btn{color: #0315ff; background-color: white; border: 1px solid #0315ff;}
    .white-btn:hover{border-color: #dc0345;}
    .receivedChat{margin-bottom: 0 !important; text-align: left; color: black; font-size: 16px !important;}
    .sendChat{margin-bottom: 0 !important; text-align: right; color: black; font-size: 16px !important; margin-right: 15px;}
    .sender{color: black; font-size: 12px !important; font-weight: 500;}
    .chatTime{color: #8e8e8e; font-size: 12px !important; margin-left: 355px; margin-bottom: 0 !important;}
    .chatTimeMe{color: #8e8e8e; font-size: 12px !important; margin-bottom: 0 !important; text-align: center;}
    .chat-body{max-height: 300px;  overflow-y: scroll;}
    hr{margin-top: 7px;  margin-bottom: 7px;}
</style>
@endsection


@section('scripts')

<script src="https://www.paypal.com/sdk/js?currency=PHP&client-id=AamTreWezrZujgbQmvQoAQzyjY1UemHZa0WvMJApWAVsIje-yCaVzyR9b_K-YxDXhzTXlml17JeEnTKm"></script>
<script>
    
    var biddingOrderID = $('#biddingOrderID').val();
    var biddingID = $('#biddingID').val();
    var total = $('#total').val();
    var minimumPaymentRequired = $('#minimumPaymentRequired').val();
    var measurementID = $('#measurementID').val();
    var balance = $('#balance').val();
    var test = false;

    if(measurementID != null){
    paypal.Buttons({
        createOrder: function(data, actions) {
            var total = parseInt($('#total').val());
            var minimumPaymentRequired = parseInt($('#minimumPaymentRequired').val());
            var amount = parseInt($('#amount').val());

            // console.log($.type(total));
            // console.log($.type(minimumPaymentRequired));
            // console.log($.type(amount));
            
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
            }else{
                test = true;
            }
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
                biddingOrderID: biddingOrderID,
                biddingID: biddingID,
                amount: amount,
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
        
        if(test){
            alert('noo');
            test = false;
        }

            // alert("An error has occured during the transaction. Please check the amount entered.");
        }
    }).render('#paypal-button-container');
    } //if closing
</script>

@endsection