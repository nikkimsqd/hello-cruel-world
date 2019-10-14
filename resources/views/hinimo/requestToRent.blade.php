@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('links')
<link rel="stylesheet" href="{{asset('/leaflet/leaflet.css')}}">
@endsection

@section('body')

<div class="single-blog-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-7">
                <div class="regular-page-content-wrapper section-padding-80 checkout_details_area">
                    <div class="regular-page-text">
                        <h2 style="text-align: center;">Fill up details for rent</h2>
                          
                        <form action="/hinimo/public/requestToRent" method="post">
                        {{csrf_field()}}


                        <div class="col-md-12 mb-3">

                        <label >Name:</label>
                        <input type="text" name="billingName" class="form-control" value="{{$user['fname'].' '.$user['lname']}}" required><br>  

                        <label>Submit Measurements (inches)</label>
                        <a style="color: blue;" href="https://youtu.be/gIhfrADZ2ZU" target="blank">&nbsp; See guide on how to measure youself here.</a><br>

                        <div class="row justify-content-center">
                            <?php $measurements = json_decode($product['measurements']) ?>
                            <div class="col-md-11">
                            @foreach($product->getSubCategory->getCategory->getMeasurements as $measurements)
                            <label>{{$measurements['mName']}}:</label>
                                <input type="text" name="measurement[{{$measurements['mName']}}]" class="form-control" required><br> 
                            @endforeach
                            </div>
                        </div><br>

                        <label>Date Item will be used:</label>
                        <!-- <input type="date" name="dateToUse" class="form-control" required><br>  -->
                        <input type="text" name="dateToUse" id="dateToUse" class="form-control" required><br>

                        <label>Additional Notes:</label>
                        <textarea name="additionalNotes" rows="3" cols="50" class="additionalNotes input form-control" placeholder="Type here your message to the seller" required></textarea><br> 

                        <!-- <label>Address of delivery:</label>
                        <input type="text" name="addressOfDelivery" class="input form-control"><br> -->

                        <label for="selectAddress">Select Address <span>*</span></label>
                        <select name="selectAddress" id="selectAddress">
                            <option selected disabled></option>
                            @foreach($addresses as $address)
                            <option value="{{$address['id']}}">{{$address['completeAddress']}}</option>
                            @endforeach
                            <option value="addAddress"><b>+ Add Address</b></option>
                        </select><br><br><br>

                        <div id="addAddressDIV" hidden=""><br><br>
                            <label>Contact Number:</label>
                            <input type="text" name="phoneNumber" class="form-control" maxlength="11"><br>
                            <label for="deliveryAddress">Input Address <span>*</span></label>
                            <input type="text" class="form-control mb-3" name="deliveryAddress" id="deliveryAddress" autofocus>
                            <div class="col-12 mb-3" id="map"></div>
                            <input type="text" name="lat" id="lat" hidden>
                            <input type="text" name="lng" id="lng" hidden>
                    
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="newAddress" value="newAddress">
                            </div>
                        </div><br>  

                        <hr>
                        <div class="row">
                            <label class="col-md-5 col-form-label">Days item is available for rent:</label>
                            <div class="col-md-6">
                                <label class="col-form-label">{{$product->rentDetails['limitOfDays']}} days</label> 
                                <input type="text" name="limitOfDays" class="form-control" value="{{$product->rentDetails['limitOfDays']}}" hidden><br> 
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-5 col-form-label">Required Penalty Amount:</label>
                            <div class="col-md-6">
                                <label class="col-form-label">₱ {{$product->rentDetails['penaltyAmount']}}</label> 
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-5 col-form-label ">Fine incase item is lost:</label>
                            <div class="col-md-6">
                                <label class="col-form-label">₱ {{$product->rentDetails['fine']}}</label> 
                            </div>
                        </div>

                        <input type="text" name="boutiqueID" value="{{$product->owner->id}}" hidden>
                        <input type="text" id="productID" name="productID" value="{{$product['id']}}" hidden>

                        <hr>
                        <div class="row">
                            <label class="col-md-5 col-form-label">Product Rent Price:</label>
                            <div class="col-md-6">
                                <label class="col-form-label">₱ {{$product->rentDetails['price']}}</label>
                                <input type="text" name="subtotal" class="form-control" value="{{$product->rentDetails['price']}}" hidden>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-5 col-form-label">Cashban:</label>
                            <div class="col-md-6">
                                <label class="col-form-label">₱ {{$product->rentDetails['cashban']}}</label>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-5 col-form-label">Delivery Fee:</label>
                            <div class="col-md-6">
                                <label class="col-form-label">₱ 50</label>
                                <input type="text" name="deliveryfee" class="form-control" value="50" hidden>
                            </div>
                        </div>

                        <?php $total = $product->rentDetails['price'] + $product->rentDetails['cashban'] + 50; ?> <!-- replace 50 with delveryfee -->
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label">Total Payment:</label>
                            <div class="col-md-6">
                                <label class="col-form-label">₱ {{$total}}</label>
                                <input type="text" name="total" class="form-control" value="{{$total}}" hidden>
                            </div>
                        </div>

                        <!-- <input type="checkbox" id="t&c" class="" required> &nbsp;
                        <label for="t&c">I agree to Terms & Conditions</label> -->
                          

                        <?php 
                        $adminShare = $product->rentDetails['price'] * $percentage;
                        $boutiqueShare = $product->rentDetails['price'] - $adminShare;
                        ?>

                        <input type="text" name="boutiqueShare" value="{{$boutiqueShare}}" hidden>
                        <input type="text" name="adminShare" value="{{$adminShare}}" hidden>

                        <br><br>
                        <input type="submit" name="btn_submit" class="btn essence-btn" value="Place Request">

                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .nice-select{white-space: unset; min-height: 42px; height: auto;}
    .nice-select .list{white-space: nowrap;}
    .checkout_details_area form label{font-size: 13px;}
    .checkout_details_area form .form-control{border: 1px solid #b7b7b7;}
    .additionalNotes{height: 100px !important;}
    .datepicker-dropdown{top: 181px ; left: 281.5px; z-index: 11; display: block;} /*di mo take effect ang top kay walay important*/
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

    var dateToday = new Date();
    var dateTomorrow = new Date();
    var dateNextMonth = new Date();
    dateTomorrow.setDate(dateToday.getDate()+1);
    dateNextMonth.setDate(dateToday.getDate()+14);
    var productID = $("#productID").val();
    var allDates = <?php echo json_encode($datesArray); ?>;
    console.log(allDates);

    $('#dateToUse').datepicker({
        startDate: dateNextMonth,
        format: 'yyyy-mm-dd',
        datesDisabled: allDates
    });

    // $.ajax({
    //     url: "hinimo/public/getRentDates"+productID,
    //     success:function(data){
    //   data.datesArray.forEach(function(measurement){
    //   });
    //     }
    // });

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