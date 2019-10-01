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
                        
                                <?php
                                $total = $mto->order['total'];
                                $minimumPaymentRequired = $total * 0.50;
                                $measurementID = $mto['measurementID'];
                                $balance = $mto->order['total'];

                                if(count($payments) > 0){
                                    foreach($mto->order->payments as $payment){
                                        $minimumPaymentRequired = $payment['balance'];
                                        $balance = $payment['balance'];
                                    }
                                }
                                ?>

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
                                                <span style="color: red; text-align: right;">{{$mto->order['paymentStatus']}}
                                                    @if($mto->order['paymentStatus'] == "Not Yet Paid" && $mto['measurementID'] != null)
                                                    <br><i>(You are first required to pay so the boutique can start processing your item.)</i>
                                                    @elseif($mto->order['paymentStatus'] == "Not Yet Paid" && $mto['measurementID'] == null)
                                                    <br><i>(You can start processing your payment after you submit your measurements.)</i>
                                                    @endif
                                                </span>
                                                @else
                                                <span style="color: red; text-align: right;">{{$mto->order['paymentStatus']}}</span>
                                                @endif
                                            </li>
                                            @if(count($payments) == 0)
                                            <li style="background-color: #ffe9e9;"><span>Required Minimum Downpayment</span> <span>50% = ₱{{$minimumPaymentRequired}}</span></li>
                                            @endif
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

                                    @if(count($payments) > 0)
                                    <?php $counter = 1; ?>
                                    <div class="order-details-confirmation"> <!-- card opening -->
                                        <div class="cart-page-heading">
                                            <h5>Payment History</h5>
                                        </div>
                                        <ul class="order-details-form mb-4">
                                            @foreach($mto->order->payments as $payment)
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

                                    @if($mto->order['paymentStatus'] != "Fully Paid" && $mto['measurementID'] != null)
                                    <h5>Pay here:</h5>
                                    <div class="col-md-3" id="paypal-button-container">
                                        <input type="text" id="amount" class="form-control mb-10">
                                        <input type="text" id="mtoOrderID" value="{{$mto->order['id']}}" hidden>
                                        <input type="text" id="mtoID" value="{{$mto['id']}}" hidden>
                                        <input type="text" id="total" value="{{$total}}" hidden>
                                        <input type="text" id="minimumPaymentRequired" value="{{$minimumPaymentRequired}}" hidden>
                                        <input type="text" id="measurementID" value="{{$measurementID}}" hidden>
                                        <input type="text" id="balance" value="{{$balance}}" hidden>
                                    </div><br><br>
                                    @endif
                                @endif
                                    

                                @if($mto['orderID'] == null && $mto['status'] == "Active") <!-- IF WALA PAY ORDER ANG MTO -->
                                    <!-- if naay chosen fabric & naghatag ug price si boutique -->
                                    @if($mto['fabChoice'] == "provide" && $mto['price'] != null)
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
                                    @if($mto['fabSuggestion'] != null && $mto['fabChoice'] == "askboutique")
                                        <h5 class="normal">Boutique's suggestion of fabric with price:</h5>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h5 class="normal">Fabric Type: <b>{{ucfirst($mto['fabSuggestion'])}}</b></h5>
                                                <h4 class="normal">Price: <b>₱{{ucfirst($mto['price'])}}</b></h4>
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



                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <section class="single_product_details_area d-flex align-items-center">
                    <!-- Single Product Thumb -->
                    <div class="single_product_thumb clearfix">
                        <!-- <div class="product_thumbnail_slides owl-carousel"> -->
                            <img src="{{ asset('/uploads').$mto->productFile['filename'] }}" alt="">
                        <!-- </div> -->
                    </div>

                    <?php
                    if($mto->measurement != null){
                        $measurements = json_decode($mto->measurement->data);
                    }
                    ?>

                    <!-- Single Product Description -->
                    <div class="single_product_desc clearfix">
                        <p><b>Made-to-order ID:</b> &nbsp; {{$mto['id']}}</p>
                        <!-- <h4>Maximum Price Limit: ₱{{ $mto['maxPriceLimit'] }}</h4> -->
                        <p class="product-price"></p>
                        <p><b>Deadline of Product:</b> &nbsp; {{ date('M d, Y',strtotime($mto['deadlineOfProduct'])) }}</p>
                        <hr>
                        <p><b>Quantity:</b> &nbsp; {{$mto['quantity']}}pcs.</p>
                        <p><b>Number of wearers:</b> &nbsp; {{$mto['nameOfWearers']}}</p>
                        <p><b>Fabric:</b> &nbsp; 
                            @if($mto['fabChoice'] == "provide")
                                <i>[You chose to provide boutique the fabric]</i>
                            @elseif($mto['fabChoice'] == "askboutique")
                                @if($mto['orderID'] != null)
                                    {{$mto['fabSuggestion']}}
                                @else
                                    <i>[You chose to let boutique provide the fabric]</i>
                                @endif
                            @endif
                        </p>
                        <p><b>Your notes/instructions:</b></p>
                        <p class="">{{ $mto['notes'] }}</p>
                        <hr>
                        <p><b>Boutique Name:</b> &nbsp; {{$mto->boutique['boutiqueName']}}</p>
                        @if($mto->bid['fabricName'] != null)
                        <p><b>Boutique's Fabric Choice:</b> &nbsp; {{$mto->bid['fabricName']}}</p>
                        @endif
                        <p class="product-price"><b>Price:</b> &nbsp; ₱{{$mto['price']}}</p>
                    </div>
                </section><br><br><hr>
            </div>



            @if($mto['orderID'] != null) <!-- IF WALA PAY ORDER ANG MTO -->
            <div class="col-12 col-md-11" id="measurements">
                <div class="regular-page-content-wrapper section-padding-80">
                    <div class="regular-page-text">
                    @if($mto['measurementID'] == null)
                        <form action="{{url('submitMeasurementforMto')}}" method="post">
                            {{csrf_field()}}
                            <h4>Submit Measurements</h4><br>

                            <?php $nameOfWearers = json_decode($mto['nameOfWearers']);

                            // foreach($nameOfWearers as $nameOfWearer => $count){
                            //     echo $nameOfWearer;

                            // }

                            ?>

                            <div class="row"> 
                                <div class="col-md-8">
                                    @if(count($mrequests) > 0)
                                    
                                        @if($mto['numOfPerson'] == "equals")

                                        @for($counter = 1; $mto['quantity'] >= $counter; $counter++)
                                        <h5>Enter name and measurement for Person {{$counter}}</h5>
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
                                        @endforeach
                                        @endif
                                    <input type="submit" name="btn_submit" class="btn essence-btn" value="Submit">
                                    @else
                                    <p style="color: #0315ff;"><i>Please wait for boutique's request. You'll get notified when the boutique has assigned measurements for your item&hellip;</i></p>

                                    @endif
                                </div>
                            </div>


                            <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>
                        </form>
                    @else
                        <h4>Measurements Submitted</h4><br>
                    <div class="row">
                        <div class="col-md-12" style="column-count: {{$nameOfWearer}}">
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
                                <!-- <hr> -->
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
            @endif
        </div>
    </div>
</div>


<style type="text/css">
    .normal{font-weight: normal;}
    .table{margin-bottom: 0;}
    .order-details-confirmation .order-details-form li{padding: 20px 10px;}
    .mb-10{margin-bottom: 10px;}
    .payment-heading{background-color: aliceblue;}
    .single_product_details_area .single_product_desc .product-price{font-size: 18px ;}
    p{margin-bottom: 0;}
</style>

<!-- </div> -->
@endsection

@section('scripts')

<script src="https://www.paypal.com/sdk/js?currency=PHP&client-id=AamTreWezrZujgbQmvQoAQzyjY1UemHZa0WvMJApWAVsIje-yCaVzyR9b_K-YxDXhzTXlml17JeEnTKm"></script>
<script>
    
    var mtoOrderID = $('#mtoOrderID').val();
    var mtoID = $('#mtoID').val();
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
                mtoID: mtoID,
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