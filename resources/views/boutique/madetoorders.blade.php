@extends('layouts.boutique')
@extends('boutique.sections')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
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

        <div class="box-body table-responsive no-padding">
          <table id="pending-table" class="table table-hover">
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
            @foreach($pendings as $pending)
            <tr>
              <td>{{$pending['id']}}</td>
              <td>{{$pending->customer['fname'].' '.$pending->customer['lname']}}</td>
              <td>{{date('M d, Y',strtotime($pending['dateOfUse']))}}</td>
              <td>{{$pending['created_at']->format('M d, Y')}}</td>
              <td><label class="label label-warning">{{$pending['status']}}</label></td>
              <td><a href="{{url('made-to-orders/'.$pending['id'])}}" class="btn btn-primary btn-sm">View Order</a></td>
            </tr>
            @endforeach
           
          </table>
        </div>
      </div>
    </div>
  </div> <!-- table row -->


  <!-- IN-TRANSACTIONS -->
  <div class="row">
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
        <!-- /.box-header -->

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
  </div> <!-- table row -->


  <div class="row">
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
        <!-- /.box-header -->

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
  </div> <!-- table row -->
</section>

@endsection

@section('scripts')

<script type="text/javascript">
$(function () {
    $('#pending-table').DataTable({
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
