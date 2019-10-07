@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')
  <?php 
      $counter = 1;
  ?>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">{{ $set['setName'] }}</h3>
        </div>

        <form action="{{url('editSet')}}" method="post">
        {{csrf_field()}}
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <h4 class="heading">Set Name</h4>
                  <input type="text" name="setName" class="input form-control" value="{{ $set['setName'] }}" required>
                </div>

                <div class="form-group">
                  <h4 class="heading">Product Description</h4>
                  <textarea name="productDesc" rows="3" cols="50" class="input form-control" required>{{ $set['setDesc'] }}</textarea>
                </div>
        
                <!-- <h4>Add Tags:</h4>
                <div class="form-group tags">
                   @foreach($tags as $tag)
                   <input type="checkbox" name="tags[]" id="{{$tag['name']}}" value="{{$tag['id']}}">
                   <label for="{{$tag['name']}}">{{$tag['name']}}</label>
                   @endforeach
                </div> -->


                @if(count($itemtags) > 0)
                  <label>Edit Tags:</label>
                  <div class="form-group tags">
                    @foreach($tags as $tag)
                    @if(in_array($tag['id'], $selectedTags))
                      <input type="checkbox" name="tags[]" id="{{$tag['tagName']}}" value="{{$tag['id']}}" checked="">
                      <label for="{{$tag['tagName']}}">{{$tag['tagName']}}</label>
                    @else
                      <input type="checkbox" name="tags[]" id="{{$tag['tagName']}}" value="{{$tag['id']}}" >
                      <label for="{{$tag['tagName']}}">{{$tag['tagName']}}</label>
                    @endif
                    @endforeach


                    </div>
                @else
                  <h4>Add Tags:</h4>
                  <div class="form-group tags" id="tags">

                    @foreach($set->items as $items)
                      @foreach($items as $item)
                        {{$item['productName']}}aa
                      @endforeach
                    @endforeach

                  </div>
                @endif

              </div>

              <div class="col-md-6">
                
                <div class="form-group">
                  <h4 class="heading">In-Stock:</h4>
                  <input type="number" name="quantity" id="quantity" class="input form-control" value="{{$set['quantity']}}" required>
                </div>

                <div class="form-group">
                  <h4 class="heading">Product Status</h4>
                  @if($set['setStatus'] == "Available")
                    <input type="radio" id="available" name="productStatus" value="Available" checked> <label for="available"> Available</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" id="nAvailable" name="productStatus" value="Not Available"> <label for="nAvailable"> Not Available</label>
                  @else
                    <input type="radio" id="available" name="productStatus" value="Available"> <label for="available"> Available</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" id="nAvailable" name="productStatus" value="Not Available" checked> <label for="nAvailable"> Not Available</label>
                  @endif
                </div>

                <div class="form-group">
                  <h4>Product Availability</h4>
                  @if($set['rpID'] != null && $set['price'] != null)
                    <input type="checkbox" id="forRent" name="forRent" value="true" checked> <label for="forRent"> For Rent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="forSale" name="forSale" value="true" checked> <label for="forSale">For Sale</label>

                  @elseif($set['rpID'] != null)
                    <input type="checkbox" id="forRent" name="forRent" value="true" checked> <label for="forRent">For Rent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="forSale" name="forSale" value="true"> <label for="forSale">For Sale</label>

                  @elseif($set['price'] != null)
                    <input type="checkbox" id="forRent" name="forRent" value="true"> <label for="forRent">For Rent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="forSale" name="forSale" value="true" checked> <label for="forSale">For Sale</label>

                  @else
                    <input type="checkbox" id="forRent" name="forRent" value="true"> <label for="forRent">For Rent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="forSale" name="forSale" value="true"> <label for="forSale">For Sale</label>
                  @endif
                </div>
              
                <?php $var = 'display:none;'; ?>
                @if($set['price'] != null)
                <?php $var = ''; ?>
                @endif

                <div class="form-group" id="forSalePrice" style="{{$var}}">
                  <label>Retail Price</label>
                  <input type="number" name="productPrice" class="input form-control" value="{{ $set['price'] }}">
                </div>

                <?php $var = 'display:none;'; ?>
                @if($set['rpID'] != null)
                <?php $var = ''; ?>
                @endif

                <div class="form-group" id="forRentPrice" style="{{$var}}">
                  <label>Rent Price</label>
                  <input type="number" name="rentPrice" value="{{$set->rentDetails['price']}}" class="input form-control"><br>

                  <label>Deposit Amount</label>
                  <input type="number" name="depositAmount" class="input form-control" value="{{$set->rentDetails['depositAmount']}}"><br>

                  <label>Penalty Amount if item is returned late (per day)</label>
                  <input type="number" name="penaltyAmount" class="input form-control" value="{{$set->rentDetails['penaltyAmount']}}"><br>

                  <label>Duration of days item is available for rent</label>
                  <input type="number" name="limitOfDays" class="input form-control" value="{{$set->rentDetails['limitOfDays']}}"><br>

                  <label>Amount of fine incase item is lost by user</label>
                  <input type="number" name="fine" class="input form-control" value="{{$set->rentDetails['fine']}}"><br>

                  <label>Locations item is available for rent</label><br>

                    <?php $locs = json_decode($set->rentDetails['locationsAvailable']); ?>
                  <label id="city-id" hidden>Select Cities:</label>
                  <div name="cities" id="city-select" style="column-count: 3">
                    @foreach($cities as $city)
                    <input type="checkbox" name="locationsAvailable[]" value="{{$city['citymunCode']}}" id="{{$city['id']}}"> {{$city['citymunDesc']}} <br>
                              @endforeach

                  </div><br>

                  <!-- <label>Select City:</label>
                  <select name="locationsAvailable" class="form-control" id="city-select"  value="{{$set->rentDetails['price']}}">
                  </select><br> -->
                </div>




              </div>
            </div>
            
            <hr>
            <div class="row">
              @foreach( $set->items as $item)
              <div class="col-md-6">
                <h4>Product Name: {{$item->product['productName']}}</h4>
                
                @foreach( $item->product->productFile as $image)
                    <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: 400px; object-fit: cover;">
                @endforeach

              </div>
              @endforeach
              
            </div>
          </div>

          <div class="box-footer" style="text-align: right;">
            <a href="{{url('sets')}}" class="btn btn-warning"><i class="fa fa-arrow-left"> Cancel</i></a>
            <a href="{{('editViewSet/'.$set['id'])}}" class="btn btn-success"><i class="fa fa-edit"> Update Product</i></a>
            <input type="submit" name="btn_submit" class="btn btn-success" value="Update Product">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<style type="text/css">
  .heading{font-weight: bold;}
  /*h4{font-weight: bold;}*/

  .tags label {
    display: inline-block;
    width: auto;
    padding: 10px;
    border: solid 1px #ccc;
    transition: all 0.3s;
    background-color: #e3e2e2;
    border-radius: 5px;
  }

  .tags input[type="checkbox"] {
    display: none;
  }

  .tags input[type="checkbox"]:checked + label {
    border: solid 1px #e7e7e7;
    background-color: #ef1717;
    color: #fff;
  }
</style>


@endsection


@section('scripts')
<script type="text/javascript">

$('.products').addClass("active");
$('.allsets').addClass("active");


$('#forRent').change(function() {

  if($('#forRent').is(':checked')) {
    $('#forRentPrice').show();
    $('#forRentPrice').prop('required', true);
  } else { 
    $('#forRentPrice').find('input').prop('required', false); 
    $('#forRentPrice').hide();

  }

});


</script>


@endsection

