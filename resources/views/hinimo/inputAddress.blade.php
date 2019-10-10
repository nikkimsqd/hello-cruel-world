 @extends('layouts.hinimo')
@extends('hinimo.sections')


@section('links')
<link rel="stylesheet" href="{{asset('/leaflet/leaflet.css')}}">
@endsection

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

                            <label for="selectAddress">Select Address <span>*</span></label>
                            <select name="selectAddress" id="selectAddress">
                                <option selected disabled></option>
                                @foreach($addresses as $address)
                                <option value="{{$address['id']}}">{{$address['completeAddress']}}</option>
                                @endforeach
                                <option value="addAddress"><b>+ Add Address</b></option>
                            </select><br><br>

                            @foreach($addresses as $address)
                            <input type="text" id="{{$address['id']}}" data-lat="{{$address['lat']}}" data-lng="{{$address['lng']}}" hidden>
                            @endforeach

                            <div id="addAddressDIV" hidden=""><br><br>

                                <label>Contact Number <span>*</span></label>
                                <input type="text" name="phoneNumber" class="form-control" maxlength="11"><br>
                                <label for="deliveryAddress">Input Address <span>*</span></label>
                                <input type="text" class="form-control mb-3" name="deliveryAddress" id="deliveryAddress" autofocus>
                                <div class="col-12 mb-3" id="map"></div>
                                <input type="text" name="lat" id="lat" hidden>
                                <input type="text" name="lng" id="lng" hidden>
                        
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="newAddress" value="newAddress">
                                </div>
                            </div>


                          
                            <a class="clearfix" href="{{url('view-mto/'.$mto['id'].'#mto-details')}}" class="btn essence-btn" style="color: white;">Cancel</a>
                            <!-- <a id="addressBtn" class="btn essence-btn" style="color: white;">Submit Address</a> -->
                        </div>
                        
                        <div class="col-md-12 mb-3 clearfix">
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
                                <li><span>Made-to-order item</span> <span>₱ {{$mtoPrice}}</span></li>
                                <!-- <li><span>Subtotal</span> <span>{{$mtoPrice}}</span></li> -->
                                <li><span>Delivery Fee</span> <span id="deliveryfeeDisplay"></span></li>
                                <li><span>Total</span> <span style="color: #0315ff;" id="totalDisplay"></span></li>
                            </ul>
                            <div class="col-md-12 mb-3" style="text-align: center;">
                                <input name="mtoID" value="{{$mto['id']}}" hidden>
                                <input id="boutiqueLat" value="{{$mto->boutique->address['lat']}}" hidden>
                                <input id="boutiqueLng" value="{{$mto->boutique->address['lng']}}" hidden>
                                <input id="percentage" value="{{$percentage}}" hidden>
                                <input type="text" id="baseFee" value="{{$baseFee}}" hidden>
                                <input type="text" id="additionalFee" value="{{$additionalFee}}" hidden>
                                <input type="text" name="adminShare" id="adminShare" value="" hidden>
                                <input type="text" name="boutiqueShare" id="boutiqueShare" value="" hidden>

                                <input type="text" name="subtotal" id="subtotal" value="{{$mtoPrice}}" hidden>
                                <input type="text" name="deliveryfee" id="deliveryfee" value="" hidden>
                                <input type="text" name="total" id="total" value="" hidden>
                                <a href="{{url('view-mto/'.$mto['id'])}}" class="btn essence-btn">Cancel</a>
                                <input type="submit" class="btn essence-btn" value="Place Order">

                            </div>
                        </div>
                        </form>

    <!-- -------------- BIDDING --------------------------------------------------------------------------- -->
                        @elseif($bid != null)
                        <form action="{{url('makeOrderforBidding')}}" method="post">
                            {{csrf_field()}}

                        <div class="col-md-12 mb-3">
                            <label>Name <span>*</span></label>
                            <input type="text" name="billingName" class="form-control" required value="{{$user['fname']. ' '.$user['lname']}}"><br>


                            <label for="selectAddress">Select Address <span>*</span></label>
                            <select name="selectAddress" id="selectAddress">
                                <option selected disabled></option>
                                @foreach($addresses as $address)
                                <option value="{{$address['id']}}">{{$address['completeAddress']}}</option>
                                @endforeach
                                <option value="addAddress"><b>+ Add Address</b></option>
                            </select><br><br>

                            @foreach($addresses as $address)
                            <input type="text" id="{{$address['id']}}" data-lat="{{$address['lat']}}" data-lng="{{$address['lng']}}" hidden>
                            @endforeach

                            <div id="addAddressDIV" hidden=""><br><br>
                                <label>Contact Number <span>*</span></label>
                                <input type="text" name="phoneNumber" class="form-control" maxlength="11"><br>
                                <label for="deliveryAddress">Input Address <span>*</span></label>
                                <input type="text" class="form-control mb-3" name="deliveryAddress" id="deliveryAddress" autofocus>
                                <div class="col-12 mb-3" id="map"></div>
                                <input type="text" name="lat" id="lat" hidden>
                                <input type="text" name="lng" id="lng" hidden>
                            </div>

                            <!-- <label>Delivery Address</label>
                            <input type="text" name="deliveryAddress" class="form-control" id="deliveryAddress" required> -->
                            <br><br>
                            <!-- <a id="addressBtn" class="btn essence-btn" style="color: white;">Submit Address</a> -->
                            <a href="{{url('view-bidding/'.$bid->bidding['id'])}}" id="cancel-btn" class="btn essence-btn">Cancel</a>
                        </div>
                    
                        <br><br>

                        <div class="order-details-confirmation" hidden>
                            <div class="cart-page-heading">
                                <!-- <h5>Your Made-to-Order</h5> -->
                            </div>
                            <?php 
                            ?>
                            <ul class="order-details-form mb-4">
                                <li><span>Item Price</span> <span>₱{{$bid['quotationPrice']}}</span></li>
                                <li><span>Delivery Fee</span> <span id="deliveryfeeDisplay"><i></i></span></li>
                                <li><span>Total</span> <span style="color: #0315ff;" id="totalDisplay"><i></i></span></li>
                            </ul>
                            <div class="col-md-12 mb-3" style="text-align: center;">
                                <input id="boutiqueLat" value="{{$bid->owner->address['lat']}}" hidden>
                                <input id="boutiqueLng" value="{{$bid->owner->address['lng']}}" hidden>
                                <input id="percentage" value="{{$percentage}}" hidden>
                                <input type="text" id="baseFee" value="{{$baseFee}}" hidden>
                                <input type="text" id="additionalFee" value="{{$additionalFee}}" hidden>
                                <input name="bidID" value="{{$bid['id']}}" hidden>
                                <!-- <input name="biddingID" value="{{$bid->bidding['id']}}" > -->
                                <input type="text" name="adminShare" id="adminShare" value="" hidden>
                                <input type="text" name="boutiqueShare" id="boutiqueShare" value="" hidden>
                                <input type="text" name="subtotal" id="subtotal" value="{{$bid['quotationPrice']}}" hidden>
                                <input type="text" name="deliveryfee" id="deliveryfee" value="" hidden>
                                <input type="text" name="total" id="total" value="" hidden>
                                <a href="{{url('view-bidding/'.$bid->bidding['id'])}}" class="btn essence-btn">Cancel</a>
                                <input type="submit" class="btn essence-btn" value="Place Order">
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

