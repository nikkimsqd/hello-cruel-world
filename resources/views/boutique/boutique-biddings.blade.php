@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Orders from Bidding</h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table id="biddings-table" class="table table-hover">
                <thead>
                <tr>
                  <th>Bidding ID</th>
                  <th>Customer Name</th>
                  <th>Deadline of Product</th>
                  <th>Order Status</th>
                  <th></th>
                </tr>
                </thead>
                @foreach($biddingOrders as $biddingOrder)
                <tr>
                  <td>{{$biddingOrder->bidding['id']}}</td>
                  <td>{{$biddingOrder->bidding->owner['fname'].' '.$biddingOrder->bidding->owner['lname']}}</td>
                  <td>{{$biddingOrder->bidding['deadlineOfProduct']}}</td>
                  <td><a href="{{url('orders/'.$biddingOrder->bidding['orderID'])}}" class="btn btn-default btn-sm">View Order</a></td>
                  <td><a href="{{url('boutique-bidding/'.$biddingOrder->bidding['id'])}}" class="btn btn-default btn-sm">View bidding details</a></td>
                </tr>
                @endforeach
              </table>
              
            </div>
            
          </div>


        </div>
      </div>
    </div>
  </div>
</section>

<style type="text/css">

/*.bid-item{margin: 0 auto;}*/
.view-bidding{text-transform: uppercase; font-weight: 600;}
.view-bidding:hover{background-color: #d9f9ea; border-color: #d9f9ea; color: #398439;}
.bid-item{position: relative;}
.hover-content{position: absolute; width: calc(100% - 40px); bottom: 115px; left: 20px; right: 20px; opacity: 0; visibility: hidden; -webkit-transition-duration: 500ms; transition-duration: 500ms;};
.bid-item .hover-content{visibility: hidden;}
.bid-item:hover .hover-content{visibility: visible; opacity: 1;}

</style>

@endsection


@section('scripts')
<script type="text/javascript">

$(function () {
  $('#biddings-table').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  })
});

$('.transactions').addClass("active");
$('.boutique-biddings').addClass("active");

</script>


@endsection
