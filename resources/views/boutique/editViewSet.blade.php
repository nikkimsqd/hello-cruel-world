@extends('layouts.boutique')
@extends('boutique.sections')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{url('admin-dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li><a href="{{url('sets')}}">Sets</a></li>
  <li class="active">{{$page_title}}</li>
</ol>
@endsection


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
                  <textarea name="setDesc" rows="3" cols="50" class="input form-control" required>{{ $set['setDesc'] }}</textarea>
                </div>
        


                @if(count($itemtags) > 0) <!-- ilhanan if naay tags si set -->
                  <h4 class="heading">Edit Tags:</h4>
                @else
                  <h4 class="heading">Add Tags:</h4>
                @endif
                <div class="form-group tags">
                  @foreach($itemsCategoryTags as $itemsCategoryTag)
                  @if(in_array($itemsCategoryTag['id'], $selectedTags))
                    <input type="checkbox" name="tags[]" id="{{$itemsCategoryTag['tagName']}}" value="{{$itemsCategoryTag['id']}}" checked="">
                    <label for="{{$itemsCategoryTag['tagName']}}">{{$itemsCategoryTag['tagName']}}</label>
                  @else
                    <input type="checkbox" name="tags[]" id="{{$itemsCategoryTag['tagName']}}" value="{{$itemsCategoryTag['id']}}" >
                    <label for="{{$itemsCategoryTag['tagName']}}">{{$itemsCategoryTag['tagName']}}</label>
                  @endif
                  @endforeach
                </div>
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
                  <input type="number" id="retailPrice" name="retailPrice" class="input form-control" value="{{ $set['price'] }}">
                </div>

                <?php $var = 'display:none;'; ?>
                @if($set['rpID'] != null)
                <?php $var = ''; ?>
                @endif

                <!-- RENT DETAILS -->
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
                    <input type="checkbox" class="locations" name="locationsAvailable[]" value="{{$city['citymunCode']}}" id="{{$city['id']}}"> {{$city['citymunDesc']}} <br>
                              @endforeach

                  </div><br>
                </div>

              </div>
            </div>
            
            <hr>
            <!-- VIEW ITEMS ON SET -->
            @foreach( $set->items as $item)
              <div class="row">
                <div class="col-md-3">
                  
                  @foreach( $item->product->productFile as $image)
                    <img src="{{ asset('/uploads').$image['filename'] }}" class="set-image">
                  @endforeach

                </div>
                <div class="col-md-9">
                  <h4>Product Name: <b>{{$item->product['productName']}}</b></h4>
                  <h4>Product Description: <b>{{$item->product['productDesc']}}</b></h4>
                  <h4>Available Sizes: <br>
                    @if($item->product->rtwDetails['xs'] != null)
                      <h4>— <b>XS:</b> {{$item->product->rtwDetails['xs']}} pcs.</h4>
                    @endif
                    @if($item->product->rtwDetails['s'] != null)
                      <h4>— <b>S:</b> {{$item->product->rtwDetails['s']}} pcs.</h4>
                    @endif
                    @if($item->product->rtwDetails['m'] != null)
                      <h4>— <b>M:</b> {{$item->product->rtwDetails['m']}} pcs.</h4>
                    @endif
                    @if($item->product->rtwDetails['l'] != null)
                      <h4>— <b>L:</b> {{$item->product->rtwDetails['l']}} pcs.</h4>
                    @endif
                    @if($item->product->rtwDetails['xl'] != null)
                      <h4>— <b>XL:</b> {{$item->product->rtwDetails['xl']}} pcs.</h4>
                    @endif
                    @if($item->product->rtwDetails['xxl'] != null)
                      <h4>— <b>XXL:</b> {{$item->product->rtwDetails['xxl']}} pcs.</h4>
                    @endif
                  </h4>
                  
                </div>
                
              </div><br>
            @endforeach


            <div class="row">
              <div class="col-md-12">
              <h4>Select Item:</h4>
                @foreach($products as $product)
                  <div class="col-md-6 col-sm-12 col-lg-3">
                      <?php $counter = 1; ?>
                      @foreach( $product->productFile as $image)
                          @if($counter == 1)
                            @if(in_array($product['id'], $setItems))
                              <label class="product-top product-top{{$product['id']}}">
                                <input type="checkbox" name="products[]" class="product" value="{{$product['id']}}" checked>
                                <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: 100%; object-fit: cover;">
                              </label>
                            @else
                              <label class="product-top product-top{{$product['id']}}">
                                <input type="checkbox" name="products[]" class="product" value="{{$product['id']}}">
                                <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: 100%; object-fit: cover;">
                              </label>
                            @endif
                          @endif
                          <?php $counter++; ?>
                      @endforeach
                  </div>
                @endforeach
              </div>
            </div>

          </div>

          <div class="box-footer" style="text-align: right;">
            <input type="text" name="setID" value="{{ $set['id'] }}" hidden>

            <a href="{{url('sets')}}" class="btn btn-warning"><i class="fa fa-arrow-left"> Cancel</i></a>
            <!-- <a href="{{('editViewSet/'.$set['id'])}}" class="btn btn-success"><i class="fa fa-edit"> Update Product</i></a> -->
            <input type="submit" name="btn_submit" class="btn btn-success" value="Update Product">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<style type="text/css">
  .heading{font-weight: bold;}
  .set-image{
    width:100%; 
    height: auto; 
    object-fit: cover;
    border: 1px solid #e1e1e1;
  }

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

  .product-top{
    height: 400px;
    width: 100%;
    overflow: hidden;
  }

  .product[type=checkbox] { 
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
  }

  .product[type=checkbox] + img {
    cursor: pointer;
  }

  .product[type=checkbox]:checked + img {
    /*outline: 2px solid #f00;*/
    border: 6px solid #c62525;
    border-radius: 2px; 
    opacity: 0.9;
    /*transform: scale(1.1);*/
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
    $('#forRentPrice').find('input').prop('required', true); 
    $('.locations').prop('required', false); 
    // $('#forRentPrice').prop('required', true);
  } else { 
    $('#forRentPrice').find('input').prop('required', false); 
    $('#forRentPrice').hide();

  }

});


$('#forSale').on('change', function() {
    $('#forSalePrice').attr('hidden',!this.checked)

    $("#retailPrice").attr('required', this.checked);
  // }
});


</script>


@endsection

