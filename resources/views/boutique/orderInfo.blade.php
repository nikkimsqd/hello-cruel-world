@extends('layouts.boutique')
@extends('boutique.sections')


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
            <table class="table table-striped">
              <col width="250">
              <col width="150">
              <col width="250">
              <col width="70">
              <thead>
              <tr>
                <th>Customer Name</th>
                <th>Boutique Name</th>
                <th>Delivery Address</th>
                <th>Status</th>
              </tr>
              </thead>
              <tr>
                <td>{{$order->customer['fname'].' '.$order->customer['lname']}}</td>
                <td>{{$order->boutique['boutiqueName']}}</td>
                <td>{{$order['deliveryAddress']}}</td>
                @if($order['status'] == "Pending")
                <td><span class="label label-warning">{{$order['status']}}</span></td>

                @elseif($order['status'] == "In-Progress")
                <td><span class="label label-info">{{$order['status']}}</span></td>

                @elseif($order['status'] == "For Pickup")
                <td><span class="label bg-navy">{{$order['status']}}</span></td>

                @elseif($order['status'] == "For Delivery")
                <td><span class="label bg-olive">{{$order['status']}}</span></td>

                @elseif($order['status'] == "On Delivery")
                <td><span class="label label-maroon">{{$order['status']}}</span></td>

                @elseif($mto['status'] == "Delivered")
                <td><span class="label label-success">{{$mto['status']}}</span></td>

                @elseif($order['status'] == "Completed")
                <td><span class="label label-success">{{$order['status']}}</span></td>

                @endif
              </tr>
              <!-- <tr>
                <td>Customer Name</td>
                <td>{{$order->customer['fname'].' '.$order->customer['lname']}}</td>
              </tr>
              <tr>
                <td>Boutique Name</td>
                <td>{{$order->boutique['boutiqueName']}}</td>
              </tr>
              <tr>
                <td>Delivery Address</td>
                <td>{{$order['deliveryAddress']}}</td>
              </tr>
              <tr>
                <td>Status</td>
                <td>{{$order['status']}}</td>
              </tr> -->
            </table><br><br>

            <table class="table table-striped">
              <col width="250">
              <col width="150">
              <col width="250">
              <col width="70">
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
                <td>{{$item->product['productPrice']}}</td>
              </tr>
              @endforeach
            </table><br><br>
          </div>

          <div class="col-md-5">

            <table class="table ">
              <col width="200">
              <col width="350">
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
                  <td style="color: red">{{$order['paymentStatus']}}</td>
                @else
                  <td style="color: #0315ff;">{{$order['paymentStatus']}}</td>
                @endif
              </tr>
            </table>
          </div>

        </div>
        <div class="box-footer" style="text-align: right;">
         <a class="btn btn-default" href="{{url('orders')}}"> Back</a>
         @if($order['paymentStatus'] == "Paid")
         <a class="btn btn-primary" href="" data-toggle="modal" data-target="#forPickupModal"> For Pickup</a>
         @else
         <input type="submit" value="For Pickup" class="btn btn-primary" disabled>
         @endif
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MODAL -->
<div class="modal fade" id="forPickupModal" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <p>Submit MTO for Pickup?</p>
            <!-- <input type="text" name="orerID" value="{{$order['id']}}" hidden> -->
          </div>

          <div class="modal-footer">
            <a href="{{url('submitOrder/'.$order['id'])}}" class="btn btn-primary">Confirm</a>
          </div>
      </div> 
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">

$('.transactions').addClass("active");
$('.orders').addClass("active");

</script>
@endsection