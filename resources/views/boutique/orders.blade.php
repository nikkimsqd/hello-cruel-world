@extends('layouts.boutique')
@extends('boutique.sections') 

@section('content')

<section class="content">
  <div class="row" id="orders">
    <div class="col-md-12">
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title"><b>ORDERS</b></h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table id="orders-table" class="table table-hover">
                <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Customer Name</th>
                  <th>Request Placed at:</th>
                  <th>Payment Status</th>
                  <th>Status</th>
                  <th></th>
                </tr>
                </thead>
                @foreach($orders as $order)
                @if(!empty($order['status']))
                <tr>
                  <td>{{$order['id']}}</td>
                  <td>{{$order->cart->owner->fname.' '.$order->cart->owner->lname}}</td>
                  <td>{{$order['created_at']->format('M d, Y')}}</td>
                  @if($order['paymentStatus'] == "Not Yet Paid")
                    <td style="color: red">{{$order['paymentStatus']}}</td>
                  @else
                    <td style="color: #0315ff;">{{$order['paymentStatus']}}</td>
                  @endif
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

                  @elseif($order['status'] == "Delivered")
                  <td><span class="label label-success">{{$order['status']}}</span></td>

                  @elseif($order['status'] == "Completed")
                  <td><span class="label label-success">{{$order['status']}}</span></td>

                  @endif
                  <td><a href="orders/{{$order['id']}}" class="btn btn-default btn-sm">View Order</a></td>
                </tr>
                @else
                <tr>
                  <td colspan="5"><i>You have no rent requests...</i></td>
                </tr>
                @endif
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- table row -->
  <br><br>

</section>


@endsection



@section('scripts')
<script type="text/javascript">

$(function () {
  $('#orders-table').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  })
});

$('.transactions').addClass("active");
$('.orders').addClass("active");

</script>
@endsection