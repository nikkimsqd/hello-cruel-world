@extends('layouts.boutique')
@extends('boutique.layout')


@section('content')
  <?php 
      $counter = 1;
  ?>

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

            @if($product['forSale'] === "true" && $product['forRent'] === "true")
            <h4>Retail Price</h4>
            <p>{{ $product['productPrice'] }}</p>

            <h4>Rent Price</h4>
            <p>{{ $product['rentPrice'] }}</p>
            
            @elseif($product['forRent'] === "true")
            <h4>Rent Price</h4>
            <p>{{ $product['rentPrice'] }}</p>

            @elseif($product['forSale'] === "true")
            <h4>Retail Price</h4>
            <p>{{ $product['productPrice'] }}</p>

            @endif



            <h4>Product Category</h4>
            <p>{{ $product->gender.', '.$product->getCategory['categoryName']}}<p>

            <h4>Product Status</h4>
            <p>{{ $product['productStatus'] }}</p>

            <h4>Item Availability:</h4>
            @if($product['forRent'] == true && $product['forSale'])
            <p>Item is for RENT & for SALE.</p>
            @elseif($product['forSale'] == true)
            <p>Item is for SALE only.</p>
            @elseif($product['forRent'] == true)
            <p>Item is for RENT only.</p>
            @else
            <p>You have not yet set the availability for this item.</p>
            @endif

            <h4>Is item customizable?</h4>
            <p>{{$product['customizable']}}</p>
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
        <a href="/hinimo/public/editView/{{$product['productID']}}" class="btn btn-success"><i class="fa fa-edit"> Edit</i></a>
        <a href="/hinimo/public/delete/{{$product['productID']}}" class="btn btn-danger"><i class="fa fa-trash"> Delete</i></a>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
  h4{font-weight: bold;}
</style>


@endsection

