@extends('layouts.hinimo')


@section('titletext')
	google api
@endsection

@section('links')
<link rel="stylesheet" href="{{asset('/leaflet/leaflet.css')}}" />
@endsection


@section('body')
<div class="single-blog-wrapper">
<br><br>

<div class="container">
    <div class="row">
        <input type="text" name="address" id="address" class="form-control" autofocus ><br><br><br>
        <!-- <textarea id="address" class="form-control"></textarea> -->
        <div id="map"></div>
    </div>
</div>

<br><br>
</div>

<style>
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
var marker = L.marker([mylat, mylong]).addTo(map);
map.on('click', function (e) {
  geocoder.reverse(e.latlng, map.options.crs.scale(map.getZoom()), function(results) {
    var r = results[0];
    if(r) {
      // console.log(r);
      $("#address").val(r.name);
    }
  });

  marker.setLatLng(e.latlng);
});
// ==================================================================================================//

var search = BootstrapGeocoder.search({
  inputTag: 'address',
  placeholder: 'ex. Cebu',
  useMapBounds: false
}).addTo(map);



// AREA NASAGIP =====================================================================================
// L.circle([mylat, mylong], 500, {
//     color: 'green',
//     fillColor: '#f2d5df',
//     fillOpacity: 0.2
// }).addTo(map).bindPopup("");
// ====================================================================================================//
 

// MORE MARKERS ========================================================================================
// markers = [{
//     "name": "Supermarket",
//     "url": "",
//     "lat": 10.292064,
//     "lng": 123.8786372
// }, {
//     "name": "Information Centre",
//     "url": "http://www.dartmoor.gov.uk/",
//     "lat": 10.3047312,
//     "lng": 123.9082488
// }];
// ========================================================================================================//

// for (var i = 0; i < markers.length; ++i) {
//     L.marker([markers[i].lat, markers[i].lng], {
//         icon: new L.DivIcon({
//             className: 'my-div-icon',
//             html: '<span class="my-map-label">' + markers[i].name + '</span>'
//         })
//     }).addTo(map);
 
//     L.marker([markers[i].lat, markers[i].lng]).addTo(map).bindPopup(markers[i].name);
// }
   

</script>

@endsection