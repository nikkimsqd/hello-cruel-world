@extends('layouts.boutique')
@extends('boutique.sections') 

@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          @if($mto['status'] == "Active")
          <h3 class="box-title">MTO ID: {{$mto['id']}}</h3>
          @elseif($mto['status'] == "Cancelled")
          <h3 class="box-title">MTO ID: {{$mto['id']}} | <label class="label label-danger">Cancelled</label></h3>
          @else
          <h3 class="box-title">MTO ID: {{$mto['id']}} | <label class="label label-danger">Declined</label></h3>
          @endif
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <?php 
                $measurementData = json_decode($mto->measurement['data']);
                $fabricChoice = json_decode($mto['fabricChoice']);
                $fabricSuggestion = json_decode($mto['fabricSuggestion']);
              ?>

              <h4>Customer Name: <b>{{$mto->customer['fname'].' '.$mto->customer['lname']}}</b></h4>
              <h4>Date request placed: <b>{{$mto['created_at']->format('M d, Y')}}</b></h4>

              <hr>
              <h4><b>MTO Details</b></h4>
              <h4>Date of item's use: <b>{{date('M d, Y',strtotime($mto['dateOfUse']))}}</b></h4>
              <h4>Fabric Choice:</h4>

              @if($mto['fabricID'] != null)
                <h4>Fabric Type: <b>{{$mto->fabric['name']}}</b></h4>
                <h4>Fabric Color: <b>{{$mto->fabric['color']}}</b></h4>

              @elseif($mto['suggestFabric'] != null)
                <h4><i>User wants you to recommend which type of fabric to use.</i></h4>

              @elseif($mto['fabricChoice'] != null)
                <h4>Fabric Type: <b>{{ucfirst($fabricChoice->fabricType)}}</b></h4>
                <h4>Fabric Color: <b>{{ucfirst($fabricChoice->fabricColor)}}</b></h4>
              @endif

              <h4>Customer's Notes/Instructions: <b>{{$mto['notes']}}</b></h4>
              @if($mto['price'] != null)
                <h4>Price: <b>{{$mto['price']}}</b></h4>
              @endif

              <hr>
              <h4><b>Customer's Measurements Details</b></h4>
              @foreach($measurementData as $measurementName => $value)
                <h4>{{$measurementName}}: <b>{{$value}} inches</b></h4>
              @endforeach
              <h4>Customer's Height: <b>{{$mto['height']}} cm</b></h4>
              
              @if($mto['fabricSuggestion'] != null)
                <hr>
                <h4>Your Fabric Recommendation</h4>
                @foreach($fabrics as $fabric)
                @if($fabric['id'] == $fabricSuggestion->fabricID)
                  <h4>Fabric Type: <b>{{$fabric['name']}}</b></h4>
                  <h4>Fabric Color: <b>{{$fabric['color']}}</b></h4>
                @endif
                @endforeach
                <h4>Price: <b>{{$fabricSuggestion->price}}</b></h4>
              @endif

              @if($mto['orderID'] == null && $mto['status'] == "Active")
              <hr>
              <a href="" data-toggle="modal" data-target="#recommendFabricModal">Recommend fabric to use with price here.</a>
              <hr>
              <form action="{{url('/addPrice')}}" method="post">
                {{csrf_field()}}
                <h4>Add price of item:</h4>
                <input type="number" name="price" class="input form-control"><br>
                <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>

                <input type="submit" name="btn_submit" value="Place Offer" class="btn btn-primary">
              </form>
              @endif

              @if($mto['status'] != "Active" && $mto['status'] != "Cancelled")
              <hr>
              <h4><i>Your reason for declining: {{$mto->declineDetails['reason']}}</i></h4>
              @endif

            </div>
            <div class="col-md-6">

              <img src="{{ asset('/uploads/').$mto->productFile['filename'] }}" style="width:80%; height: auto; object-fit: cover;margin: 10px; text-align: right;">
            </div>
          </div>
        </div>

        <div class="box-footer" style="text-align: right;">
          @if($mto['orderID'] == null && $mto['status'] == "Active")
            <a href="{{url('made-to-orders')}}" class="btn btn-default">Back to MTOs</a>
            <a href="" data-toggle="modal" data-target="#declineModal" class="btn btn-danger">Decline Request</a>
          @elseif($mto['orderID'] != null && $mto['status'] == "Active")
            <a href="{{url('made-to-orders')}}" class="btn btn-default">Back to MTOs</a>
            <a href="{{url('orders/'.$mto->order['id'])}}" class="btn btn-primary">View Order Details</a>
          @else
            <a href="{{url('made-to-orders')}}" class="btn btn-default">Back to MTOs</a>
          @endif
        </div>

      </div>
    </div>
  </div>
