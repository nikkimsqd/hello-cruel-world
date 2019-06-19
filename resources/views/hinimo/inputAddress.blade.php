@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')

<div class="single-blog-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="regular-page-content-wrapper section-padding-80">
                    <div class="regular-page-text">
                        <h2 style="text-align: center;">Input your delivery details</h2>
                            
                        <form action="{{url('makeOrderforMTO')}}" method="post">
                            {{csrf_field()}}

                        <div class="col-md-12 mb-3">
                            <label>Delivery Address</label>
                            <input type="text" name="deliveryAddress" class="form-control" id="deliveryAddress">
                            (apply api here)<br><br>
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <a id="addressBtn" class="btn essence-btn" style="color: white;">Submit Address</a>
                        </div>
                        <br><br>

                        <div class="order-details-confirmation" hidden>
                            <div class="cart-page-heading">
                                <!-- <h5>Your Made-to-Order</h5> -->
                            </div>
                            <ul class="order-details-form mb-4">
                                <li><span>MTO Price</span> <span>{{$mto['price']}}</span></li>
                                <li><span>Subtotal</span> <span>{{$mto['price']}}</span></li>
                                <li><span>Delivery Fee</span> <span><i>[delivery fee here]</i></span></li>
                                <li><span>Total</span> <span style="color: #0315ff;"><i>[total here]</i></span></li>
                            </ul>
                        <div class="col-md-12 mb-3" style="text-align: center;">
                                <input name="mtoID" value="{{$mto['id']}}" hidden>
                                <input type="text" name="subtotal" value="{{$mto['price']}}">
                                <input type="text" name="deliveryfee" value="50">
                                <input type="text" name="total" value="550">
                                <input type="submit" class="btn essence-btn" value="Place Order">
                            </form>
                        </div>
                        </div>


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
-->

@section('scripts')
<script type="text/javascript">

$('#addressBtn').click(function(){
    var deliveryAddress = $('#deliveryAddress').val();
    $('.order-details-confirmation').removeAttr('hidden');


});

</script>

@endsection