<style type="text/css">
    .nice-select{white-space: unset; min-height: 42px; height: auto;}
    .nice-select .list{white-space: nowrap;}
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

<!-- THE PLAN 
 - i'api ang address then get the value(longlat or unsa)
 - maoy ipa da sa jquery para ma kwenta ang distance
 - then calculates total
 - lastly, show bill

 - dili sa ipakita ang total details if wala pa na locate ang location
-->

@section('scripts')
<script src="{{asset('/leaflet/leaflet.js')}}"></script>
<script src="{{asset('/leaflet/bootstrap-geocoder.js')}}"></script>
<script src="{{asset('/leaflet/Control.Geocoder.js')}}"></script>

<script type="text/javascript">

    var mapChecker = false;

$('#addressBtn').click(function(){
    var deliveryfee;
    var selectAddress = $('#selectAddress').val();
    var deliveryAddress = $('#deliveryAddress').val();
    var lat = $("#lat").val();
    var lng = $("#lng").val();
    // console.log(deliveryAddress);

    if(selectAddress){
        if(selectAddress == "addAddress"){
            deliveryAddress = $("#deliveryAddress").val();
            // console.log(deliveryAddress);
            $('.order-details-confirmation').removeAttr('hidden');
        }else{
            deliveryAddress = selectAddress;
            console.log(deliveryAddress);
            $('.order-details-confirmation').removeAttr('hidden');
        }
    }else{
        alert("Please enter a valid address");
    }
});

