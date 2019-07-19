@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')

<div class="single-blog-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="regular-page-content-wrapper section-padding-80 checkout_details_area">
                    <div class="regular-page-text">
                        <h2 style="text-align: center;">Input your delivery details</h2>
                         
                        @if($mto != null)   
                        <form action="{{url('makeOrderforMTO')}}" method="post">
                            {{csrf_field()}}

                        <div class="col-md-12 mb-3">
                            <label>Name <span>*</span></label>
                            <input type="text" name="billingName" class="form-control" required value="{{$user['fname']. ' '.$user['lname']}}"><br>

                            <label>Contact Number <span>*</span></label>
                            <input type="text" name="phoneNumber" class="form-control" maxlength="11" required><br>

                            <label>Delivery Address <span>*</span></label>
                            <input type="text" name="deliveryAddress" class="form-control" id="deliveryAddress" required>
                            <!-- (apply api here) --><br><br>
                            <a id="addressBtn" class="btn essence-btn" style="color: white;">Submit Address</a>
                        </div>
                        
                        <div class="col-md-12 mb-3">
                        </div>
                        <br><br>

                        <div class="order-details-confirmation" hidden>
                            <div class="cart-page-heading">
                                <!-- <h5>Your Made-to-Order</h5> -->
                            </div>
                            <?php
                                $adminShare = $mtoPrice * $percentage;
                                $boutiqueShare = $mtoPrice - $adminShare;
                                $deliveryfee = 50;
                                $total = $mtoPrice + $deliveryfee;
                                $fabricSuggestion = json_decode($mto['fabricSuggestion']);
                            ?>
                            <ul class="order-details-form mb-4">
                                <li><span>MTO Price</span> <span>{{$mtoPrice}}</span></li>
                                <li><span>Subtotal</span> <span>{{$mtoPrice}}</span></li>
                                <li><span>Delivery Fee</span> <span><i>50</i></span></li>
                                <li><span>Total</span> <span style="color: #0315ff;"><i>{{$total}}</i></span></li>
                            </ul>
                            <div class="col-md-12 mb-3" style="text-align: center;">
                                    <input name="mtoID" value="{{$mto['id']}}" hidden>
                                    <input type="text" name="adminShare" value="{{$adminShare}}" hidden>
                                    <input type="text" name="boutiqueShare" value="{{$boutiqueShare}}" hidden>
                                    <input type="text" name="subtotal" value="{{$mtoPrice}}" hidden>
                                    <input type="text" name="deliveryfee" value="{{$deliveryfee}}" hidden>
                                    <input type="text" name="total" value="{{$total}}" hidden><br>
                                    <input type="submit" class="btn essence-btn" value="Place Order">
                            </div>
                        </div>
                        </form>

    <!-- ------------- BIDDING------------------------------------------------- -->
                        @elseif($bid != null)
                        <form action="{{url('makeOrderforBidding')}}" method="post">
                            {{csrf_field()}}

                        <div class="col-md-12 mb-3">
                            <label>Name <span>*</span></label>
                            <input type="text" name="billingName" class="form-control" required value="{{$user['fname']. ' '.$user['lname']}}"><br>

                            <label>Contact Number <span>*</span></label>
                            <input type="text" name="phoneNumber" class="form-control" maxlength="11" required><br>

                            <label>Delivery Address</label>
                            <input type="text" name="deliveryAddress" class="form-control" id="deliveryAddress" required>
                            <!-- (apply api here) --><br><br>
                            <a id="addressBtn" class="btn essence-btn" style="color: white;">Submit Address</a>
                            <a href="{{url('view-bidding/'.$bid->bidding['id'])}}" class="btn essence-btn">Cancel</a>
                        </div>
                        
                        <div class="col-md-12 mb-3">
                        </div>
                        <br><br>

                        <div class="order-details-confirmation" hidden>
                            <div class="cart-page-heading">
                                <!-- <h5>Your Made-to-Order</h5> -->
                            </div>
                            <?php 
                            $subtotal = $bid['bidAmount'];
                            $deliveryfee = 50;
                            $total = $subtotal + $deliveryfee;
                            $adminShare = $subtotal * $percentage;
                            $boutiqueShare = $subtotal - $adminShare;
                            ?>
                            <ul class="order-details-form mb-4">
                                <li><span>Item Price</span> <span>{{$bid['bidAmount']}}</span></li>
                                <!-- <li><span>Subtotal</span> <span>{{$subtotal}}</span></li> -->
                                <li><span>Delivery Fee</span> <span><i>{{$deliveryfee}}</i></span></li>
                                <li><span>Total</span> <span style="color: #0315ff;"><i>{{$total}}</i></span></li>
                            </ul>
                            <div class="col-md-12 mb-3" style="text-align: center;">
                                    <input name="bidID" value="{{$bid['id']}}" hidden>
                                    <!-- <input name="biddingID" value="{{$bid->bidding['id']}}" > -->
                                    <input type="text" name="adminShare" value="{{$adminShare}}" hidden>
                                    <input type="text" name="boutiqueShare" value="{{$boutiqueShare}}" hidden>
                                    <input type="text" name="subtotal" value="{{$subtotal}}" hidden>
                                    <input type="text" name="deliveryfee" value="{{$deliveryfee}}" hidden>
                                    <input type="text" name="total" value="{{$total}}" hidden>
                                    <input type="submit" class="btn essence-btn" value="Place Order">
                                    <a href="sss">
                            </div>
                        </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- THE PLAN 
 - i'api ang address then get the value(longlat or unsa)
 - maoy ipa da sa jquery para ma kwenta ang distance
 - then calculates total
 - lastly, show bill

 - dili sa ipakita ang total details if wala pa na locate ang location
-->

@section('scripts')
<script type="text/javascript">

$('#addressBtn').click(function(){
    var deliveryAddress = $(this).siblings('#deliveryAddress').val();
    // var deliveryAddress = $('#deliveryAddress').val();
    // console.log(deliveryAddress);

    if(deliveryAddress){
        $('.order-details-confirmation').removeAttr('hidden');
        
    }else{
        alert("Please enter a valid address");
    }

});

</script>

@endsection