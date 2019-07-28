@extends('layouts.boutique')
@extends('ionic.sections')

@if($order['status'] == "For Pickup")
  @section('page_title')
  {{$page_title}}
  @endsection
@elseif($order['status'] == "For Delivery")
  @section('page_title')
  To Deliver
  @endsection
@elseif($order['status'] == "Delivered")
  @section('page_title')
  Delivered
  @endsection
@elseif($order['status'] == "Completed")
  @section('page_title')
  Completed
  @endsection
@endif


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">

      @if($order['status'] == "For Pickup")
      <div class="box">
        <input type="text" name="orderID" class="orderID" value="{{$order['id']}}" hidden>

        <div class="box-header with-border">
          <h3 class="box-title"><b>From:</b> </h3>
        </div>

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <p><b>{{$order->boutique['boutiqueName']}}</b></p>
              <p><i>{{$order->boutique['contactNo']}}</i></p>
              <p><i class="fa fa-map-marker"></i>&nbsp; {{$order->boutique->address['completeAddress']}}</p>
            </div>
          </div>
        </div>
      </div>
      @endif

      <div class="box">
        <input type="text" name="orderID" class="orderID" value="{{$order['id']}}" hidden>

        @if($order['status'] == "For Pickup")
        <div class="box-header with-border">
          <h3 class="box-title"><b>To:</b></h3>
        </div>
        @endif

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <p><b>{{$order->address['contactName']}}</b></p>
              <p>{{$order->address['phoneNumber']}}</p>
              <p><i class="fa fa-map-marker"></i>&nbsp; {{$order->address['completeAddress']}}</p>
            </div>
          </div>

          @if($order['status'] != "For Pickup")
          <br>

          <div class="row">
            <div class="col-md-12">
             <!--  @if($order['cartID'] != null)
                @foreach($order->cart->items as $item)
                  <p><b>Product/s:</b></p> <p>{{$item->product['productName']}}</p> 
                @endforeach

              @elseif($order['rentID'] != null)
                {{$order->rent->product['productName']}}

              @elseif($order['mtoID'] != null)
                {{$order->mto['notes']}}

              @elseif($order['bidding'] != null)

              @endif -->

              <table class="table table-borderless">
                <tr>
                  <td>Transaction ID: {{$order['id']}}</td>
                  <td></td>
                </tr>
                <tr>
                  <td>Subtotal:</td>
                  <td class="align-right">{{$order['subtotal']}}</td>
                </tr>
                <tr>
                  <td>Delivery Fee:</td>
                  <td class="align-right">{{$order['deliveryfee']}}</td>
                </tr>
                <tr style="font-size: 17px;">
                  <td><b>Total Payment:</b></td>
                  <td class="align-right" style="color: red"><b>{{$order['total']}}</b></td>
                </tr>
                <tr>
                  <td>Status</td>
                  @if($order['status'] == "Pending")
                  <td class="align-right"><span class="label label-warning">{{$order['status']}}</span></td>

                  @elseif($order['status'] == "In-Progress")
                  <td class="align-right"><span class="label label-info">{{$order['status']}}</span></td>

                  @elseif($order['status'] == "For Pickup")
                  <td class="align-right"><span class="label bg-navy">{{$order['status']}}</span></td>

                  @elseif($order['status'] == "For Delivery")
                  <td class="align-right"><span class="label bg-olive">{{$order['status']}}</span></td>

                  @elseif($order['status'] == "On Delivery")
                  <td class="align-right"><span class="label label-maroon">{{$order['status']}}</span></td>

                  @elseif($order['status'] == "Delivered")
                  <td class="align-right"><span class="label label-success">{{$order['status']}}</span></td>

                  @elseif($order['status'] == "Completed")
                  <td class="align-right"><span class="label label-success">{{$order['status']}}</span></td>

                  @endif
                </tr>
                <tr>
                  <td>Payment Status</td>
                  <td class="align-right" style="color: red"><b>{{$order['paymentStatus']}}</b></td>
                </tr>
              </table>

            </div>
          </div>
          @endif
        </div>
      </div>
