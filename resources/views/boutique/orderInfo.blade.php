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
            <h4>Customer Name: <b>{{$order->customer['fname'].' '.$order->customer['lname']}}</b></h4>
            <h4>Boutique Name: <b>{{$order->boutique['boutiqueName']}}</b></h4>
            <h4>Delivery Address: <b>{{$order->address['completeAddress']}}</b></h4>
            <h4>Status: 
              @if($order['status'] == "Pending")
              <span class="label label-warning">{{$order['status']}}</span>

              @elseif($order['status'] == "In-Progress")
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

              @elseif($order['status'] == "On Rent")
              <span class="label label-info">{{$order['status']}}</span>
              @endif
            </h4>
            <h4>Order Type: 
              @if($order['cartID'] != null)
                <b>PURCHASE</b>
              @elseif($order['rentID'] != null)
                <b>RENT</b>
              <h4>Date Item will be used: <b>{{date('M d, Y',strtotime($order->rent['dateToUse']))}}</b></h4>
              @elseif($order['mtoID'] != null)
                <b>MADE-TO-ORDER</b>
                <h4>Date of item's use: <b>{{date('M d, Y',strtotime($order->mto['dateOfUse']))}}</b></h4>
              @elseif($order['biddingID'] != null)
                <b>BIDDING</b>
                <h4>Deadline of Product: <b>{{ date('M d, Y',strtotime($order->bidding['deadlineOfProduct'])) }}</b></h4>
              @endif
            </h4>
            <br>

            @if($order['cartID'] != null)
              <table class="table table-striped">
                <!-- <col width="250">
                <col width="150">
                <col width="250">
                <col width="70"> -->
                <thead>
                <tr>
                  <th>Qty</th>
                  <th>Product Name</th>
                  <th>Product Description</th>
                  <th>Price</th>
                </tr>
                </thead>
                  @foreach($order->cart->items as $item)
                  @if($item->product != null)
                    @if($item->product['boutiqueID'] == $boutique['id'])
                    <tr>
                      <td>1</td>
                      <td>{{$item->product['productName']}}</td>
                      <td>{{$item->product['productDesc']}}</td>
                      <td>{{$item->product['price']}}</td>
                    </tr>
                    @endif
                  @else
                    @if($item->set['boutiqueID'] == $boutique['id'])
                    <tr>
                      <td>1</td>
                      <td>{{$item->set['setName']}}</td>
                      <td>{{$item->set['setDesc']}}</td>
                      <td>{{$item->set['price']}}</td>
                    </tr>
                    @endif
                  @endif
                  @endforeach
              </table><br><br>
            @elseif($order['rentID'] != null)
              <table class="table table-striped">
                <!-- <col width="250">
                <col width="150">
                <col width="250">
                <col width="70"> -->
                <thead>
                <tr>
                  <th>Qty</th>
                  <th>Product Name</th>
                  <th>Product Description</th>
                  <th>Rent Price</th>
                </tr>
                </thead>
                  <tr>
                    @if($order->rent->product != null)
                    <td>1</td>
                    <td>{{$order->rent->product['productName']}}</td>
                    <td>{{$order->rent->product['productDesc']}}</td>
                    <td>{{$order->rent->product->rentDetails['price']}}</td>
                    @else
                    <td>1</td>
                    <td>{{$order->rent->set['setName']}}</td>
                    <td>{{$order->rent->set['setDesc']}}</td>
                    <td>{{$order->rent->set->rentDetails['price']}}</td>
                    @endif
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
        @if($order['cartID'] != null)
          <a class="btn btn-default" href="{{url('orders')}}"> Back</a>
        @elseif($order['rentID'] != null)
          <a class="btn btn-default" href="{{url('rents/'.$order->rent['rentID'])}}"> Back to Rent Details</a>
        @elseif($order['mtoID'] != null)
          <a class="btn btn-default" href="{{url('made-to-orders/'.$order->mto['id'])}}"> Back to MTO Details</a>
        @elseif($order['biddingID'] != null)
          <a class="btn btn-default" href="{{url('boutique-bidding/'.$order->bidding['id'])}}"> Back to Bidding Details</a>
        @endif
        @if($order['paymentStatus'] == "Paid" && $order['status'] == "In-Progress" && $order['cartID'] != null)
          <a class="btn btn-primary" href="" data-toggle="modal" data-target="#forPickupModal"> For Pickup</a>
        @elseif($order['paymentStatus'] == "Paid" && $order['status'] == "In-Progress" && $order['cartID'] == null)
          <a class="btn btn-primary" href="" data-toggle="modal" data-target="#forAlterationsModal"> Set Date for Fittings</a>
        @elseif($order['status'] == "For Alterations" && $order['cartID'] == null)
          <a class="btn btn-primary" href="" data-toggle="modal" data-target="#forPickupModal"> For Pickup</a>
        @elseif($order['paymentStatus'] == "Not Yet Paid" && $order['status'] == "In-Progress" && $order['cartID'] != null)
          <input type="submit" value="For Pickup" class="btn btn-primary" disabled>
        @elseif($order['paymentStatus'] == "Not Yet Paid" && $order['status'] == "In-Progress")
          <input type="submit" value="For Alterations" class="btn btn-primary" disabled>
        @elseif($order['status'] == "On Rent")
          <a href="{{url('rentReturned/'.$order['rentID'])}}" class="btn btn-primary">Item Returned</a>
        @endif
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MODAL -->
<div class="modal fade" id="forAlterationsModal" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title"><b>Set fitting schedule</b></h3>
          </div>

          <div class="modal-body">
            <p>Set date for fitting:</p>
            <form action="{{url('forAlterations')}}" method="post">
              {{csrf_field()}}
              <input type="text" name="alterationDateStart" id="alterationDateStart" class="form-control" placeholder="Set start date" required>
              <input type="text" name="alterationDateEnd" id="alterationDateEnd" class="form-control" placeholder="Set end date" required>
              <input type="text" name="orderID" value="{{$order['id']}}" hidden>
          </div>

          <div class="modal-footer">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Confirm">
          </form>
          </div>
      </div> 
    </div>
