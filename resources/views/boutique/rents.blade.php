@extends('layouts.boutique')

@section('titletext')
  Boutique de Filipina
@endsection

@section('page_title')
Rents
@endsection

@section('content')

<div class="row">
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
          @foreach($rents as $rent)
          @if($rent['status'] === "Pending")
          <tr>
            <td>{{$rent['rentID']}}</td>
            <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
            <td>{{$rent['created_at']->format('M d, Y')}}</td>
            <td><span class="label label-warning">Pending</span></td>
            <td>
                <input type="submit" class="btn btn-primary btn-sm" value="View Order" data-toggle="modal" data-target="#pendingModal{{$rent['rentID']}}">
            </td>
          </tr>
         
          @endif
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div> <!-- table row -->
<br><br>

<div class="row">
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
          @foreach($rents as $rent)
          @if($rent['status'] == "In-Progress")
          <tr>
            <td>{{$rent['rentID']}}</td>
            <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
            <td>{{$rent['created_at']->format('M d, Y')}}</td>
            <td><span class="label label-info">In-Progress</span></td>
            <td><input type="submit" class="btn btn-primary btn-sm" value="View Order" data-toggle="modal" data-target="#inprogressModal{{$rent['rentID']}}"></td>
          </tr>
          @endif
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div> <!-- table row -->
<br><br>

<div class="row">
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
          @foreach($rents as $rent)
          @if($rent['status'] == "Completed" || $rent['status'] == "Declined")
          <tr>
            <td>{{$rent['rentID']}}</td>
            <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
            <td>{{$rent['created_at']->format('M d, Y')}}</td>
            <td>
              @if($rent['status'] == "Completed")
              <span class="label label-success">Completed</span>
              @elseif($rent['status'] == "Declined")
              <span class="label label-danger">Declined</span>
              @endif
            </td>
            <td><input type="submit" class="btn btn-sm-primary" value="View Order" data-toggle="modal" data-target="#myModal"></td>
          </tr>
          @elseif($rent['status'] != "Completed")
          <tr>
            <td colspan="5"><i>You have no rent history...</i></td>
            @break
          </tr>
          @endif
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div> <!-- table row -->



<!-- MODALS HEREE -->
<!-- PENDING MODAL -->
@foreach($rents as $rent)
<div class="modal fade" id="pendingModal{{$rent['rentID']}}" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Rent Details</b></h3>
      </div>

      <div class="modal-body">
        <form action="approveRent" method="post">
        {{csrf_field()}}
        <table class="table">
          <tr>
            <td><label>Rent ID:</label></td>
            <td>{{$rent['rentID']}}</td>
          </tr>
          <tr>
            <td><label>Customer Name:</label></td>
            <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
          </tr>
          <tr>
            <td><label>Order Placed at</label></td>
            <td>{{$rent['created_at']->format('M d, Y')}}</td>
          </tr>
          <tr>
            <td><label>Order Status:</label></td>
            <td>{{$rent['status']}}</td>
          </tr>
          <tr>
            <td><label>Item ID</label></td>
            <td>{{$rent->product->productID}}</td>
          </tr>
          <tr>
            <td><label>Item:</label></td>
            <td>
              <!-- <img src="long/m.jpg"> -->
             <?php 
                  $counter = 1;
              ?>
                            
              @foreach($rent->product->productFile as $image)
              @if($counter == 1)    
              <img src="{{ asset('/uploads').$image['filename'] }}">
              @else
              @endif
              <?php $counter++; ?>
              @endforeach
            </td>
          </tr>
        </table>

      </div>

      <div class="modal-footer">
        <input type="text" name="rentID" value="{{$rent['rentID']}}" >
        <input type="submit" name="btn_sumbit" class="btn btn-success" value="Accept Order">
        </form>
       <!--  <form action="declineRent" method="post">
        {{csrf_field()}} -->
        <!-- <input type="text" name="rentID" value="{{$rent['rentID']}}" hidden>
        <input type="submit" name="btn_sumbit" class="btn btn-danger" value="Decline Request"> -->
        <!-- <button type="button" id="declineRequest" class="btn btn-danger" value="{{$rent['rentID']}}"  onclick="declineFunction()">Decline Request</button> -->
        <!-- </form> -->
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>
@endforeach



<!-- IN-PROGRESS MODAL -->
@foreach($rents as $rent)
<div class="modal fade" id="inprogressModal{{$rent['rentID']}}" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Rent Details</b></h3>
      </div>

      <div class="modal-body">
        <!-- <form action="approveRent" method="post"> -->
        {{csrf_field()}}
        <table class="table">
          <tr>
            <td><label>Rent ID:</label></td>
            <td>{{$rent['rentID']}}</td>
          </tr>
          <tr>
            <td><label>Customer Name:</label></td>
            <td>{{$rent->customer->lname.', '.$rent->customer->fname}}</td>
          </tr>
          <tr>
            <td><label>Order Placed at</label></td>
            <td>{{$rent['created_at']->format('M d, Y')}}</td>
          </tr>
          <tr>
            <td><label>Rent Status:</label></td>
            <td>{{$rent['status']}}</td>
          </tr>
          <tr>
            <td><label>Request Approved at:</label></td>
            <!-- <td>{{$rent['approved_at']}}</td> -->
            <td>{{date('M d, Y', strtotime($rent['approved_at']))}}</td>
          </tr>
          <tr>
            <td><label>Item ID</label></td>
            <td>{{$rent->product->productID}}</td>
          </tr>
          <tr>
            <td><label>Item:</label></td>
            <td>
              <!-- <img src="long/m.jpg"> -->
             <?php 
                  $counter = 1;
              ?>
                            
              @foreach($rent->product->productFile as $image)
              @if($counter == 1)    
              <img src="{{ asset('/uploads').$image['filename'] }}">
              @else
              @endif
              <?php $counter++; ?>
              @endforeach
            </td>
          </tr>
        </table>

      </div>

      <div class="modal-footer">
        <input type="text" name="rentID" value="{{$rent['rentID']}}" hidden>
        <input type="submit" name="btn_sumbit" class="btn btn-success" value="Accept Order">
        <!-- </form> -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel Order</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>
@endforeach


@endsection



@section('scripts')
<script type="text/javascript">

  // $('#pendingModal').on('shown.bs.modal', function (e) {
  //   alert("alert!");
  // });


  // function declineFunction() {
  //   var rentID = document.getElementById("declineRequest").value;
  //   console.log(document.getElementById("declineRequest").value);

  //   $.ajax({
  //    url: "declineRent/"+rentID,
  //   });

  // }



  
</script>
@endsection