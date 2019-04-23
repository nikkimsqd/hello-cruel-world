@extends('layouts.boutique')
@extends('admin.sections')


@section('content')

<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-aqua">
      <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Orders</span>
        <span class="info-box-number">{{$orderCount}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="ion ion-bag"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Rent</span>
        <span class="info-box-number">{{$rentCount}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="ion ion-ios-people"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Customers</span>
        <span class="info-box-number">{{$customerCount}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-red">
      <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Boutiques</span>
        <span class="info-box-number">{{$boutiqueCount}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>


<div class="row">
  <div class="col-md-12">
    <br>
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"><b>ON-DELIVERY</b></h3>

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
            <td>{{$order->customer['fname'].' '.$order->customer['lname']}}</td>
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
       <a class="btn btn-primary" href="admin-orders">View all Orders here</a>
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>



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
            <td>{{$order->customer['fname'].' '.$order->customer['lname']}}</td>
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
       <a class="btn btn-primary" href="admin-orders">View all Orders here</a>
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>




@endsection

