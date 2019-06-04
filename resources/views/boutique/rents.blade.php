@extends('layouts.boutique')
@extends('boutique.sections') 

@section('content')

<section class="content">
  <div class="row" id="rents">
    <div class="col-md-12">
      <div class="box box-default">

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
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
            @foreach($rents as $rent)
            @if(!empty($rent['status']))
            <tr>
              <td>{{$rent['rentID']}}</td>
              <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
              <td>{{$rent['created_at']->format('M d, Y')}}</td>
              @if($rent['status'] == "Pending")
                <td><span class="label label-warning">{{$rent['status']}}</span></td>

              @elseif($rent['status'] == "In-Progress")
                <td><span class="label label-info">{{$rent['status']}}</span></td>

              @elseif($rent['status'] == "For Pickup")
                <td><span class="label bg-teal">{{$rent['status']}}</span></td>

              @elseif($rent['status'] == "For Delivery")
                <td><span class="label bg-olive">{{$rent['status']}}</span></td>

              @elseif($rent['status'] == "On Delivery")
                <td><span class="label label-navy">{{$rent['status']}}</span></td>

              @elseif($rent['status'] == "On Rent")
                <td><span class="label bg-maroon">{{$rent['status']}}</span></td>

              @elseif($rent['status'] == "Completed")
                <td><span class="label label-success">{{$rent['status']}}</span></td>

              @elseif($rent['status'] == "Declined")
                <td><span class="label label-danger">{{$rent['status']}}</span></td>
              @endif
              <td><a href="rents/{{$rent['rentID']}}" class="btn btn-default btn-sm">View Order</a></td>
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

  <!-- @if(count($inprogress) > 0)
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
              <td>{{$inprog['approved_at']->format('M d, Y')}}</td>
              <td><span class="label label-info">In-Progress</span></td>
              <td><a href="rents/{{$inprog['rentID']}}" class="btn btn-primary btn-sm">View Order</a></td>
            </tr>
            @endif
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div> 
  <br><br>
  @endif -->

 <!--  @if(count($ondeliveries) > 0)
  <div class="row" id="history">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><b>ON DELIVERY</b></h3>

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
            <tr>
              <th>Rent ID</th>
              <th>Customer Name</th>
              <th>Completed at:</th>
              <th>Status</th>
              <th></th>
            </tr>
            @foreach($ondeliveries as $ondelivery)
            @if(!empty($ondelivery['status']))
            <tr>
              <td>{{$ondelivery['rentID']}}</td>
              <td>{{$ondelivery->customer->lname.', '.$ondelivery->customer->fname}}</td>
              <td>{{$ondelivery['created_at']->format('M d, Y')}}</td>
              <td><span class="label label-primary">On Delivery</span></td>
              <td><a href="rents/{{$ondelivery['rentID']}}" class="btn btn-default btn-sm">View Order</a></td>
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
  </div> 
  @endif -->

<!--   @if(count($histories) > 0)
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
              <td><a href="rents/{{$history['rentID']}}" class="btn btn-default btn-sm">View Order</a></td>
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
  </div>
  @endif -->
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

</script>
@endsection