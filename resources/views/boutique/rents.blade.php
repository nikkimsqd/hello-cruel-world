@extends('layouts.boutique')
@extends('boutique.sections') 

@section('content')

<div class="row" id="pendings">
  <div class="col-md-12">
    <div class="box box-warning">
      <div class="box-header">
        <h3 class="box-title"><b>PENDING RENT REQUESTS</b></h3>

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
            <th>Rent ID</th>
            <th>Customer Name</th>
            <th>Request Placed at:</th>
            <th>Status</th>
            <th></th>
          </tr>
          @foreach($pendings as $pending)
          @if(!empty($pending['status']))
          <tr>
            <td>{{$pending['rentID']}}</td>
            <td>{{$pending->customer->lname.', '.$pending->customer->fname}}</td>
            <td>{{$pending['created_at']->format('M d, Y')}}</td>
            <td><span class="label label-warning">Pending</span></td>
            <td><a href="rents/{{$pending['rentID']}}" class="btn btn-primary btn-sm">View Order</a></td>
          </tr>
          @else
          <tr>
            <td colspan="5"><i>You have no pending requests...</i></td>
          </tr>
          @endif
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div> <!-- table row -->
<br><br>

<div class="row" id="in-progress">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"><b>IN-PROGRESS RENTS</b></h3>

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
            <th>Rent ID</th>
            <th>Customer Name</th>
            <th>Request Approved at:</th>
            <th>Status</th>
            <th></th>
          </tr>
          @foreach($inprogress as $inprog)
          @if(!empty($inprog['status']))
          <tr>
            <td>{{$inprog['rentID']}}</td>
            <td>{{$inprog->customer->lname.', '.$inprog->customer->fname}}</td>
            <td>{{$inprog['created_at']->format('M d, Y')}}</td>
            <td><span class="label label-info">In-Progress</span></td>
            <td><a href="rents/{{$inprog['rentID']}}" class="btn btn-primary btn-sm">View Order</a></td>
          </tr>
          @endif
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div> <!-- table row -->
<br><br>

<div class="row" id="history">
  <div class="col-md-12">
    <div class="box box-danger">
      <div class="box-header">
        <h3 class="box-title"><b>RENT HISTORY</b></h3>

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
            <th>Rent ID</th>
            <th>Customer Name</th>
            <th>Completed at:</th>
            <th>Status</th>
            <th></th>
          </tr>
          @foreach($histories as $history)
          @if(!empty($history['status']))
          <tr>
            <td>{{$history['rentID']}}</td>
            <td>{{$history->customer->lname.', '.$history->customer->fname}}</td>
            <td>{{$history['created_at']->format('M d, Y')}}</td>
            <td>
              @if($history['status'] == "Completed")
              <span class="label label-success">Completed</span>
              @elseif($history['status'] == "Declined")
              <span class="label label-danger">Declined</span>
              @endif
            </td>
            <td><input type="submit" class="btn btn-sm-primary" value="View Order" data-toggle="modal" data-target="#myModal"></td>
          </tr>
          @else
          <tr>
            <td colspan="5"><i>You have no rent history...</i></td>
          </tr>
          @endif
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div> <!-- table row -->

@endsection



@section('scripts')
<script type="text/javascript">
  
</script>
@endsection