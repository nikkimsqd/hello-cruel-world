@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
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
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th>Order ID</th>
            <th>Boutique Name</th>
            <th>Customer Name</th>
            <th>Order Placed at:</th>
            <th>Status</th>
            <th></th>
            <!-- <th></th> -->
          </tr>
          @foreach($orders as $order)
          <tr>
            <td>{{$order['id']}}</td>
            <td>{{$order->boutique['boutiqueName']}}</td>
            @if($order['cartID'] != null)
            <td>{{$order['cartID']}}</td>
            @else
            <td>{{$order['status']}}</td>
            @endif
            <td>{{$order['created_at']}}</td>
            @if ($order['status'] == "Pending")
            <td><span class="label label-warning">{{$order['status']}}</span></td>
            @elseif ($order['status'] == "On Delivery")
            <td><span class="label label-info">{{$order['status']}}</span></td>
            @else
            <td><span class="label label-info">{{$order['status']}}</span></td>
            @endif
            <th><a href="admin-orders/{{$order['id']}}" class="btn btn-default btn-sm">View Order</a></th>
          </tr>
          @endforeach
        </table>
      </div>
      <div class="box-footer" style="text-align: right;">
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>
      
@endsection

