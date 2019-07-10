@extends('layouts.hinimo')


@section('titletext')
	google api
@endsection



@section('body')
<div class="single-blog-wrapper">
<br><br>

<div class="container">
    <div class="row">
        <div class="col-12">
          <h2>Google Places Autocomplete InputBox Example Without Showing Map</h2></div>
        <div id="map">
            <!-- <div id="custom-search-input">
                <div class="input-group">
                    <input id="autocomplete_search" name="autocomplete_search" type="text" class="form-control" placeholder="Search" />
                    <input type="hidden" name="lat">
                    <input type="hidden" name="long">
                </div>
            </div> -->
        </div>
    </div>
</div>

<br><br>
</div>

<style>
 #map {
   width: 100%;
   height: 400px;
   background-color: grey;
 }
</style>
@endsection

@section('scripts')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBadl68dsbAsEPCJ4dKuYroBBZ70wgXFE&callback=initMap" async defer></script>

<script type="text/javascript">

var map, infoWindow;
function initMap() {
   map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 40.397, lng: 180.644},
    zoom: 1,
    minZoom: 1,
    mapTypeId: 'roadmap'
  });

  infoWindow = new google.maps.InfoWindow;


 // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      infoWindow.setPosition(pos);
      infoWindow.setContent('Location found.');
      infoWindow.open(map);
      map.setCenter(pos);
    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
  infoWindow.open(map);

  
  var marker;
  function placeMarker(location) {
    if ( marker ) {
      marker.setPosition(location);
    } else {
      marker = new google.maps.Marker({
        position: location,
        map: map
      });
    }
  }
  google.maps.event.addListener(map, 'click', function(event) {
    placeMarker(event.latLng);
    //input x ang long y ang lat
    console.log(event.latLng.lng());
    console.log(event.latLng.lat());
  });
}


//  // Initialize and add the map
// function initMap() {
//   // // The location of Uluru
//   // var uluru = {lat: -25.344, lng: 131.036};
//   // The map, centered at Uluru
//   var map = new google.maps.Map(
//       document.getElementById('map'), {zoom: 1, center: {lat: 40.397, lng: 180.644}});
//   // The marker, positioned at Uluru
//   // var marker = new google.maps.Marker({position: uluru, map: map});
// }

    // google.maps.event.addDomListener(window, 'load', initialize);
    // function initAutocomplete() {
    //     var input = document.getElementById('autocomplete_search');
    //     var autocomplete = new google.maps.places.Autocomplete(input);
        
    //     autocomplete.addListener('place_changed', function () {
    //     var place = autocomplete.getPlace();
    //     // place variable will have all the information you are looking for.
    //     $('#lat').val(place.geometry['location'].lat());
    //     $('#long').val(place.geometry['location'].lng());
    //   });
    // }

</script>

@endsection