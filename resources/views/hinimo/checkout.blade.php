@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('links')
<link rel="stylesheet" href="{{asset('/leaflet/leaflet.css')}}">
@endsection


@section('body')

<div class="page">
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


<div class="checkout_area section-padding-80">
    <div class="container">

        @if(!empty($messages))
        <div class="row">
            @foreach($messages as $message)
            <!-- <span><i class="fa fa-close removeItem" aria-hidden="true" style="cursor: pointer;" data-cartitemid=""></i></span> -->
                <div class="col-md-12 warning">
                    {{$message}}
                </div>
            @endforeach
        </div>
        @endif

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
                                <input type="text" class="form-control" name="fullname" required value="{{$user['fname'].' '.$user['lname']}}">
                            </div>
                           <!--  <div class="col-12 mb-3">
                                <label for="phone_number">Phone No <span>*</span></label>
                                <input type="number" class="form-control" name="phoneNumber" maxlength="11" required>
                            </div> -->
                            <div class="col-12 mb-3">
                                <label for="selectAddress">Select Address <span>*</span></label>
                                <select name="selectAddress" id="selectAddress">
                                    <option selected disabled></option>
                                    @foreach($addresses as $address)
                                    <option value="{{$address['id']}}">{{$address['completeAddress']}}</option>
                                    @endforeach
                                    <option value="addAddress"><b>+ Add Address</b></option>
                                </select>
                            </div>

                            @foreach($addresses as $address)
                            <input type="text" id="{{$address['id']}}" data-lat="{{$address['lat']}}" data-lng="{{$address['lng']}}" hidden>
                            @endforeach

                            <div class="col-12 mb-3" id="addAddressDIV" hidden="">
                                <label for="phone_number">Phone No <span>*</span></label>
                                <input type="number" class="form-control" name="phoneNumber" maxlength="11"><br>
                                <label for="deliveryAddress">Input Address <span>*</span></label>
                                <input type="text" class="form-control mb-3" name="deliveryAddress" id="deliveryAddress" autofocus>
                                <div class="col-12 mb-3" id="map"></div>
                                <input type="text" name="lat" id="lat" hidden>
                                <input type="text" name="lng" id="lng" hidden>
                        
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="newAddress" value="newAddress">
                                    <!-- <label class="custom-control-label" for="customCheck1">Save new address</label> -->
                                </div>
                            </div>
                            

                            <!-- <div class="col-12">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                    <label class="custom-control-label" for="customCheck1">Terms and conitions</label>
                                </div>
                            </div> -->

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
                        @if($item->product != null)
                            @if(!in_array($item->product->owner, $boutiques))
                                <?php array_push($boutiques, $item->product->owner); ?>
                            @endif
                        @else
                            @if(!in_array($item->set->owner, $boutiques))
                                <?php array_push($boutiques, $item->set->owner); ?>
                            @endif
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
                        @if($item->product != null)         <!-- if product -->
                            @if($item->product->owner == $boutique)
                            <ul class="order-details-form mb-4">
                                <i class="fa fa-close removeItem" aria-hidden="true" style="cursor: pointer;" data-cartitemid="{{$item['id']}}"></i>
                                <li><span>{{$item->product['productName']}}</span> <span>₱{{number_format($item->product['price'])}}</span></li>
                                <?php 
                                    $price = $item->product['price']; 
                                    $boutiqueSubtotal += $item->product['price'];
                                ?>
                            @endif
                        @else       <!-- if set -->
                            @if($item->set->owner == $boutique)
                            <ul class="order-details-form mb-4">
                              <!-- <span cart-item-id="{{$item['id']}}" class="delete product-remove"><i class="fa fa-close" aria-hidden="true"></i></span> -->
                                <i class="fa fa-close removeItem" aria-hidden="true" style="cursor: pointer;" data-cartitemid="{{$item['id']}}"></i>
                                <li><span>{{$item->set['setName']}}</span> <span>₱{{number_format($item->set['price'])}}</span></li>
                                <?php 
                                    $price = $item->set['price']; 
                                    $boutiqueSubtotal += $item->set['price'];
                                ?>
                            @endif
                        @endif
                                <?php 
                                    // $boutiqueSubtotal += $item->product['price'];
                                ?>
                        @endforeach
                            <li style="background-color: aliceblue; border-bottom: 5px solid #ebebeb;"><span>Delivery Fee</span> 
                                <span id="order{{$boutiqueCount}}deliveryfeedisplay"></span></li><br><br>
                            <?php 
                                $merchSubtotal += $boutiqueSubtotal;
                                $deliveryfeeSubtotal += $deliveryfee;
                                $total = $boutiqueSubtotal + $deliveryfee;
                                $orderTotal = $merchSubtotal + $deliveryfeeSubtotal;
                                $adminShare = $boutiqueSubtotal * $percentage;
                                $boutiqueShare = $boutiqueSubtotal - $adminShare;
                            ?>
                        <input type="text" id="percentage" value="{{$percentage}}" hidden>
                        <input type="text" id="baseFee" value="{{$baseFee}}" hidden>
                        <input type="text" id="additionalFee" value="{{$additionalFee}}" hidden>
                        <input type="text" id="order{{$boutiqueCount}}lng" value="{{$boutique->address['lng']}}" hidden>
                        <input type="text" id="order{{$boutiqueCount}}lat" value="{{$boutique->address['lat']}}" hidden>


                        <input type="text" name="order{{$boutiqueCount}}[boutiqueID]" value="{{$boutique['id']}}" hidden>
                        <input type="text" name="order{{$boutiqueCount}}[subtotal]" id="order{{$boutiqueCount}}merchSubtotal" value="{{$merchSubtotal}}" hidden>
                        <input type="text" name="order{{$boutiqueCount}}[subtotal]" id="order{{$boutiqueCount}}boutiqueSubtotal" value="{{$boutiqueSubtotal}}" hidden>
                        <input type="text" name="order{{$boutiqueCount}}[deliveryfee]" id="order{{$boutiqueCount}}deliveryfee" value="" hidden>
                        <input type="text" name="order{{$boutiqueCount}}[total]" id="order{{$boutiqueCount}}total" value="" hidden>
                        <input type="text" name="order{{$boutiqueCount}}[boutiqueShare]" id="order{{$boutiqueCount}}boutiqueShare" value="" hidden>
                        <input type="text" name="order{{$boutiqueCount}}[adminShare]" id="order{{$boutiqueCount}}adminShare" value="" hidden>
                        <input type="text" name="boutiqueCount" value="{{$boutiqueCount}}" hidden>
                    @endforeach
                        <input type="text" id="boutiqueCount" value="{{$boutiqueCount}}" hidden>

                        <!-- <hr> -->
                        <li><span>Merchandise Subtotal</span> <span>₱{{number_format($merchSubtotal)}}</span></li>
                        <li><span>Delivery Fee Subtotal</span> <span id="deliveryfeeSubtotal"></span></li>
                        <li><span>Total</span> <span style="color: red;" id="orderTotal">₱</span></li>
                        </ul><br>

                        <input type="text" name="merchSubtotal" value="{{$merchSubtotal}}" hidden>
                        <input type="text" name="total" id="total" value="" hidden>

                        

                        <!-- <a href="#" class="btn essence-btn">Place Order</a> -->
                        <a href="{{url('shop')}}" class="btn essence-btn">Cancel</a>
                        @if(empty($messages))
                        <input type="submit" name="btn_submit" class="btn essence-btn" id="place-order" value="Place Order" disabled>
                        @else
                        <input type="submit" name="btn_submit" class="btn essence-btn" value="Place Order" disabled>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




  <!-- </div> --> <!-- row -->

