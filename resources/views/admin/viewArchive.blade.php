@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">

        <div class="box-header with-border">
          <h3 class="box-title">Order ID: {{$order['id']}}</h3>
        </div>

        <div class="box-body">
          <div class="col-md-12"> 
            <h4>Customer Name: <b>{{$order->customer['fname'].' '.$order->customer['lname']}}</b></h4>
            <h4>Boutique Name: <b>{{$order->boutique['boutiqueName']}}</b></h4>
            <h4>Delivery Address: <b>{{$order->address['completeAddress']}}</b></h4>
            <h4>Status: 
              <span class="label label-success">{{$order['status']}}</span>
            </h4>
            <h4>Order Type: 
              @if($order['cartID'] != null)
                <b>Purchase</b>
              @elseif($order['rentID'] != null)
                <b>Rent</b>
              @elseif($order['mtoID'] != null)
                <b>MTO</b>
              @elseif($order['biddingID'] != null)
                <b>Bidding</b>
              @endif
            </h4>
            <h4>Payout Status:
              @if($order['payoutID'] != null)
              <span class="label label-success">OK</span>
              @else
              <span class="label label-warning">Not Ok</span> | 
              <a href="{{url('admin-payouts')}}">Payout here</a>
              @endif
            </h4>
            <br>

            @if($order['cartID'] != null)
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>Qty</th>
                  <th>Product Name</th>
                  <th>Product Description</th>
                  <th>Price</th>
                </tr>
                </thead>
                  @foreach($order->cart->items as $item)
                  <tr>
                    <td>1</td>
                    <td>{{$item->product['productName']}}</td>
                    <td>{{$item->product['productDesc']}}</td>
                    <td>{{$item->product['price']}}</td>
                  </tr>
                  @endforeach
              </table><br><br>
            @elseif($order['rentID'] != null)
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>Qty</th>
                  <th>Product Name</th>
                  <th>Product Description</th>
                  <th>Rent Price</th>
                </tr>
                </thead>
                  <tr>
                    <td>1</td>
                    <td>{{$order->rent->product['productName']}}</td>
                    <td>{{$order->rent->product['productDesc']}}</td>
                    <td>{{$order->rent->product->rentDetails['price']}}</td>
                  </tr>
              </table><br><br>
            @endif
          </div>

          <div class="col-md-4" style="text-align: right">

            <table class="table">
              <col width="162">
              <col width="130">
              <tr>
                <th>Subtotal</th>
                <td>{{$order['subtotal']}}</td>
              </tr>
              <tr>
                <th>Delivery Fee</th>
                <td>{{$order['deliveryfee']}}</td>
              </tr>
              <tr>
                <th>Total</th>
                <td>{{$order['total']}}</td>
              </tr>
              <tr>
                <th>Payment Status</th>
                @if($order['paymentStatus'] == "Not Yet Paid")
                  <td><span class="label label-danger">{{ $order['paymentStatus']}}</span></td>
                @else
                  <td><span class="label label-success">{{ $order['paymentStatus']}}</span></td>
                @endif
              </tr>
            </table>
          </div>

        </div>
        <div class="box-footer" style="text-align: right;">
          <a class="btn btn-default" href="{{url('admin-archives')}}"> Back</a>
        </div>
      </div>
    </div>
  </div>
</section>




@endsection

@section('scripts')
<script type="text/javascript">

$('.orders').addClass("active");
$('.archives').addClass("active");

</script>
@endsection