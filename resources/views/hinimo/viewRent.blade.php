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
                                    <td><h4>Your schedule for alterations will be on:</h4></td>
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
                                <h5 style="color: red; text-align: center;">You are required to visit the boutique personally on returning the item and claiming your cashban.</h5><br>
                            </div>
                        </div>
                        @endif


                        <?php
                        $total = $rent->order['total'];
                        $minimumPaymentRequired = $total * 0.50;
                        $measurementID = $rent['measurementID'];
                        $balance = $rent->order['total'];

                        if(count($payments) > 0){
                            foreach($rent->order->payments as $payment){
                                $minimumPaymentRequired = $payment['balance'];
                                $balance = $payment['balance'];
                            }
                        }
                        ?>

                        @if($rent->order != null)
                        <div class="order-details-confirmation" id="chat"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h4 style="margin-bottom: 30px;">Chat with seller:&nbsp; {{$rent->order->boutique['boutiqueName']}}</h4>
                            </div>

                            <div class="chat-body">
                                @if(count($chats) > 0)
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
                                @else
                                <p class="receivedChat"><i>Ask seller anything here...</i></p>
                                @endif
                            </div>

                            <br>
                            <form action="{{url('cSendChat')}}" method="post">
                                {{ csrf_field() }}
                                @if($rent->order['status'] != "Completed")
                                    <div class="input-group">
                                        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                        <input type="text" name="orderID" value="{{$rent->order['id']}}" hidden>
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
                        @endif

                             
                        @if($rent->order['status'] == "For Pickup" || $rent->order['status'] == "For Delivery" || $rent->order['status'] == "On Delivery" || $rent->order['status'] == "Delivered" || $rent->order['status'] == "Completed"|| $rent->order['status'] == "On Rent")
                        <div class="order-details-confirmation"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h4>Your Order Details</h4>
                            </div>

                            <ul class="order-details-form mb-4">
                                <li><span>Boutique Name</span> <span>{{$rent->order->boutique['boutiqueName']}}</span></li>
                                <li><span>Order ID</span> <span>{{$rent->order['id']}}</span></li>
                                <li><span>Product/s</span>
                                    @if($rent->order['cartID'] != null)
                                    <span>$rent->order->cart['id']</span>
                                    @elseif($rent->order['rentID'] != null)
                                        @if($rent->product != null)
                                        <span>{{$rent->product['productName']}}</span>
                                        @else
                                        <span>{{$rent->set['setName']}}</span>
                                        @endif
                                    @endif
                                </li>
                                <li><span>Date to be returned</span><span>{{date('M d, Y',strtotime($rent['dateToBeReturned']))}}</span></li>
                                <li><span>Delivery Address</span> <span>{{$rent->order->address['completeAddress']}}</span></li>
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
                                <li><span>Deposit Amount</span> 
                                    @if($rent->product != null)
                                    <span>₱{{$rent->product->rentDetails['cashban']}}</span>
                                    @else
                                    <span>₱{{$rent->set->rentDetails['cashban']}}</span>
                                    @endif
                                </li>
                                <li><span>Delivery Fee</span> <span>₱{{$rent->order['deliveryfee']}}</span></li>
                                <li><span>Total</span> <span style="color: red; font-weight: bold;">₱{{$rent->order['total']}}</span></li>
                                <li><span>Payment Status</span>
                                    <span style="color: red;">{{$rent->order['paymentStatus']}}</span>
                                </li>
                                @if(count($payments) == 0)
                                <li style="background-color: #ffe9e9;"><span>Required Minimum Downpayment</span> <span>50% = ₱{{$minimumPaymentRequired}}</span></li>
                                @endif
                            </ul>
                            @if($rent->order['status'] == "For Pickup" || $rent->order['status'] == "For Delivery")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <input type="submit" class="btn essence-btn" disabled value="Item Received">
                            </div>
                            @elseif($rent->order['status'] == "Delivered")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <a href="" class="btn essence-btn white-btn" data-toggle="modal" data-target="#fileForComplain">File for complains</a> &nbsp;&nbsp;&nbsp;
                                <a href="{{url('receiveRent/'.$rent['rentID'])}}" class="btn essence-btn">Item Received</a>
                            </div>
                            @elseif($rent->order['status'] == "On Rent")
                            <div class="notif-area cart-area" style="text-align: right;">
                                <input type="submit" class="btn essence-btn" hidden value="Item Received">
                            </div>
                            @endif
                        </div> <!-- card closing --><br><br>
                        @endif

                        <div class="order-details-confirmation"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h4>Your Rent Details</h4>
                            </div>

                            <ul class="order-details-form mb-4">
                                <li><span>Rent ID</span> <span>{{$rent['rentID']}}</span></li>
                                <li><span>Boutique Name</span> <span>{{$rent->boutique['boutiqueName']}}</span></li>
                                <li><span>Product/s</span> 
                                    @if($rent->product != null)
                                    <span>{{$rent->product['productName']}}</span>
                                    @else
                                    <span>{{$rent->set['setName']}}</span>
                                    @endif
                                </li>
                                <li><span>Date to use</span> <span>{{date('M d, Y',strtotime($rent['dateToUse']))}}</span></li>
                                <li><span>Your notes / instructions</span> <span>{{$rent['additionalNotes']}}</span></li>
                                <li><span>Date to be returned</span> <span>{{date('M d, Y',strtotime($rent['dateToBeReturned']))}}</span></li>
                                <li><span>Cashban</span> 
                                    @if($rent->product != null)
                                    <span>₱{{$rent->product->rentDetails['cashban']}}</span>
                                    @else
                                    <span>₱{{$rent->set->rentDetails['cashban']}}</span>
                                    @endif
                                </li>
                                <li><span>Penalty Amount</span> 
                                    @if($rent->product != null)
                                    <span>₱{{$rent->product->rentDetails['penaltyAmount']}}</span>
                                    @else
                                    <span>₱{{$rent->set->rentDetails['penaltyAmount']}}</span>
                                    @endif
                                </li>
                                <li><span>Status</span> 
                                    @if(strlen($rent['status']) == 1)
                                        <span style="color: red;">
                                            DECLINED
                                        </span>
                                    @else
                                        <span style="color: #0315ff;">
                                            {{$rent['status']}}
                                        </span>
                                    @endif
                                </li>
                                @if($rent['status'] == "Approved")
                                    @if($rent->order['status'] == "Pending" || $rent->order['status'] == "In-Progress")
                                    <li><span></span><span>Payment Info</span><span></span></li>
                                    <li><span>Subtotal</span> <span>₱{{$rent->order['subtotal']}}</span></li>
                                    <li><span>Deposit Amount</span> 
                                        @if($rent->product != null)
                                        <span>₱{{$rent->product->rentDetails['cashban']}}</span>
                                        @else
                                        <span>₱{{$rent->set->rentDetails['cashban']}}</span>
                                        @endif
                                    </li>
                                    <li><span>Delivery Fee</span> <span>₱{{$rent->order['deliveryfee']}}</span></li>
                                    <li><span>Total</span> <span style="color: red; font-weight: bold;">₱{{$rent->order['total']}}</span></li>
                                    <li><span>Payment Status</span> 
                                        @if($rent->order['paymentStatus'] == "Not Yet Paid")
                                        <span style="color: red; text-align: right;">{{$rent->order['paymentStatus']}}<br><i>(You are first required to pay so the boutique can start processing your item.)</i></span>
                                        @else
                                        <span style="color: #0315ff;">{{$rent->order['paymentStatus']}}</span>
                                        @endif
                                    </li>
                                        @if(count($payments) == 0)
                                        <li style="background-color: #ffe9e9;"><span>Required Minimum Downpayment</span> <span>50% = ₱{{$minimumPaymentRequired}}</span></li>
                                        @endif
                                    @endif
                                @endif
                                @if(!empty($rent->declineDetails))
                                    <li style="background-color: #ffd6d6;"><span>Boutique's reason</span> <span>{{$rent->declineDetails['reason']}}</span></li>
                                @endif
                            </ul>
                        </div> <!-- card closing --> <br>


                        @if(count($payments) > 0)
                        <?php $counter = 1; ?>
                        <div class="order-details-confirmation"> <!-- card opening -->
                            <div class="cart-page-heading">
                                <h4>Payment History</h4>
                            </div>
                            <ul class="order-details-form mb-4">
                                @foreach($rent->order->payments as $payment)
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
                        

                        @if($rent->order['paymentStatus'] != "Fully Paid" && $rent['status'] == "Approved")
                        <h5>Pay here:</h5>
                        <div class="col-md-3" id="paypal-button-container">
                            <input type="text" id="amount" class="form-control mb-10">
                            <input type="text" id="rentID" value="{{$rent['rentID']}}" hidden>
                            <input type="text" id="rentOrderID" value="{{$rent->order['id']}}" hidden>
                            <input type="text" id="total" value="{{$total}}" hidden>
                            <input type="text" id="minimumPaymentRequired" value="{{$minimumPaymentRequired}}" hidden>
                            <input type="text" id="measurementID" value="{{$measurementID}}" hidden>
                            <input type="text" id="balance" value="{{$balance}}" hidden>
                        </div>
                        @endif


                        <div class="col-12 col-md-11" id="measurements">
                            <div class="regular-page-content-wrapper section-padding-80">
                                <div class="regular-page-text">

                                <?php
                                if($rent->measurement != null){
                                    $measurements = json_decode($rent->measurement->data);
                                }
                                ?>
                                @if($rent['measurementID'] != null)
                                    <h4>Measurements Submitted</h4><br>
                                <div class="row">
                                    <div class="col-md-12" style="column-count: 2">
                                    @if($rent['setID'] != null)
                                        @foreach($measurements as $measurement)
                                            @foreach($measurement as $person)
                                            @if(!is_array($person)) <!-- filter if naay array si person -->
                                                @foreach($person as $name => $personData)
                                                @if(is_object($personData)) <!-- filter if naay object si personData -->
                                                    <label><b>{{strtoupper($name)}}</b></label><br>
                                                    <?php $personDataArray = (array) $personData; ?> <!-- convert object to array para ma access -->
                                                    @foreach($personDataArray as $measurementName => $dataObject) <!-- get name and data -->
                                                        <?php $dataArray = (array) $dataObject; ?> <!-- convert to array gihapon kay object pa ang variable -->
                                                        @foreach($dataArray as $dataName => $data)
                                                            <label>{{$measurementName}}: &nbsp; {{$data}}"</label><br>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                                @endforeach
                                                <hr>
                                            @else
                                                <label><b>Name:</b> </label><br>
                                            @endif
                                            @endforeach
                                        @endforeach
                                    @else
                                        @foreach($measurements as $measurement => $data)
                                            <label>{{$measurement}}: &nbsp; {{$data}}"</label><br>
                                        @endforeach
                                    @endif
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


