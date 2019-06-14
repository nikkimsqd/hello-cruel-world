@extends('layouts.boutique')
@extends('boutique.sections')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Made-to-Orders</b></h3>

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
              <table id="mtos-table" class="table table-hover">
                <thead>
                <tr>
                  <th>MTO ID</th>
                  <th>Customer Name</th>
                  <th>Date of Use</th>
                  <th>Request Placed at:</th>
                  <th>Order Status</th>
                  <th></th>
                </tr>
                </thead>
                @if(!empty($mtos))
                @foreach($mtos as $mto)
                <tr>
                  <td>{{$mto['id']}}</td>
                  <td>{{$mto->customer->lname.', '.$mto->customer->fname}}</td>
                  <td>{{date('M d, Y',strtotime($mto['dateOfUse']))}}</td>
                  <td>{{$mto['created_at']->format('M d, Y')}}</td>
                  @if($mto['orderID'] != null)
                    <td><a href="made-to-orders/{{$mto->order['id']}}" class="btn btn-default btn-sm">View Order</a></td>
                  @else
                    <td style="color: red;">MTO has no order data yet</td>
                  @endif
                  <td><a href="made-to-orders/{{$mto['id']}}" class="btn btn-default btn-sm">View MTO</a></td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="5"><i>You have no rent requests...</i></td>
                </tr>
                @endif
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- table row -->


 
</section>

@endsection

@section('scripts')

<script type="text/javascript">

$(function () {
  $('#mtos-table').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  })
});

$('.transactions').addClass("active");
$('.mtos').addClass("active");

</script>

@endsection
