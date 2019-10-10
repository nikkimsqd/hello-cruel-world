@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title"><b>Payout ID: {{$order->payout['id']}}</b></h3>
        </div>

        <div class="box-body">
          <div class="col-md-5"> 
            <h4>Order ID: <b>{{$order['id']}}</b></h4>
            <h4>Boutique Name: <b>{{$order->boutique['boutiqueName']}}</b></h4>
            <h4>Payout Batch ID: <b>{{$order->payout['batchID']}}</b></h4>
            <h4>Amount: <b>₱{{$order->payout['amount']}}</b></h4>
          </div>

          <div class="col-md-5">
          </div>

        </div>
        <div class="box-footer" style="text-align: right;">
         <a class="btn btn-default" href="{{url('admin-payouts')}}">Back to payouts</a>
         <a class="btn btn-primary" href="{{url('admin-orders/'.$order['id'])}}">View Order Details</a>
        </div>
      </div>
    </div>
  </div>
</section>





<style type="text/css">

  .total{border-top: 2px solid #757575;}
  .align-center{text-align: center;}
  .align-right{text-align: right;}
  .mg-bottom{margin-bottom: 0;}

</style>
      
@endsection

@section('scripts')
<script type="text/javascript">

$('.payouts').addClass("active");  

// $(function () {
//   $('#orders-table').DataTable({
//     'paging'      : true,
//     'lengthChange': true,
//     'searching'   : false,
//     'ordering'    : true,
//     'info'        : true,
//     'autoWidth'   : false
//   })
// });

</script>

@endsection