<!-- MODAL -->
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
                <a href="{{url('receiveOrder/'.$rent->order['id'])}}" class="btn essence-btn">YES</a>
            </div>
        </div> 
    </div>
</div>

@if($rent->order != null)
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
                    <input type="text" name="userID" value="{{$rent->order->customer['id']}}" hidden>
                    <input type="text" name="orderID" value="{{$rent->order['id']}}" hidden>
                </div>

                <div class="modal-footer">
                    <input type="submit" name="btn_submit" value="Submit" class="btn essence-btn">
                </div>
            </form>
        </div> 
    </div>
</div>
@endif

<style type="text/css">
    .order-details-confirmation .order-details-form li{padding: 20px 10px;}
    .mb-10{margin-bottom: 10px;}
    .payment-heading{background-color: aliceblue;}
    .receivedChat{margin-bottom: 0 !important; text-align: left; color: black; font-size: 16px !important;}
    .sendChat{margin-bottom: 0 !important; text-align: right; color: black; font-size: 16px !important; margin-right: 15px;}
    .sender{color: black; font-size: 12px !important; font-weight: 500;}
    .chatTime{color: #8e8e8e; font-size: 12px !important; margin-left: 355px; margin-bottom: 0 !important;}
    .chatTimeMe{color: #8e8e8e; font-size: 12px !important; margin-bottom: 0 !important; text-align: center;}
    .chat-body{max-height: 300px;  overflow-y: scroll;}
    hr{margin-top: 7px;  margin-bottom: 7px;}
</style>

<!-- </div> -->
@endsection

@section('scripts')

<script src="https://www.paypal.com/sdk/js?currency=PHP&client-id=AamTreWezrZujgbQmvQoAQzyjY1UemHZa0WvMJApWAVsIje-yCaVzyR9b_K-YxDXhzTXlml17JeEnTKm"></script>
<script>
    
    var rentOrderID = $('#rentOrderID').val();
    var rentID = $('#rentID').val();
    var total = $('#total').val();
    var balance = $('#balance').val();
    var measurementID = $('#measurementID').val();

    if(measurementID != null){
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
            return fetch('/hinimo/public/paypal-transaction-complete', {

              method: 'post',
              headers: {
                'content-type': 'application/json'
              },
              body: JSON.stringify({
                paypalOrderID: data.orderID,
                rentOrderID: rentOrderID,
                rentID: rentID,
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
            alert("An error has occured during the transaction. Please try again.");
        }
    }).render('#paypal-button-container');
    } //if closing
</script>

@endsection