</section>


<!-- RECOMMEND FABRIC -->
<div class="modal fade" id="recommendFabricModal" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><b>Recommend a fabric</b></h3>
      </div>

      <div class="modal-body">
        <form action="{{url('/recommendFabric')}}" method="post">
        {{csrf_field()}}

          <h4>Fabric Type:</h4> 
          <select id="fabric-type" class="form-control mb-3" required>
            <option disabled selected>Choose fabric type</option>
            @foreach($fabs as $fab => $name)
            <option value="{{$fab}}">{{$fab}}</option>
            @endforeach
          </select><br>
          <h4>Fabric Color:</h4> 
          <select id="fabric-color" class="form-control mb-3" name="fabricSuggestion[fabricID]" disabled required>
            <option disabled selected="selected">Select Fabric Type first</option>
          </select><br>
          <h4>Price:</h4> 
          <input type="text" name="fabricSuggestion[price]" class="form-control" placeholder="Price" required>
          <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>
      </div>

      <div class="modal-footer">
        <input type="submit" name="btn_sumbit" class="btn btn-success" value="Submit">
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- FOR PICKUP MODAL -->
<div class="modal fade" id="forPickupModal" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <p>Submit MTO for Pickup?</p>
            <input type="date" name="deliverySchedule">
            <input type="text" name="orerID" value="{{$mto['id']}}" hidden>
          </div>

          <div class="modal-footer">
            <a href="{{url('submitMTO/'.$mto['id'])}}" class="btn btn-primary">Confirm</a>
          </div>
      </div> 
    </div>
</div>


<!-- DECLINE RENT -->
<div class="modal fade" id="declineModal" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Submit a reason</b></h3>
      </div>

      <div class="modal-body">
        <form action="{{url('/declineMto')}}" method="post">
        {{csrf_field()}}
        <textarea name="reason" rows="3" cols="50" class="input form-control" placeholder="Place your reason here"></textarea>
        <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>
      </div>

      <div class="modal-footer">
        <input type="submit" name="btn_sumbit" class="btn btn-success" value="Submit">
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<style type="text/css">
  h4{ margin-top: 0;}
  .borderless td, .borderless th {border: none;}
  .measurements {padding-left: 0;}
</style>




@endsection


@section('scripts')

<script type="text/javascript">

$('.transactions').addClass("active");
$('.mtos').addClass("active");

$('#fabric-type').on('change', function(){
    $('#fabric-color').empty();
    $('#fabric-color').append('<option disabled selected="selected">Choose fabric color</option>');
    $('#fabric-color').prop('disabled',false);

    var type = $(this).val();
    $.ajax({
        url: "/hinimo/public/getFabricColor/"+type,
        success:function(data){ 
            data.colors.forEach(function(color){
                $('#fabric-color').append('<option value="'+color.id+'">'+color.color+'</option>');
                // $('#fabric-color').next().find('.list').append('<li data-value="'+color.id+'" class="option">'+color.color+'</li>');
            });
        }
    });
});
</script>

@endsection

