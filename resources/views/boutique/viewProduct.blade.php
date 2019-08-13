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
            <div class="col-md-6">
              <div class="form-group">
                <h4>Product Name</h4>
                <p>{{ $product['productName'] }}</p>
              </div>

              <h4>Product Description</h4>
              <p>{{ $product['productDesc'] }}</p>

              @if($product['price'] != null && $product['rpID'] != null)
              <h4>Retail Price</h4>
              <p>₱{{ number_format($product['price']) }}</p>

              <h4>Rent Price</h4>
              <p>₱{{ number_format($product->rentDetails['price']) }}</p>
              
              @elseif($product['rpID'] != null)
              <h4>Rent Price</h4>
              <p>₱{{ number_format($product->rentDetails['price']) }}</p>

              @elseif($product['price'] != null)
              <h4>Retail Price</h4>
              <p>₱{{ number_format($product['price']) }}</p>
              @endif


              <h4>Product Category</h4>
              <p>{{ $product->getCategory['categoryName']}}<p>

              <h4>Product Status</h4>
              <p>{{ $product['productStatus'] }}</p>

              <h4>Item Availability:</h4>
              @if($product['rpID'] != null && $product['price'] != null)
              <p>Item is for RENT & for SALE.</p>
              @elseif($product['rpID'] == null && $product['price'] != null)
              <p>Item is for SALE only.</p>
              @elseif($product['rpID'] != null && $product['price'] == null)
              <p>Item is for RENT only.</p>
              @else
              <p>You have not yet set the availability for this item.</p>
              @endif

              
              <h4>Measurements:</h4>
              <?php $measurements = json_decode($product['measurements']); ?>

              @foreach($measurements as $measurement)

                  <label>{{$measurement}}</label><br>
                  <!-- <input type="text" name="{{$counter}}[{{$measurement}}]" placeholder="{{$measurement}}" class="form-control"><br> -->
              @endforeach

              <!-- <h4>Tags:</h4>
              @foreach($tags as $tag)
              <h2 data-tag-id="{{$tag['id']}}" class="tags label label-default">{{$tag->tag['name']}}</h2>
              @endforeach -->

            </div>

            <div class="col-md-5">
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
  h4{font-weight: bold;}
</style>


@endsection


@section('scripts')
<script type="text/javascript">

$('.products').addClass("active");
$('.allproducts').addClass("active");

</script>


@endsection

