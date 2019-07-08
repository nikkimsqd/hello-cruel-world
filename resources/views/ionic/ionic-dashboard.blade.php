@extends('layouts.boutique')
@extends('ionic.sections')


@section('content')

<section class="content">
  <div class="row" id="orders">
    <div class="col-md-12">
      @foreach($orders as $order)
      <div class="box">
        <input type="text" name="orderID" class="orderID" value="{{$order['id']}}" hidden>

        <div class="box-header with-border">
          <h3 class="box-title"><b>Order ID:</b> {{$order['id']}} </h3>
        </div>

        <div class="box-body">
          <div class="row">
            <div class="col-md-10">
              <!-- <h4>{{$order->customer['fname'].' '.$order->customer['lname']}}</h4> -->
              <p><i class="fa fa-dot-circle-o"></i>&nbsp; {{$order->boutique['boutiqueAddress']}}</p>
              <p><i class="fa fa-map-marker"></i>&nbsp; {{$order['deliveryAddress']}}</p>
              @if($order['status'] == "Pending")
              <span class="label label-warning">{{$order['status']}}</span>

              @elseif($order['status'] == "In-Progress")
              <span class="label label-info">{{$order['status']}}</span>

              @elseif($order['status'] == "For Pickup")
              <span class="label bg-navy">{{$order['status']}}</span>

              @elseif($order['status'] == "For Delivery")
              <span class="label bg-olive">{{$order['status']}}</span>

              @elseif($order['status'] == "On Delivery")
              <span class="label label-maroon">{{$order['status']}}</span>

              @elseif($order['status'] == "Delivered")
              <span class="label label-success">{{$order['status']}}</span>

              @elseif($order['status'] == "Completed")
              <span class="label label-success">{{$order['status']}}</span>
              @endif
            </div>
            <div class="col-md-2">
              <p class="price">₱{{$order['total']}}</p>
            </div>
          </div>
        </div>
      </div>
     
      @endforeach
    </div>
  </div>
        
</section>

<style type="text/css">
  .breadcrumb{display: none;}
  .col-md-10{width: 80%; float: left; padding-right: 0;}
  .col-md-2{width: 20%; float: right; padding-left: 10px;}
  .main-footer{display: none;}
</style>
@endsection

@section('scripts')
<script type="text/javascript">

$('body').on('click', '.box', function(){
  var orderID = $(this).find(".orderID").val();
  console.log(orderID);

  window.location = "{{url('ionic-viewOrder')}}/"+orderID;

});

</script>
@endsection