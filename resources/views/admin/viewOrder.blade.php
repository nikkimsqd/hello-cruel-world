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
            <h4>Delivery Address: <b>{{$order['deliveryAddress']}}</b></h4>
            <h4>Status: 
              @if($order['status'] == "In-Progress")
              <span class="label label-warning">{{$order['status']}}</span>

              @elseif($order['status'] == "For Alterations")
              <span class="label label-info">{{$order['status']}}</span>

              @elseif($order['status'] == "For Pickup")
              <span class="label bg-navy">{{$order['status']}}</span>

              @elseif($order['status'] == "For Delivery")
              <span class="label bg-olive">{{$order['status']}}</span>

              @elseif($order['status'] == "On Delivery")
              <span class="label bg-maroon">{{$order['status']}}</span>

              @elseif($order['status'] == "Delivered")
              <span class="label label-success">{{$order['status']}}</span>

              @elseif($order['status'] == "Completed")
              <span class="label label-success">{{$order['status']}}</span>
              @endif
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
              </table>
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
              </table>
            @endif
          <hr>
          <br>
          </div>

          <div class="col-md-4" style="text-align: right">
            <table class="table">
              <col width="162">
              <col width="130">
              <tr>
                <th><h4>Subtotal</h4></th>
                <td><h4 class="bold">₱{{$order['subtotal']}}</h4></td>
              </tr>
              <tr>
              <tr>
                <th><h4>Delivery Fee</h4></th>
                <td><h4 class="bold">₱{{$order['deliveryfee']}}</h4></td>
              </tr>
              <tr>
                <th><h4>Total</h4></th>
                <td><h4 class="bold">₱{{$order['total']}}</h4></td>
              </tr>
              <tr>
                <th><h4>Payment Status</h4></th>
                @if($order['paymentStatus'] == "Not Yet Paid")
                  <td><h4><span class="label label-danger">{{ $order['paymentStatus']}}</span></h4></td>
                @else
                  <td><h4><span class="label label-success">{{ $order['paymentStatus']}}</span></h4></td>
                @endif
              </tr>
            </table>
          </div>
          <div class="col-md-4 col-md-offset-1" style="text-align: right">
            <table class="table">
              <col width="162">
              <col width="130">
              <tr>
                <th><h4>Boutique's Revenue</h4></th>
                <td><h4 class="bold">₱{{$order['boutiqueShare']}}</h4></td>
              </tr>
              <tr>
                <th><h4>Hinimo's Revenue</h4></th>
                <td><h4 class="bold">₱{{$order['adminShare']}}</h4></td>
              </tr>
            </table>
          </div>

        </div>
        <div class="box-footer" style="text-align: right;">
          <a class="btn btn-default" href="{{url('admin-orders')}}"> Back</a>
        </div>
      </div>
    </div>
  </div>
</section>

<style type="text/css">

.bold{font-weight: bold;}

</style>



@endsection

@section('scripts')
<script type="text/javascript">

$('.orders').addClass("active");
$('.on-going').addClass("active");

</script>
@endsection