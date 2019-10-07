@extends('layouts.hinimo')
@extends('hinimo.sections')

@section('links')
<link rel="stylesheet" href="{{asset('/leaflet/leaflet.css')}}" />
@endsection

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
<div class="checkout_area section-padding-70">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="checkout_details_area mt-50 clearfix">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-7 cart-page-heading mb-30">
                                    <h3>Account Details</h3>
                                </div>

                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#editProfile"><u>Edit Details</u></a>
                                </div>
                            </div>
                            <br>

                            <!-- <form action="" method=""> -->
                                <div class="row">
                                    <div class="col-md-9 mb-3">
                                        <label for="first_name">Name</label>
                                        <input type="text" class="form-control" id="first_name" value="{{$user['fname'].' '.$user['lname']}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9 mb-3">
                                        <label for="first_name">Username</label>
                                        <input type="text" class="form-control" id="first_name" value="{{$user['username']}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9 mb-3">
                                        <label for="first_name">Email</label>
                                        <input type="text" class="form-control" id="first_name" value="{{$user['email']}}" disabled>
                                    </div>
                                </div>
                                <!-- <input type="submit" name="btn_submit" value=""> -->
                            <!-- </form> -->
                        </div>

                        <div class="col-md-3">
                            <div class="order-details-confirmation"> <!-- card opening -->

                                <ul class="order-details-form mb-4">
                                    <li><a href="" data-toggle="modal" data-target="#notificationsModal">View Notifications</a>
                                        @if(count($notifications) > 0)
                                        <span>{{$notificationsCount}}</span>
                                        @endif
                                    </li>
                                    <li><a href="{{url('/user-transactions')}}">View Transactions</a></li>
                                    <li><a href="{{url('/gallery')}}">View Gallery</a></li>
                                </ul>
                            </div> <!-- card closing -->
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- first row -->

        <br><br>
        <div class="row" id="addresses">
            <div class="col-12 col-md-11">
                <div class="mt-50 clearfix">
                    <div class="row">
                        <div class="col-md-7 cart-page-heading mb-30">
                            <h3>Addresses</h3>
                        </div>
                        <div class="col-md-3 justify-content-right">
                            <a href="" data-toggle="modal" data-target="#addAddress"><u>+ New Address</u></a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            
                        @if(count($addresses) > 0)
                        @foreach($addresses as $address)
                        <hr>
                        <table class="">
                            <tr>
                                <td width="15%"><label>Name</label></td>
                                <td width="70%"><b>{{$address['contactName']}}</b><br></td>
                                <td width="20%" rowspan="2" width="20%" align="right">
                                    <br>
                                    <a href="" data-toggle="modal" data-target="#editAddress{{$address['id']}}" class="btn btn-app">
                                        <i class="fa fa-edit"> 
                                        </i>
                                    </a>
                                    <a href="" class="btn btn-app">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    <br>
                                    @if($address['status'] == "Not Default")
                                    <a href="{{url('setAsDefault/'.$address['id'])}}">Set as Default</a>
                                    @endif
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td width="15%"><label>Phone</label></td>
                                <td width="70%">{{$address['phoneNumber']}}<br></td>
                            </tr>
                            <tr>
                                <td width="15%"><label>Address</label></td>
                                <td width="70%">
                                    {{$address['completeAddress']}}<br>
                                </td>
                            </tr>
                            
                        </table>
                        <br>
                        @endforeach
                        @else
                        <p>You have no registered addresses.</p>
                        @endif
                        <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Checkout Area End ##### -->


<!-- MODALSSSSS ----------------------------- -->
<div class="modal fade" id="editProfile" role="dialog">
    <div class="modal-dialog modal-md">
      <!-- Modal content-->
      <div class="modal-content checkout_details_area">
          <div class="modal-header">
            <h3 class="modal-title"><b>Edit Profile</b></h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <form action="{{url('editProfile')}}" method="post">
                {{csrf_field()}}
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="fname" value="{{$user['fname']}}"><br>

            <label for="first_name">Last Name</label>
            <input type="text" class="form-control" name="lname" value="{{$user['lname']}}"><br>

            <label for="first_name">Username</label>
            <input type="text" class="form-control" name="username" value="{{$user['username']}}"><br>

            <label for="first_name">Email</label>
            <input type="text" class="form-control" name="email" value="{{$user['email']}}"><br>
          </div>

          <div class="modal-footer">
            <input type="submit" class="btn essence-btn" value="Update">
            </form>
          </div>
      </div> 
    </div>
</div>


