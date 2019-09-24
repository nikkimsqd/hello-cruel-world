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
          <h3 class="box-title">{{ $product['productName'] }}</h3>
        </div>

        <div class="box-body">
            <div class="col-md-4">
              <div class="form-group">
                <h4 class="heading">Product Name</h4>
                <h4>{{ $product['productName'] }}</h4>
              </div>

              <h4 class="heading">Product Category</h4>
              <h4>{{ $product->getCategory['categoryName']}}<h4>

              <h4 class="heading">In Stock</h4>
              <h4>{{$product['quantity']}} pcs.</h4>

              @if($product['measurementNames'] != null)
                <?php $measurementNames = json_decode($product['measurementNames']); 
                $measurements = json_decode($product['measurements']);
                ?>

                <h4 class="heading">Measurements Needed</h4>
                @foreach($measurementNames as $measurementName)
                  <label>{{$measurementName}}</label><br>
                @endforeach

                <h4 class="heading">Measurements</h4>
                @foreach($measurements as $measurement => $value)
                  <label>{{$measurement}}: {{$value}} inches</label><br>
                  <!-- <input type="text" name="{{$counter}}[{{$measurement}}]" placeholder="{{$measurement}}" class="form-control"><br> -->
                @endforeach
              @elseif($product['rtwID'] != null)
                <h4 class="heading">Available Sizes</h4>
                <ul>
                  @if($product->rtwDetails['xs'] != null)
                    <li><h4><b>XS:</b> {{$product->rtwDetails['xs']}} pcs.</h4></li>
                  @endif
                  @if($product->rtwDetails['s'] != null)
                    <li><h4><b>S:</b> {{$product->rtwDetails['s']}} pcs.</h4></li>
                  @endif
                  @if($product->rtwDetails['m'] != null)
                    <li><h4><b>M:</b> {{$product->rtwDetails['m']}} pcs.</h4></li>
                  @endif
                  @if($product->rtwDetails['l'] != null)
                    <li><h4><b>L:</b> {{$product->rtwDetails['l']}} pcs.</h4></li>
                  @endif
                  @if($product->rtwDetails['xl'] != null)
                    <li><h4><b>XL:</b> {{$product->rtwDetails['xl']}} pcs.</h4></li>
                  @endif
                  @if($product->rtwDetails['xxl'] != null)
                    <li><h4><b>XXL:</b> {{$product->rtwDetails['xxl']}} pcs.</h4></li>
                  @endif
                </ul>
              @endif
              
              <h4 class="heading">Tags:</h4>
              @foreach($tags as $tag)
              <h2 data-tag-id="{{$tag['id']}}" class="tags label label-default">{{$tag->tag['name']}}</h2>
              @endforeach

            </div>

            <div class="col-md-4">
              <h4 class="heading">Product Description</h4>
              <h4>{{ $product['productDesc'] }}</h4>

              <h4 class="heading">Product Status</h4>
              <h4>{{ $product['productStatus'] }}</h4>
            </div>
            <div class="col-md-4">
              @if($product['price'] != null && $product['rpID'] != null)
              <h4 class="heading">Retail Price</h4>
              <h4>₱{{ number_format($product['price']) }}</h4>

              <h4 class="heading">Rent Price</h4>
              <h4>₱{{ number_format($product->rentDetails['price']) }}</h4>
              
              @elseif($product['rpID'] != null)
              <h4 class="heading">Rent Price</h4>
              <h4>₱{{ number_format($product->rentDetails['price']) }}</h4>

              @elseif($product['price'] != null)
              <h4 class="heading">Retail Price</h4>
              <h4>₱{{ number_format($product['price']) }}</h4>
              @endif

              <h4 class="heading">Item Availability</h4>
              @if($product['rpID'] != null && $product['price'] != null)
              <h4>Item is for RENT & for SALE.</h4>
              @elseif($product['rpID'] == null && $product['price'] != null)
              <h4>Item is for SALE only.</h4>
              @elseif($product['rpID'] != null && $product['price'] == null)
              <h4>Item is for RENT only.</h4>
              @else
              <h4>You have not yet set the availability for this item.</h4>
              @endif
              
              <?php $counter = 1; ?>
                @foreach( $product->productFile as $image)
                 @if($counter == 1)
                  <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: auto; object-fit: cover;margin: 10px;">
                @else
                @endif
                <?php $counter++; ?>
                @endforeach
            </div>
        </div>

        <div class="box-footer" style="text-align: right;">
          <a href="/hinimo/public/products" class="btn btn-warning"><i class="fa fa-arrow-left"> Back to products</i></a>
          <a href="/hinimo/public/editView/{{$product['id']}}" class="btn btn-success"><i class="fa fa-edit"> Edit</i></a>
          <a href="/hinimo/public/delete/{{$product['id']}}" class="btn btn-danger"><i class="fa fa-trash"> Delete</i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<style type="text/css">
  .heading{font-weight: bold;}
</style>


@endsection


@section('scripts')
<script type="text/javascript">

$('.products').addClass("active");
$('.allproducts').addClass("active");

</script>


@endsection

