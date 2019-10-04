@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
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
          <table class="table table-hover" id="orders-table">
            <thead>
            <tr>
              <th class="align-center">Order ID</th>
              <th>Order Type</th>
              <th>Boutique Name</th>
              <th class="align-center">Status</th>
              <th class="align-center">Total</th>
              <th></th>
              <!-- <th></th> -->
            </tr>
            </thead>
            @foreach($orders as $order)
            <tr>
              <td class="align-center">{{$order['id']}}</td>
              @if($order['cartID'] != null)
              <td><b>PURCHASE</b></td>
              @elseif($order['rentID'] != null)
              <td><b>RENT</b></td>
              @elseif($order['mtoID'] != null)
              <td><b>MTO</b></td>
              @elseif($order['biddingID'] != null)
              <td><b>BIDDING</b></td>
              @endif
              <td>{{$order->boutique['boutiqueName']}}</td>
              <td class="align-center">
                <span class="label label-success">{{$order['status']}}</span>
              </td>
              <td class="align-center">P{{$order['total']}}</td>
              <td><a href="{{url('admin-forpickups/'.$order['id'])}}" class="btn btn-default btn-sm">View Order</a></td>
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
</section>

<style type="text/css">
  
.align-center{text-align: center;}
.align-right{text-align: right;}

</style>
      
@endsection

@section('scripts')
<script type="text/javascript">

$('.orders').addClass("active");
$('.archives').addClass("active");  

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

</script>

@endsection