</div>

<div class="modal fade" id="forPickupModal" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title"><b>Submit MTO for Pickup?</b></h3>
          </div>

          <div class="modal-body">
            <p>Set date for pickup:</p>
            <form action="{{url('submitOrder')}}" method="post">
              {{csrf_field()}}
              <!-- <input type="text" id="alterationDateEnd" class="form-control" value="{{$order['alterationDateEnd']}}" hidden> -->
              <input type="text" name="deliverySchedule" id="deliverySchedule" class="form-control datepicker" required>
              <input type="text" name="orderID" value="{{$order['id']}}" hidden>
          </div>

          <div class="modal-footer">
            <!-- <a href="{{url('submitOrder/'.$order['id'])}}" class="btn btn-primary">Confirm</a> -->
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Confirm">
          </form>
          </div>
      </div> 
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">

$('.transactions').addClass("active");
$('.orders').addClass("active");

// ---------------------------------------------------------------------
var dateToday = new Date();
var dateTomorrow = new Date();
dateTomorrow.setDate(dateToday.getDate());
// dateTomorrow.setDate(dateToday.getDate()+1);

$('#alterationDateStart').datepicker({
  startDate: dateTomorrow
});

var dateStart = $('#alterationDateStart').val();

$('#alterationDateEnd').datepicker({
  startDate: dateTomorrow //dapat mag start sa d day after sa startDate
});

// ---------------------------------------------------------------------
// {{$order['alterationDateEnd']}}
var alterationDateEnd = new Date();
// alert(alterationDateEnd);
$('#deliverySchedule').datepicker({
  startDate: dateTomorrow
  //set sad ug date limit sa mto nga dapat 1 week before the use ideliver
});


</script>
@endsection