@extends('layouts.boutique')
@extends('boutique.sections') 

@section('content')

<section class="content">
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

            <label>Address of Delivery</label>
            <h4>{{ $rent->address['completeAddress']}}</h4>

            <label>Request placed at</label>
            <h4>{{ $rent['created_at']->format('M d, Y')}}</h4>

            @if($rent['approved_at'] != null)
            <label>Request Approved at</label>
            <h4>{{ $rent['approved_at']->format('M d, Y')}}</h4>
            @endif

            <label>Status</label><br>
            @if($rent['status'] == "Pending")
            <h4 class="label label-warning">{{ $rent['status']}}</h4>
            @elseif($rent['status'] == "In-Progress")
            <h4 class="label label-info">{{ $rent['status']}}</h4>
            @elseif($rent['status'] == "Declined")
            <h4 class="label label-danger">{{ $rent['status']}}</h4>
            @elseif($rent['status'] == "On Delivery")
            <h4 class="label label-primary">{{ $rent['status']}}</h4>
            @elseif($rent['status'] == "For Pickup")
            <td><span class="label bg-teal">{{$rent['status']}}</span></td>
            @elseif($rent['status'] == "For Delivery")
            <td><span class="label bg-olive">{{$rent['status']}}</span></td>
            @elseif($rent['status'] == "On Delivery")
            <td><span class="label label-navy">{{$rent['status']}}</span></td>
            @elseif($rent['status'] == "On Rent")
            <td><span class="label bg-maroon">{{$rent['status']}}</span></td>
            @else
            <h4 class="label label-default">{{ $rent['status']}}</h4>
            @endif
            <br><br>

            </div>
            <div class="col-md-6">

            <label>Measurements</label>
            @foreach($measurements as $mName => $measurement)
              <h4>{{$mName.': '.$measurement}}</h4>
            @endforeach

            <label>Payment Status</label><br>
            @if($rent['paymentStatus'] == "Not Yet Paid")
            <h4 class="label label-danger">{{$rent['paymentStatus']}}</h4>
            @else
            <h4 class="label label-success">{{$rent['paymentStatus']}}</h4> &nbsp;
            <a href="{{url('get-paypal-transaction/'.$rent['paypalOrderID'])}}">View Payment Info</a>
            @endif <br><br>

            @if($rent['status'] == "In-Progress" && $rent['dateToBeReturned'] == null)
            <div class="form-group">
              <label>Item must be returned on or before:</label>
              <div class="col-md-6 input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" name="dateToBeReturned" class="form-control pull-right" id="datepicker" required>
              </div>
            </div>

            <div class="form-group">
              <label>Set Deposit Amount:</label>
              <div class="col-md-6 input-group">
                <input type="number" name="amountDeposit" class="form-control pull-right" required>
              </div>
            </div>

            <!-- <div class="form-group">
              <label>Set Penalty Amount: (if item is lost)</label>
              <div class="col-md-6 input-group date">
                <input type="number" name="amountPenalty" class="form-control pull-right" required>
              </div>
            </div> -->

            <div class="form-group">
              <label>Set Penalty Amount: (if item not returned on expected date)</label>
              <div class="col-md-6 input-group date">
                <input type="number" name="amountPenalty" class="form-control pull-right" required>
              </div>
            </div>

            @elseif($rent['dateToBeReturned'] != null)
            <label>Item must be returned on or before:</label>
            <h4>{{ $rent['dateToBeReturned']}}</h4>

            <label>Required Deposit Amount:</label>
            <h4>{{ $rent['amountDeposit']}}</h4>

            <label>Penalty Amount:</label>
            <h4>{{ $rent['amountPenalty']}}</h4>

            @endif
            <input type="text" name="customerID" value="{{$rent->customer['id']}}" hidden>

          </div>


          </div>
          <div class="row">
            <div class="col-md-6">
              <?php $counter = 1; ?>
              @foreach( $rent->product->productFile as $image)
              @if($counter == 1)
                <img src="{{ asset('/uploads').$image['filename'] }}" style="width:95%; height: auto; object-fit: cover;margin: 10px;">
              @endif
              <?php $counter++; ?>
              @endforeach

                <table class="table borderless">
                  <tr>
                    <td><label>Subtotal:</label></td>
                    <td>{{$rent->product['rentPrice']}}</td>
                  </tr>
                  <tr>
                    <td><label>Delivery Fee:</label></td>
                    <td>40</td>
                  </tr>
                  <tr><?php $total = $rent->product['rentPrice'] + 40; ?>
                    <td><label>Total:</label></td>
                    <td>{{$total}}</td>
                  </tr>
                </table>
            </div>
            
          </div>
        </div>

        <div class="box-footer" style="text-align: right;">
          <input type="text" name="rentID" value="{{$rent['rentID']}}" hidden>
          @if($rent['status'] == "Pending")
          <input type="submit" name="btn_submit" class="btn btn-success" value="Accept Request">
          <a href="" data-toggle="modal" data-target="#declineModal{{$rent['rentID']}}" class="btn btn-danger">Decline Request</a>
          @elseif($rent['status'] == "In-Progress")
          <a href="{{url('rents')}}" class="btn btn-default">Back to Rents</a>
            @if($rent['dateToBeReturned'] == null)
            <input type="submit" name="btn_submit" class="btn btn-success" value="Update Rent">
            @elseif($rent['paymentStatus'] == "Paid")
            <a href="" data-toggle="modal" data-target="#makeOrderModal{{$rent['rentID']}}" class="btn btn-primary">For Pickup</a>
            @endif
          @elseif($rent['status'] == "On Rent")
          <a href="{{url('rents')}}" class="btn btn-default">Back to Rents</a>
          <a href="{{url('rentReturned/'.$rent['rentID'])}}" class="btn btn-success">Product returned</a>
          @else
          <a href="{{url('rents')}}" class="btn btn-default">Back to Rents</a>
          @endif
          </form>
        </div>

      </div>
    </div>
  </div>
</section>



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
        <form action="{{url('/declinedRent')}}" method="post">
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
        <h3 class="modal-title"><b>Submit for Pickup</b></h3>
      </div>

      <div class="modal-body">
        <form action="{{url('/makeOrderforRent')}}" method="post">
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
        <input type="submit" name="btn_sumbit" class="btn btn-primary" value="Submit for Pickup">
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<style type="text/css">
  h4{ margin-top: 0;}
  .borderless td, .borderless th {border: none;}
  input[type="date"].form-control, input[type="time"].form-control, input[type="datetime-local"].form-control, input[type="month"].form-control{line-height: 20px;}
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