<!-- 
      @if($order['status'] == "For Delivery")
      <br> 
      <div class="box">
        <input type="text" name="orderID" class="orderID" value="{{$order['id']}}" hidden>

        <div class="box-header with-border">
          <h3 class="box-title"><b>Map Guide</b> </h3>
        </div>

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <div class="col-12 mb-3" id="map"></div>
              <input type="text" name="lat" id="lat" value="{{$order->address['lat']}}" hidden>
              <input type="text" name="lng" id="lng" value="{{$order->address['lng']}}" hidden>
              <input type="text" name="customerName" id="customerName" value="{{$order->address['contactName']}}" hidden>

              <input type="text" name="boutiqueLat" id="boutiqueLat" value="{{$order->boutique->address['lat']}}" hidden>
              <input type="text" name="boutiqueLng" id="boutiqueLng" value="{{$order->boutique->address['lng']}}" hidden>
              <input type="text" name="boutiqueName" id="boutiqueName" value="{{$order->boutique['boutiqueName']}}" hidden>

            </div>
          </div>
        </div>
      </div><br><br><br><br><br>
      @endif -->

      @if($order['status'] == "For Pickup" || $order['status'] == "For Delivery")
      <br> 
      <div class="box">
        <input type="text" name="orderID" class="orderID" value="{{$order['id']}}" hidden>

        <div class="box-header with-border">
          <h3 class="box-title"><b>Map Guide</b> </h3>
        </div>

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

<!--               <label for="deliveryAddress">Input Address <span>*</span></label>
              <input type="text" class="form-control mb-3" name="deliveryAddress" id="deliveryAddress" autofocus> -->
              <div class="col-12 mb-3" id="map"></div>
              <input type="text" name="lat" id="lat" value="{{$order->address['lat']}}" hidden>
              <input type="text" name="lng" id="lng" value="{{$order->address['lng']}}" hidden>
              <input type="text" name="customerName" id="customerName" value="{{$order->address['contactName']}}" hidden>

              <input type="text" name="boutiqueLat" id="boutiqueLat" value="{{$order->boutique->address['lat']}}" hidden>
              <input type="text" name="boutiqueLng" id="boutiqueLng" value="{{$order->boutique->address['lng']}}" hidden>
              <input type="text" name="boutiqueName" id="boutiqueName" value="{{$order->boutique['boutiqueName']}}" hidden>

            </div>
          </div>
        </div>
      </div><br><br><br><br><br>
      @endif

      <div class="box-footer">
         <a class="btn btn-warning" href="{{url('ionic-topickup')}}">Back</a>
         @if($order['status'] == "For Pickup")
         <a class="btn btn-lg btn-primary" href="{{url('ionic-pickupOrder/'.$order['id'])}}">Item Picked Up</a>
         @elseif($order['status'] == "For Delivery")
         <a class="btn btn-lg btn-success" href="{{url('ionic-deliveredOrder/'.$order['id'])}}">Delivered</a>
         @endif
        </div>

    </div>
  </div>
</section>

<style type="text/css">
  p{font-size: 16px; margin: 0 0 5px;}
  .breadcrumb{display: none;}
  .box{margin-bottom: 10px;}
  .price{color: #00c95e;}
  .btn{display: block; margin-bottom: 5px;}
  .col-md-12{position: unset;}
  .box-footer{bottom: -1px; position: fixed; width: 100%; left: 0;}
  .wrapper{position: unset;}
  .main-footer{display: none;}
  .content-wrapper{min-height: 580px !important; position: relative;}
  .align-right{text-align: right;}
  .box-footer{z-index: 5000;}
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
<link rel="stylesheet" href="{{asset('/leaflet/leaflet.css')}}">

<script src="{{asset('/leaflet/leaflet.js')}}"></script>
<script src="{{asset('/leaflet/bootstrap-geocoder.js')}}"></script>
<script src="{{asset('/leaflet/Control.Geocoder.js')}}"></script>

<script type="text/javascript">

// MAPS ==================================================================================
var mylat = $("#lat").val();
var mylng = $("#lng").val();
var customerName = $("#customerName").val();
var boutiqueLat = $("#boutiqueLat").val();
var boutiqueLng = $("#boutiqueLng").val();
var boutiqueName = $("#boutiqueName").val();
var myzoom = '12';

var map = L.map('map').setView([mylat, mylng], myzoom);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 18,
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

mapChecker = true;




//SET LOCATION W/ MARKER ===========================================================================
var customerMarker = L.marker([mylat, mylng]).addTo(map).bindPopup('To:<br/>' + customerName).openPopup();
var boutiqueMarker = L.marker([boutiqueLat, boutiqueLng]).addTo(map).bindPopup('From:<br/>' + boutiqueName).openPopup();

// var distance = getDistance(boutiqueMarker, customerMarker);
// console.log(distance);
// markers = [{
//     "name": "Supermarket",
//     "url": "",
//     "lat": boutiqueLat,
//     "lng": 
// }];

// ==================================================================================================//


</script>
@endsection