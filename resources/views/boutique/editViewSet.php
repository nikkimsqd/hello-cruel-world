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

        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <h4 class="heading">Set Name</h4>
                <p>{{ $set['setName'] }}</p>
              </div>

              <h4 class="heading">Set Description</h4>
              <p>{{ $set['setDesc'] }}</p>

              @if($set['price'] != null && $set['rpID'] != null)
              <h4 class="heading">Retail Price</h4>
              <p>₱{{ number_format($set['price']) }}</p>

              <h4 class="heading">Rent Price</h4>
              <p>₱{{ number_format($set->rentDetails['price']) }}</p>
              
              @elseif($set['rpID'] != null)
              <h4 class="heading">Rent Price</h4>
              <p>₱{{ number_format($set->rentDetails['price']) }}</p>

              @elseif($set['price'] != null)
              <h4 class="heading">Retail Price</h4>
              <p>₱{{ number_format($set['price']) }}</p>

              @endif
            </div>

            <div class="col-md-6">
              <h4 class="heading">Quantity</h4>
              <p>{{ $set['quantity'] }}</p>

              <h4 class="heading">Set Status</h4>
              <p>{{ $set['setStatus'] }}</p>

              <h4 class="heading">Item Availability:</h4>
              @if($set['rpID'] != null && $set['price'] != null)
              <p>Item is for RENT & for SALE.</p>
              @elseif($set['rpID'] == null && $set['price'] != null)
              <p>Item is for SALE only.</p>
              @elseif($set['rpID'] != null && $set['price'] == null)
              <p>Item is for RENT only.</p>
              @else
              <p>You have not yet set the availability for this item.</p>
              @endif
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
          <a href="/hinimo/public/sets" class="btn btn-warning"><i class="fa fa-arrow-left"> Back to products</i></a>
          <a href="/hinimo/public/editViewSet/{{$set['id']}}" class="btn btn-success"><i class="fa fa-edit"> Edit</i></a>
          <a href="/hinimo/public/deleteSet/{{$set['id']}}" class="btn btn-danger"><i class="fa fa-trash"> Delete</i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<style type="text/css">
  .heading{font-weight: bold;}
  /*h4{font-weight: bold;}*/
</style>


@endsection


@section('scripts')
<script type="text/javascript">

$('.products').addClass("active");
$('.allsets').addClass("active");

</script>


@endsection

