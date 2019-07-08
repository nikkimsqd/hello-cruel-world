@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')

<div class="page">
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
                            <div class="col-md-6 mb-3">
                                <label for="first_name">First Name <span>*</span></label>
                                <input type="text" class="form-control" name="fname" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name">Last Name <span>*</span></label>
                                <input type="text" class="form-control" name="lname" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone_number">Phone No <span>*</span></label>
                                <input type="number" class="form-control" name="phoneNumber" min="0" value="">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="street_address">Address <span>*</span></label>
                                <input type="text" class="form-control mb-3" name="deliveryAddress" id="deliveryAddress" value="">
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

                    <div class="cart-page-heading">
                        <h5>Your Order</h5>
                        <p>The Details</p>
                    </div>

                    <?php 
                    $subtotal = 0;
                    $deliveryfee = 50;
                    ?>

                    <ul class="order-details-form mb-4">
                        <li><span>Product</span> <span>Total</span></li>
                        @foreach($cart->items as $item)
                        <li><span>{{$item->product['productName']}}</span> <span>₱{{$item->product['price']}}</span></li>
                        <?php 
                            $subtotal += $item->product['price'];
                            $total = $subtotal + $deliveryfee;
                            ?>
                        @endforeach
                        <li><span>Subtotal</span> <span>₱{{$subtotal}}</span></li>
                        <li><span>Delivery Fee</span> <span>₱{{$deliveryfee}}</span></li>
                        <li><span>Total</span> <span>₱{{$total}}</span></li>
                    </ul>
                            <input type="text" name="boutiqueID" value="{{$item->product->owner['id']}}" hidden>
                            <input type="text" name="subtotal" value="{{$subtotal}}" hidden>
                            <input type="text" name="deliveryfee" value="40" hidden>
                            <input type="text" name="total" value="500" hidden>

                    <!-- <div id="accordion" role="tablist" class="mb-4">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i class="fa fa-circle-o mr-3"></i>Paypal</a>
                                </h6>
                            </div>

                            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integ er bibendum sodales arcu id te mpus. Ut consectetur lacus.</p>
                                </div>
                            </div>
                        </div>
                    </div> -->

                        <!-- <a href="#" class="btn essence-btn">Place Order</a> -->
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