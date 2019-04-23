@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-success">

      <div class="box-header with-border">
        <h3 class="box-title">Categories</h3>
      </div>

      <div class="box-body">
        <div class="row">
        <div class="col-md-6">
        @if($rent['status'] == "Pending")
        <form action="/hinimo/public/approveRent" method="post">
        @elseif($rent['status'] == "In-Progress")
        <form action="/hinimo/public/updateRentInfo" method="post">
  
        @endif
          {{csrf_field()}}

          <label>Product Name</label>
          <h4>{{ $rent->product['productName'] }}</h4>

          <label>Boutique Name</label>
          <h4>{{ $rent->product->owner['boutiqueName'] }}</h4>

          <label>Customer Name</label>
          <h4>{{ $rent->customer['fname']}}</h4>

          <label>Location item will be used</label>
          <h4>{{ $rent['locationToBeUsed']}}</h4>

          <label>Date Item will be used</label>
          <h4>{{ $rent['dateToUse']}}</h4>
          </div>
          <div class="col-md-6">

          <label>Address of Delivery</label>
          <h4>{{ $rent->address['completeAddress']}}</h4>

          <label>Request placed at</label>
          <h4>{{ $rent['created_at']->format('M d, Y')}}</h4>

          @if($rent['approved_at'] != null)
          <label>Request Approved at</label>
          <h4>{{ $rent['approved_at']->format('M d, Y')}}</h4>
          @endif

          <label>Staus</label><br>
          @if($rent['status'] == "Pending")
          <h4 class="label label-warning">{{ $rent['status']}}</h4>
          @elseif($rent['status'] == "In-Progress")
          <h4 class="label label-info">{{ $rent['status']}}</h4>
          @elseif($rent['status'] == "Declined")
          <h4 class="label label-danger">{{ $rent['status']}}</h4>
          @else
          <h4 class="label label-warning">{{ $rent['status']}}</h4>
          @endif
          <br><br>
          @if($rent['dateToBeReturned'] != null)
          <label>Item must be returned on or before:</label>
          <h4>{{ $rent['dateToBeReturned']}}</h4>
          @endif
        </div>
        </div>

      </div>
      <div class="box-footer" style="text-align: right;">
       <a class="btn btn-warning" href="{{url('boutique-notifications')}}"><i class="fa fa-arrow-left"> Go to notifications</i></a>
       <a class="btn btn-primary" href="{{url('rents/'.$rent['rentID'])}}"><i class="fa fa-plus"> View rent info</i></a>
      </div>
    </div>
  </div>
</div>




@endsection