$('#selectAddress').on('change', function(){

    if($(this).val() == "addAddress"){
        $('#addAddressDIV').removeAttr('hidden');
        $('.order-details-confirmation').attr('hidden', "hidden");
        // console.log($(this).val());


        if(!mapChecker){
            // MAPS ==================================================================================
            var mylat = '10.2892368502206';
            var mylong = '123.86207342147829';
            var myzoom = '12';


            var map = L.map('map').setView([mylat, mylong], myzoom);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              maxZoom: 18,
              attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            mapChecker = true;


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
            var marker = L.marker([0,0]).addTo(map);
            map.on('click', function (e) {
              geocoder.reverse(e.latlng, map.options.crs.scale(map.getZoom()), function(results) {
                var r = results[0];
                if(r) {
                  // marker.setLatLng(e.latlng);
                  $("#deliveryAddress").val(r.name);
                  $("#lat").val(r.center.lat);
                  $("#lng").val(r.center.lng);

                $('#cancel-btn').attr('hidden', 'hidden');
                $('.order-details-confirmation').removeAttr('hidden');

                var customerLat = r.center.lat;
                var customerLng = r.center.lng;
                var ipaddress = 'localhost:5000';
                var percentage = $("#percentage").val();
                var total = 0;

                var boutiqueLat =  $("#boutiqueLat").val();
                var boutiqueLng =  $("#boutiqueLng").val();
                var adminShare = 0;
                var subtotal = $("#subtotal").val();


                $.ajax({
                    url:'http://'+ipaddress+'/route/v1/driving/'+customerLng+','+customerLat+';'+boutiqueLng+','+boutiqueLat+'?overview=false&alternatives=false&steps=true&hints=;',
                    type: "GET",
                    success:function(data){
                        var boutiqueDistance = parseFloat(data.routes[0].distance) / 1000;
                        var baseFee = parseInt($("#baseFee").val());
                        var additionalFee = parseInt($("#additionalFee").val());
                        var deliveryfee = baseFee + (boutiqueDistance.toFixed(1) * additionalFee);
                        console.log(deliveryfee);
                        total = parseInt(subtotal) + parseInt(deliveryfee);
                        adminShare = parseInt(subtotal) * parseFloat(percentage);
                        boutiqueShare = parseInt(subtotal) - parseInt(adminShare);

                        $("#adminShare").val(adminShare);
                        $("#boutiqueShare").val(boutiqueShare);
                        $("#deliveryfee").val(parseInt(deliveryfee));
                        $("#total").val(total);
                        $("#deliveryfeeDisplay").text('₱'+parseInt(deliveryfee));
                        $("#totalDisplay").text('₱'+total);
                    },
                    async: false
                });

                } //if closing
              });
                  marker.setLatLng(e.latlng);

            });
            // ==================================================================================================//

            var search = BootstrapGeocoder.search({
              inputTag: 'deliveryAddress',
              // placeholder: 'Search for places or addresses',
              useMapBounds: false
            }).addTo(map);
        }

    }else{
        $('#addAddressDIV').attr('hidden', "hidden");
        $('.order-details-confirmation').removeAttr('hidden');
        $('#cancel-btn').attr('hidden', 'hidden');

        var addressID = $(this).val();
        var customerLat = $("#"+addressID).data('lat');
        var customerLng = $("#"+addressID).data('lng');
        var ipaddress = 'localhost:5000';
        var percentage = $("#percentage").val();
        var total = 0;

        var boutiqueLat =  $("#boutiqueLat").val();
        var boutiqueLng =  $("#boutiqueLng").val();
        var adminShare = 0;
        var subtotal = $("#subtotal").val();


        $.ajax({
            url:'http://'+ipaddress+'/route/v1/driving/'+customerLng+','+customerLat+';'+boutiqueLng+','+boutiqueLat+'?overview=false&alternatives=false&steps=true&hints=;',
            type: "GET",
            success:function(data){
                var boutiqueDistance = parseFloat(data.routes[0].distance) / 1000;
                var baseFee = parseInt($("#baseFee").val());
                var additionalFee = parseInt($("#additionalFee").val());
                var deliveryfee = baseFee + (boutiqueDistance.toFixed(1) * additionalFee);
                console.log(deliveryfee);
                total = parseInt(subtotal) + parseInt(deliveryfee);
                adminShare = parseInt(subtotal) * parseFloat(percentage);
                boutiqueShare = parseInt(subtotal) - parseInt(adminShare);

                $("#adminShare").val(adminShare);
                $("#boutiqueShare").val(boutiqueShare);
                $("#deliveryfee").val(parseInt(deliveryfee));
                $("#total").val(total);
                $("#deliveryfeeDisplay").text('₱'+parseInt(deliveryfee));
                $("#totalDisplay").text('₱'+total);

            },
            async: false
        });
    }



});









</script>

@endsection