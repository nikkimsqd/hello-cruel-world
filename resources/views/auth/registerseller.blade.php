@extends('layouts.hinimo')

@section('titletext')
Hinimo | Register Boutique
@endsection

@section('links')
<link rel="stylesheet" href="{{asset('/leaflet/leaflet.css')}}" />
@endsection

@section('auth')
<div class="classynav" style="padding-right: 50px;">
    <ul>
        <li><a href="register-boutique">Sell on Hinimo</a></li>  
        <li><a href="login">Login</a></li>  
        <li><a href="register">Signup</a></li>
    </ul>
    
</div>

@endsection

@section('body')

<div class="single-blog-wrapper">
    <!-- Single Blog Post Thumb -->
    <div class="single-blog-post-thumb">
    <img src="{{asset('essence/img/bg-img/bg-8.jpg')}}" alt="" value="">
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="regular-page-content-wrapper section-padding-80">
                    <div class="regular-page-text">
                        <div class="cart-page-heading mb-30" style="text-align: center;"><h4>Register Your Boutique</h4></div>
                        <form method="POST" action="register-boutique" aria-label="{{ __('Register Seller') }}">
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="boutiqueName" class="col-md-4 col-form-label text-md-right">{{ __('Boutique Name') }}</label>

                                <div class="col-md-6">
                                    <input id="boutiqueName" type="text" class="form-control{{ $errors->has('boutiqueName') ? ' is-invalid' : '' }}" name="boutiqueName" value="{{ old('boutiqueName') }}" required autofocus>

                                    @if ($errors->has('boutiqueName'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('boutiqueName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contactNo" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                                <div class="col-md-6">
                                    <input id="contactNo" type="number" class="form-control" name="contactNo" maxlength="11" required>

                                    @if ($errors->has('contactNo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contactNo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-30">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <!-- <div class="cart-page-heading" style="text-align: center;"><h4>Place a marker</h4></div> -->
                            <div class="form-group row">
                                <label for="boutiqueAddress" class="col-md-4 col-form-label text-md-right">{{ __('Boutique Address') }}</label>

                                <div class="col-md-6">
                                    <input id="boutiqueAddress" type="text" class="form-control" name="boutiqueAddress" required>
                                    <span><i>Please select your location on the map.</i></span>

                                    @if ($errors->has('boutiqueAddress'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('boutiqueAddress') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div><br>
                            <div id="map"> </div>
                            <input type="text" name="lat" id="lat" hidden>
                            <input type="text" name="lng" id="lng" hidden>
                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #map {
        width: 100%;
        height: 400px;
        background-color: grey;
    }
    .pointer{
        position:absolute;
        top:86px;
        left:60px;
        z-index:99999;
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

@section('footer_menu')
<!-- Footer Menu -->
<div class="footer_menu">
    <ul>
        <li><a href="{{url('/shop')}}">Shop</a></li>
        <li><a href="{{url('/biddings')}}">Biddings</a></li>
        <li><a href="contact.html">Contact</a></li>
    </ul>
</div>
@endsection

@section('scripts')
<script src="{{asset('/leaflet/leaflet.js')}}"></script>
<script src="{{asset('/leaflet/bootstrap-geocoder.js')}}"></script>
<script src="{{asset('/leaflet/Control.Geocoder.js')}}"></script>

<script type="text/javascript">

var mylat = '10.2892368502206';
var mylng = '123.86207342147829';
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
var marker = L.marker([0, 0]).addTo(map);
map.on('click', function (e) {
  geocoder.reverse(e.latlng, map.options.crs.scale(map.getZoom()), function(results) {
    var r = results[0];
    if(r) {
      // marker.setLatLng(e.latlng);
      // console.log(r.center.lat);
      $("#boutiqueAddress").val(r.name);
      $("#lat").val(r.center.lat);
      $("#lng").val(r.center.lng);
    }
  });
      marker.setLatLng(e.latlng);

});
// ==================================================================================================//

var search = BootstrapGeocoder.search({
  inputTag: 'boutiqueAddress',
  // placeholder: 'Search for places or addresses',
  useMapBounds: false
}).addTo(map);


</script>

@endsection