@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')

<div class="page">
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


<!-- ##### Checkout Area Start ##### -->
<div class="checkout_area section-padding-80">
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-6">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-page-heading mb-30">
                        <h5>Billing Address</h5>
                    </div>

                    <form action="{{url('placeOrder')}}" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="fullname">Full Name <span>*</span></label>
                                <input type="text" class="form-control" name="fullname" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone_number">Phone No <span>*</span></label>
                                <input type="number" class="form-control" name="phoneNumber" min="0" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="street_address">Address <span>*</span></label>
                                <input type="text" class="form-control mb-3" name="deliveryAddress" id="deliveryAddress" value="" required>
                            </div>

                            <div class="col-12">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                    <label class="custom-control-label" for="customCheck1">Terms and conitions</label>
                                </div>
                            </div>
                                <input type="text" name="userID" value="{{$user['id']}}" hidden>
                                <input type="text" name="cartID" value="{{$cart['id']}}" hidden>
                        </div>
                    <!-- </form> -->
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                <div class="order-details-confirmation">

                    <?php 
                    $merchSubtotal = 0;
                    $deliveryfee = 50;
                    $deliveryfeeSubtotal = 0;
                    $boutiques = array();
                    $boutiqueCount = 0;
                    ?>

                    @foreach($cart->items as $item)
                        @if(!in_array($item->product->owner, $boutiques))
                            <?php array_push($boutiques, $item->product->owner); ?>
                        @endif
                    @endforeach

                    @foreach($boutiques as $boutique)
                    <?php 
                        $boutiqueCount += 1;
                        $boutiqueSubtotal = 0;
                    ?>
                        <div class="cart-page-heading">
                            <h5>{{$boutique['boutiqueName']}}</h5>
                        </div>

                        @foreach($cart->items as $item)
                        @if($item->product->owner == $boutique)
                        <ul class="order-details-form mb-4">
                            <li><span>{{$item->product['productName']}}</span> <span>₱{{$item->product['price']}}</span></li>
                            <?php 
                                $boutiqueSubtotal += $item->product['price'];
                                $merchSubtotal += $item->product['price'];
                            ?>
                        @endif
                        @endforeach
                            <li style="background-color: aliceblue; border-bottom: 5px solid #ebebeb;"><span>Delivery Fee</span> <span>₱{{$deliveryfee}}</span></li><br><br>
                            <?php 
                                $deliveryfeeSubtotal += $deliveryfee;
                                $total = $boutiqueSubtotal + $deliveryfee;
                                $orderTotal = $merchSubtotal + $deliveryfeeSubtotal;
                                $adminShare = $boutiqueSubtotal * $percentage;
                                $boutiqueShare = $boutiqueSubtotal - $adminShare;
                            ?>
                        <input type="text" name="order{{$boutiqueCount}}[boutiqueID]" value="{{$boutique['id']}}" hidden>
                        <input type="text" name="order{{$boutiqueCount}}[subtotal]" value="{{$boutiqueSubtotal}}" hidden>
                        <input type="text" name="order{{$boutiqueCount}}[deliveryfee]" value="{{$deliveryfee}}" hidden>
                        <input type="text" name="order{{$boutiqueCount}}[total]" value="{{$total}}" hidden>
                        <input type="text" name="order{{$boutiqueCount}}[boutiqueShare]" value="{{$boutiqueShare}}" hidden>
                        <input type="text" name="order{{$boutiqueCount}}[adminShare]" value="{{$adminShare}}" hidden>
                        <input type="text" name="boutiqueCount" value="{{$boutiqueCount}}" hidden>
                    @endforeach

                        <!-- <hr> -->
                        <li><span>Merchandise Subtotal</span> <span>₱{{$merchSubtotal}}</span></li>
                        <li><span>Delivery Fee Subtotal</span> <span>₱{{$deliveryfeeSubtotal}}</span></li>
                        <li><span>Total</span> <span style="color: red;">₱{{$orderTotal}}</span></li>
                    </ul><br>
                        <input type="text" name="merchSubtotal" value="{{$merchSubtotal}}" hidden>
                        <input type="text" name="deliveryfee" value="{{$deliveryfeeSubtotal}}" hidden>
                        <input type="text" name="total" value="{{$orderTotal}}" hidden>

                    

                        <!-- <a href="#" class="btn essence-btn">Place Order</a> -->
                        <a href="{{url('shop')}}" class="btn essence-btn">Cancel</a>
                        <input type="submit" name="btn_submit" class="btn essence-btn" value="Place Order">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Checkout Area End ##### -->




  </div> <!-- row -->






</div> <!-- page -->



@endsection