</div> <!-- page -->

<style type="text/css">
    .order-details-confirmation .order-details-form li{padding: 20px 10px;}
    .nice-select{white-space: unset; min-height: 42px; height: auto;}
    .nice-select .list{z-index: 2000; white-space: nowrap;}
    .warning{padding: 5px 25px; line-height: 45px; background-color: #ff00004f;color: black; font-style: unset;border-radius: 11px;margin-bottom: 6px;font-size: 16px;}
    #map {
        width: 100%;
        height: 300px;
        background-color: grey;
    }
    .dropdown-menu li {
        padding: 3px 20px;
        margin: 0;
    }
    .dropdown-menu li:hover{
        background: #7FDFFF;
        border-color: #7FDFFF;
    }
    .dropdown-menu .geocoder-control-selected{
        background: #7FDFFF;
        border-color: #7FDFFF;
    }
    .dropdown-menu ul li {
        list-style-type: none;
    }
</style>
@endsection


@section('scripts')
<script src="{{asset('/leaflet/leaflet.js')}}"></script>
<script src="{{asset('/leaflet/bootstrap-geocoder.js')}}"></script>
<script src="{{asset('/leaflet/Control.Geocoder.js')}}"></script>

<script type="text/javascript">



$('#selectAddress').on('change', function(){

    if($(this).val() == "addAddress"){
        $('#addAddressDIV').removeAttr('hidden');
        console.log($(this).val());
        // MAPS ==================================================================================
        var mylat = '10.2892368502206';
        var mylong = '123.86207342147829';
        var myzoom = '12';


        var map = L.map('map').setView([mylat, mylong], myzoom);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 18,
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);


        var geocoder = L.Control.Geocoder.nominatim();
        if (URLSearchParams && location.search) {
          // parse /?geocoder=nominatim from URL
          var params = new URLSearchParams(location.search);
          var geocoderString = params.get('geocoder');
          if (geocoderString && L.Control.Geocoder[geocoderString]) {
            console.log('Using geocoder', geocoderString);
            geocoder = L.Control.Geocoder[geocoderString]();
          } else if (geocoderString) {
            console.warn('Unsupported geocoder', geocoderString);
          }
        }


        //SET LOCATION W/ MARKER ===========================================================================
        var marker = L.marker([0, 0]).addTo(map);
        map.on('click', function (e) {
            geocoder.reverse(e.latlng, map.options.crs.scale(map.getZoom()), function(results) {
                var r = results[0];
                if(r) {
                  // marker.setLatLng(e.latlng);
                  // console.log(r.center.lat);
                  $("#deliveryAddress").val(r.name);
                  $("#lat").val(r.center.lat);
                  $("#lng").val(r.center.lng);

                var customerLat = r.center.lat;
                var customerLng = r.center.lng;
                var counter = $("#boutiqueCount").val();
                var ipaddress = 'localhost:5000';
                var deliveryfeeSubtotal = 0;
                var total = 0;
                var percentage = $("#percentage").val();

                for(var i = 1; counter >= i; i++){
                    var boutiqueLat =  $("#order"+i+"lat").val();
                    var boutiqueLng =  $("#order"+i+"lng").val();
                    var merchSubtotal= $("#order"+i+"merchSubtotal").val();
                    var adminShare = 0;


                    $.ajax({
                        url:'http://'+ipaddress+'/route/v1/driving/'+customerLng+','+customerLat+';'+boutiqueLng+','+boutiqueLat+'?overview=false&alternatives=false&steps=true&hints=;',
                        type: "GET",
                        success:function(data){
                            var boutiqueDistance = parseFloat(data.routes[0].distance) / 1000;
                            var baseFee = $("#baseFee").val();
                            var additionalFee = $("#additionalFee").val();
                            var deliveryfee = parseInt(baseFee) + (boutiqueDistance.toFixed(1) * parseInt(additionalFee));
                            deliveryfeeSubtotal = parseInt(deliveryfeeSubtotal) + deliveryfee;
                            var boutiqueSubtotal = $("#order"+i+"boutiqueSubtotal").val();
                            total = parseInt(boutiqueSubtotal) + deliveryfee;
                            adminShare = parseInt(boutiqueSubtotal) * parseFloat(percentage);
                            boutiqueShare = parseInt(boutiqueSubtotal) - parseInt(adminShare);

                            $("#order"+i+"deliveryfee").val(parseInt(deliveryfee));
                            $("#order"+i+"total").val(total);
                            $("body #order"+i+"deliveryfeedisplay").text('₱'+parseInt(deliveryfee));
                            $("#order"+i+"adminShare").val(adminShare);
                            $("#order"+i+"boutiqueShare").val(boutiqueShare);
                        },
                        async: false
                    });
                }

                var ordertotal = parseInt(merchSubtotal) + parseInt(deliveryfeeSubtotal);
                $("#total").val(ordertotal);
                $("#orderTotal").text('₱'+(parseInt(ordertotal)));
                $("#deliveryfeeSubtotal").text('₱'+(parseInt(deliveryfeeSubtotal)));
                console.log(ordertotal);

                $('#place-order').prop('disabled',false);

                }
            });
                  marker.setLatLng(e.latlng);
console.log(customerLat);
        });
        // ==================================================================================================//

        var search = BootstrapGeocoder.search({
          inputTag: 'deliveryAddress',
          // placeholder: 'Search for places or addresses',
          useMapBounds: false
        }).addTo(map);



    }else{
        $('#addAddressDIV').attr('hidden', "hidden");
        var addressID = $(this).val();
        var customerLat = $("#"+addressID).data('lat');
        var customerLng = $("#"+addressID).data('lng');
        var counter = $("#boutiqueCount").val();
        var ipaddress = 'localhost:5000';
        var percentage = $("#percentage").val();
        var deliveryfeeSubtotal = 0;
        var total = 0;

        for(var i = 1; counter >= i; i++){
            var boutiqueLat =  $("#order"+i+"lat").val();
            var boutiqueLng =  $("#order"+i+"lng").val();
            var merchSubtotal= $("#order"+i+"merchSubtotal").val();
            var adminShare = 0;


            $.ajax({
                url:'http://'+ipaddress+'/route/v1/driving/'+customerLng+','+customerLat+';'+boutiqueLng+','+boutiqueLat+'?overview=false&alternatives=false&steps=true&hints=;',
                type: "GET",
                success:function(data){
                    var boutiqueDistance = parseFloat(data.routes[0].distance) / 1000;
                    var baseFee = $("#baseFee").val();
                    var additionalFee = $("#additionalFee").val();
                    var deliveryfee = parseInt(baseFee) + (boutiqueDistance.toFixed(1) * parseInt(additionalFee));
                    deliveryfeeSubtotal = parseInt(deliveryfeeSubtotal) + deliveryfee;
                    var boutiqueSubtotal = $("#order"+i+"boutiqueSubtotal").val();
                    total = parseInt(boutiqueSubtotal) + deliveryfee;
                    adminShare = parseInt(boutiqueSubtotal) * parseFloat(percentage);
                    boutiqueShare = parseInt(boutiqueSubtotal) - parseInt(adminShare);

                    $("#order"+i+"deliveryfee").val(parseInt(deliveryfee));
                    $("#order"+i+"total").val(total);
                    $("body #order"+i+"deliveryfeedisplay").text('₱'+parseInt(deliveryfee));
                    $("#order"+i+"adminShare").val(adminShare);
                    $("#order"+i+"boutiqueShare").val(boutiqueShare);
                },
                async: false
            });
        }

        var ordertotal = parseInt(merchSubtotal) + parseInt(deliveryfeeSubtotal);
        $("#total").val(ordertotal);
        $("#orderTotal").text('₱'+(parseInt(ordertotal)));
        $("#deliveryfeeSubtotal").text('₱'+(parseInt(deliveryfeeSubtotal)));
        console.log(ordertotal);

        $('#place-order').prop('disabled',false);

    }
});

    $('.removeItem').on('click', function(){
        var itemID = $(this).data('cartitemid');

        $.ajax({
              url: "/hinimo/public/removeItem/"+itemID,
              success:function(data){
                if(data.item){
                    // itemDiv.remove();
                    location.reload();
                }
              }
          });
    });

</script>

@endsection