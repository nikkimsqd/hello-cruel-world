@extends('layouts.boutique')
@extends('boutique.layout') 

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-warning">
      <div class="box-header">
        <h3 class="box-title">Rent ID: {{ $rent['rentID'] }}</h3>
      </div>
      <!-- /.box-header -->

      <div class="box-body">
        <div class="row">
        <div class="col-md-6">
        @if($rent['status'] == "Pending")
        <form action="/hinimo/public/approveRent" method="post">
        @elseif($rent['status'] == "In-Progress")
        <form action="/hinimo/public/updateRentInfo" method="post">
  
        @endif
          {{csrf_field()}}

          <label>Product Name</label>
          <h4>{{ $rent->product['productName'] }}</h4>

          <label>Boutique Name</label>
          <h4>{{ $rent->product->owner['boutiqueName'] }}</h4>

          <label>Customer Name</label>
          <h4>{{ $rent->customer['fname']}}</h4>

          <label>Location item will be used</label>
          <h4>{{ $rent['locationToBeUsed']}}</h4>

          <label>Date Item will be used</label>
          <h4>{{ $rent['dateToUse']}}</h4>
          </div>
          <div class="col-md-6">

          <label>Address of Delivery</label>
          <h4>{{ $rent->address['completeAddress']}}</h4>

          <label>Request placed at</label>
          <h4>{{ $rent['created_at']->format('M d, Y')}}</h4>

          @if($rent['approved_at'] != null)
          <label>Request Approved at</label>
          <h4>{{ $rent['approved_at']->format('M d, Y')}}</h4>
          @endif

          <label>Staus</label><br>
          @if($rent['status'] == "Pending")
          <h4 class="label label-warning">{{ $rent['status']}}</h4>
          @elseif($rent['status'] == "In-Progress")
          <h4 class="label label-info">{{ $rent['status']}}</h4>
          @elseif($rent['status'] == "Declined")
          <h4 class="label label-danger">{{ $rent['status']}}</h4>
          @else
          <h4 class="label label-warning">{{ $rent['status']}}</h4>
          @endif
          <br><br>
          @if($rent['dateToBeReturned'] != null)
          <label>Item must be returned on or before:</label>
          <h4>{{ $rent['dateToBeReturned']}}</h4>
          @endif
        </div>
        </div>
        <div class="row">
          <div class="col-md-6" style="align-items: center;">
            <?php $counter = 1; ?>
            @foreach( $rent->product->productFile as $image)
            @if($counter == 1)
              <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: auto; object-fit: cover;margin: 10px;">
            @else
            @endif
            <?php $counter++; ?>
            @endforeach
          </div>
          @if($rent['status'] == "In-Progress" && $rent['dateToBeReturned'] == null)
          <div class="col-md-6">
            <br><br><br>
            <div class="form-group">
                <label>Product should be returned on or before:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" name="dateToBeReturned" class="form-control pull-right" id="datepicker" required>
                </div>
              </div>
          </div>
          @endif
        </div>
      </div>

      <div class="box-footer" style="text-align: right;">
          <input type="text" name="rentID" value="{{$rent['rentID']}}" hidden>
          @if($rent['status'] == "Pending")
          <input type="submit" name="btn_submit" class="btn btn-success" value="Accept Request">
          <a href="" data-toggle="modal" data-target="#declineModal{{$rent['rentID']}}" class="btn btn-danger">Decline Request</a>
          @elseif($rent['status'] == "In-Progress")
          <a href="/hinimo/public/rents#in-progress" class="btn btn-default">Back to Rents</a>
            @if($rent['dateToBeReturned'] == null)
            <input type="submit" name="btn_submit" class="btn btn-success" value="Update Rent">
            @else
            <!-- <input type="submit" name="btn_submit" class="btn btn-primary" value="For Delivery"> -->
            <a href="" data-toggle="modal" data-target="#makeOrderModal{{$rent['rentID']}}" class="btn btn-primary">For Delivery</a>
            @endif
          @endif
        </form>
      </div>

    </div>
  </div>
</div>


<!-- DECLINE RENT -->
<div class="modal fade" id="declineModal{{$rent['rentID']}}" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Submit a reason</b></h3>
      </div>

      <div class="modal-body">
        <form action="/hinimo/public/declineRent" method="post">
        {{csrf_field()}}
        <textarea name="reason" rows="3" cols="50" class="input form-control" placeholder="Place your reason here"></textarea>
      </div>

      <div class="modal-footer">
        <input type="text" name="rentID" value="{{$rent['rentID']}}" hidden>
        <input type="submit" name="btn_sumbit" class="btn btn-success" value="Submit">
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- MAKE ORDER -->
<div class="modal fade" id="makeOrderModal{{$rent['rentID']}}" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Submit for delivery</b></h3>
      </div>

      <div class="modal-body">
        <form action="/hinimo/public/makeOrderforRent" method="post">
        {{csrf_field()}}
          <label>Product Name</label>
          <h4>{{ $rent->product['productName'] }}</h4>

          <label>Customer Name</label>
          <h4>{{ $rent->customer['fname']}}</h4>

          <label>Address for delivery (Customer's address)</label>
          <h4>{{ $rent->address['completeAddress'] }}</h4>

          <label>Item must be returned on or before:</label>
          <h4>{{ $rent['dateToBeReturned']}}</h4>
      </div>

      <div class="modal-footer">
        <label>Are these details correct?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="rentID" value="{{$rent['rentID']}}" hidden>
        <input type="submit" name="btn_sumbit" class="btn btn-success" value="Submit for Delivery">
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<style type="text/css">
  h4{ margin-top: 0;}
</style>




@endsection


@section('scripts')

<script type="text/javascript">
//Date picker
// $('#datepicker').datepicker({
//   autoclose: true
// })
</script>

@endsection

