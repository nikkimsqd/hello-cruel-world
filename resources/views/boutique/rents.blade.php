@extends('layouts.boutique')
@extends('boutique.sections') 

@section('content')

<section class="content">
  <div class="row" id="rents">
    <div class="col-md-12">
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title"><b>RENT REQUESTS</b></h3>

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
              <table id="rents-table" class="table table-hover">
                <thead>
                <tr>
                  <th>Rent ID</th>
                  <th>Customer Name</th>
                  <th>Request Placed at:</th>
                  <th>Payment Status</th>
                  <th>Status</th>
                  <th></th>
                </tr>
                </thead>
                @foreach($rents as $rent)
                @if(!empty($rent['status']))
                <tr>
                  <td>{{$rent['id']}}</td>
                  <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
                  <td>{{$rent['created_at']->format('M d, Y')}}</td>
                  @if($rent->order['paymentStatus'] == "Not Yet Paid")
                    <td style="color: red">{{$rent->order['paymentStatus']}}</td>
                  @elseif(!empty($rent->order['paymentStatus']))
                    <td style="color: #0315ff;">{{$rent->order['paymentStatus']}}</td>
                  @else
                    <td style="color: #0315ff;">Rent has no order</td>
                  @endif
                  @if($rent['status'] == "Pending")
                    <td><span class="label label-warning">{{$rent['status']}}</span></td>
                  @elseif($rent['status'] == "Approved")
                    <td><span class="label label-info">{{$rent['status']}}</span></td>
                  @elseif($rent['status'] == "On Rent")
                    <td><span class="label label-navy">{{$rent['status']}}</span></td>
                  @elseif($rent['status'] == "Completed")
                    <td><span class="label label-success">{{$rent['status']}}</span></td>
                  @else
                    <td><span class="label label-danger">Declined</span></td>
                  @endif
                  <td><a href="rents/{{$rent['id']}}" class="btn btn-default btn-sm">View Order</a></td>
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
  $('#rents-table').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  })
});

$('.transactions').addClass("active");
$('.rents').addClass("active");

</script>
@endsection