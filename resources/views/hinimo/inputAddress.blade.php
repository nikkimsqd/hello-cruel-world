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
                            <a id="addressBtn" class="btn essence-btn" style="color: white;">Submit Address</a>
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
                                <li><span>Delivery Fee</span> <span>₱ 50</span></li>
                                <li><span>Total</span> <span style="color: #0315ff;">₱ {{$total}}</span></li>
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
                                    <!-- <label class="custom-control-label" for="customCheck1">Save new address</label> -->
                                </div>
                            </div>

                            <!-- <label>Delivery Address</label>
                            <input type="text" name="deliveryAddress" class="form-control" id="deliveryAddress" required> -->
                            <br><br><br><br>
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
                            $subtotal = $bid['quotationPrice'];
                            $deliveryfee = 50;
                            $total = $subtotal + $deliveryfee;
                            $adminShare = $subtotal * $percentage;
                            $boutiqueShare = $subtotal - $adminShare;
                            ?>
                            <ul class="order-details-form mb-4">
                                <li><span>Item Price</span> <span>₱{{$bid['quotationPrice']}}</span></li>
                                <!-- <li><span>Subtotal</span> <span>{{$subtotal}}</span></li> -->
                                <li><span>Delivery Fee</span> <span><i>₱{{$deliveryfee}}</i></span></li>
                                <li><span>Total</span> <span style="color: #0315ff;"><i>₱{{$total}}</i></span></li>
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
                }
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
    }



});









</script>

@endsection