<div class="modal fade" id="addAddress" role="dialog">


    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><b>Add Address</b></h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <div class="modal-body">
            <form action="{{url('addAddress')}}" method="post">
                {{csrf_field()}}
                <label>Name:</label>
                <input type="text" name="contactName" class="form-control"><br>

                <label>Phone Number:</label>
                <input type="number" name="phoneNumber" class="form-control" maxlength="11"><br>

                <label>Complete Address</label><br>
                <input type="text" id="completeAddress" name="completeAddress" class="form-control">

                <div id="map"></div>  
                <input type="text" name="lat" id="lat">
                <input type="text" name="lng" id="lng">
        </div> <!-- modal-body -->

                <div class="modal-footer">
                  <input type="submit" name="btn_submit" value="Submit" class="btn btn-success">
                </div>
            </form>
    </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal-fade -->

@if(count($addresses) > 0)
<div class="modal fade" id="editAddress{{$address['id']}}" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><b>Edit Address</b></h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <div class="modal-body">
            <form action="/hinimo/public/addAddress" method="post">
                {{csrf_field()}}
                <label>Name:</label>
                <input type="text" name="contactName" class="form-control" value="{{$address['contactName']}}"><br>

                <label>Phone Number:</label>
                <input type="number" name="phoneNumber" class="form-control" maxlength="11" value="{{$address['phoneNumber']}}"><br>

                <label>Complete Address</label><br>
                <input type="text" id="completeAddress" name="completeAddress" class="form-control" value="{{$address['completeAddress']}}">

                <div id="map"></div>  
                <input type="text" name="lat" id="lat" value="{{$address['lat']}}">
                <input type="text" name="lng" id="lng" value="{{$address['lng']}}">      
        </div> <!-- modal-body -->

                <div class="modal-footer">
                  <input type="submit" name="btn_submit" value="Submit" class="btn btn-success">
                </div>
            </form>
    </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal-fade -->
@endif

<div class="modal fade" id="notificationsModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title"><b>Notifications</b></h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered">
                    @if(count($notifications) > 0)
                    @foreach($notifications as $notification)
                    @if($notification->read_at != null)
                    <tr>
                        <td>
                            <a href="{{ url('user-notifications/'.$notification->id) }}">{{$notification->data['text']}}</a> 
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td style="background-color: #e6f2ff;">
                            <a href="{{ url('user-notifications/'.$notification->id) }}">{{$notification->data['text']}}</a> 
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    @else
                    <tr><i>You have no notifications.</i></tr>
                    @endif
                </table>
            </div>

            <div class="modal-footer">
              <!-- <input type="submit" class="btn essence-btn" value="Place Request"> -->
              <input type="submit" class="btn essence-btn" data-dismiss="modal" value="Close">
            </div>
        </div> 
    </div>
</div>

<div class="modal fade" id="submitPayPalEmailModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title"><b>Submit PayPal Emsil</b></h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                
            </div>

            <div class="modal-footer">
              <!-- <input type="submit" class="btn essence-btn" value="Place Request"> -->
              <input type="submit" class="btn essence-btn" data-dismiss="modal" value="Close">
            </div>
        </div> 
    </div>
</div>

</div> <!-- page -->

<style type="text/css">
    /*.modal-body{max-height: 300px; overflow-y: scroll;}*/
    .nice-select .list{width: inherit; max-height: 250px; overflow-y: scroll;}
    span{color: #0315ff;}
    a{color: #000;}
    label{font-size: 12px; text-transform: uppercase; font-weight: 600;}
 #map {
   width: 100%;
   height: 500px;
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

// if($('#completeAddress').val() != null){
//     console.log("adsdsd");
//     var mylat = $('#lat').val();
//     var mylng = $('#lng').val();
// }else{
    var mylat = '10.2892368502206';
    var mylng = '123.86207342147829';
// }

var myzoom = '12';


var map = L.map('map').setView([mylat, mylng], myzoom);
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
var marker = L.marker([mylat, mylng]).addTo(map);
map.on('click', function (e) {
  geocoder.reverse(e.latlng, map.options.crs.scale(map.getZoom()), function(results) {
    var r = results[0];
    if(r) {
      // console.log(r.center);
      $("#completeAddress").val(r.name);
      $("#lat").val(r.center.lat);
      $("#lng").val(r.center.lng);
    }
  });

  marker.setLatLng(e.latlng);
});
// ==================================================================================================//

var search = BootstrapGeocoder.search({
  inputTag: 'completeAddress',
  useMapBounds: false
}).addTo(map);

</script>

@endsection