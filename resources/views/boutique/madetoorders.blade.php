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
                  <th>Payment Status</th>
                  <th>Status</th>
                  <th></th>
                </tr>
                </thead>
                @foreach($mtos as $mto)
                @if(!empty($mto['status']))
                <tr>
                  <td>{{$mto['id']}}</td>
                  <td>{{$mto->customer->lname.', '.$mto->customer->fname}}</td>
                  <td>{{date('M d, Y',strtotime($mto['dateOfUse']))}}</td>
                  <td>{{$mto['created_at']->format('M d, Y')}}</td>
                  @if($mto['paymentStatus'] == "Not Yet Paid")
                    <td style="color: red">{{$mto['paymentStatus']}}</td>
                  @else
                    <td style="color: #0315ff;">{{$mto['paymentStatus']}}</td>
                  @endif

                  @if($mto['status'] == "Pending")
                    <td><span class="label label-warning">{{$mto['status']}}</span></td>

                  @elseif($mto['status'] == "In-Transaction")
                    <td><span class="label bg-teal">{{$mto['status']}}</span></td>

                  @elseif($mto['status'] == "In-Progress")
                    <td><span class="label label-info">{{$mto['status']}}</span></td>

                  @elseif($mto['status'] == "For Pickup")
                    <td><span class="label bg-navy">{{$mto['status']}}</span></td>

                  @elseif($mto['status'] == "For Delivery")
                    <td><span class="label bg-olive">{{$mto['status']}}</span></td>

                  @elseif($mto['status'] == "On Delivery")
                    <td><span class="label label-maroon">{{$mto['status']}}</span></td>

                  @elseif($mto['status'] == "Completed")
                    <td><span class="label label-success">{{$mto['status']}}</span></td>

                  @elseif($mto['status'] == "Declined")
                    <td><span class="label label-danger">{{$mto['status']}}</span></td>
                  @endif
                  <td><a href="made-to-orders/{{$mto['id']}}" class="btn btn-default btn-sm">View Order</a></td>
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


  <!-- IN-TRANSACTIONS -->
<!--   <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><b>In-Transactions</b></h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <col width="70">
            <col width="200">
            <col width="120">
            <col width="170">
            <col width="140">
            <col width="100">
            <tr>
              <th>MTO ID</th>
              <th>Customer Name</th>
              <th>Date of Use</th>
              <th>Request Placed at:</th>
              <th>Status</th>
              <th></th>
            </tr>
            @foreach($intransactions as $intransaction)
            @if(!empty($intransaction['status']))
            <tr>
              <td>{{$intransaction['id']}}</td>
              <td>{{$intransaction->customer['fname'].' '.$intransaction->customer['lname']}}</td>
              <td>{{date('M d, Y',strtotime($intransaction['dateOfUse']))}}</td>
              <td>{{$intransaction['created_at']->format('M d, Y')}}</td>
              <td><label class="label label-info">{{$intransaction['status']}}</label></td>
              <td><a href="{{url('made-to-orders/'.$intransaction['id'])}}" class="btn btn-primary btn-sm">View Order</a></td>
            </tr>
            @else
            <tr>
              <td colspan="6"><i>You have no In-Transaction MTOs...</i></td>
            </tr>
            @endif
            @endforeach
           
          </table>
        </div>
      </div>
    </div>
  </div> -->


<!--   <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><b>In-Progress</b></h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <col width="70">
            <col width="200">
            <col width="120">
            <col width="170">
            <col width="140">
            <col width="100">
            <tr>
              <th>MTO ID</th>
              <th>Customer Name</th>
              <th>Date of Use</th>
              <th>Request Placed at:</th>
              <th>Status</th>
              <th></th>
            </tr>
            @foreach($inprogress as $inprog)
            @if(!empty($inprog['status']))
            <tr>
              <td>dfdsafaf</td>
              <td>{{$inprog['id']}}</td>
              <td>{{$inprog->customer['fname'].' '.$inprog->customer['lname']}}</td>
              <td>{{date('M d, Y',strtotime($inprog['dateOfUse']))}}</td>
              <td>{{$inprog['created_at']->format('M d, Y')}}</td>
              <td><label class="label label-info">{{$inprog['status']}}</label></td>
              <td><a href="{{url('made-to-orders/'.$inprog['id'])}}" class="btn btn-primary btn-sm">View Order</a></td>
            </tr>
            @else
            <tr>
              <td colspan="6"><i>You have no In-Progress MTOs...</i></td>
            </tr>
            @endif
            @endforeach
           
          </table>
        </div>
      </div>
    </div>
  </div> -->
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

</script>

@endsection
