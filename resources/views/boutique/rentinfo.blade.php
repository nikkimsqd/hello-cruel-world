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

              <h4>Customer Name: <b>{{$rent->customer['fname'].' '.$rent->customer['lname']}}</b></h4>
              <h4>Request placed at: <b>{{$rent['created_at']->format('M d, Y')}}</b></h4>
              <h4>Address of Delivery: <b>{{$rent->order->address['completeAddress']}}</b></h4>

              <hr>
              <h4><b>Rent Details</b></h4>
              <h4>Product Name: 
                @if($rent->product != null)
                  <b>{{$rent->product['productName']}}</b>
                @else
                  <b>{{$rent->set['setName']}}</b>
                @endif
              </h4>
              <h4>Date Item will be used: <b>{{date('M d, Y',strtotime($rent['dateToUse']))}}</b></h4>
              <h4>Item must be returned on or before: <b>{{date('M d, Y',strtotime($rent['dateToBeReturned']))}}</b></h4>
              <h4>Penalty Amount: 
                @if($rent->product != null)
                  <b>{{$rent->product->rentDetails['penaltyAmount']}}</b>
                @else
                  <b>{{$rent->set->rentDetails['penaltyAmount']}}</b>
                @endif
              </h4>

              <hr>
              <h4><b>Customer's Measurements Details</b></h4>
              @foreach($measurements as $mName => $measurement)
              <h4>{{$mName}}: <b>{{$measurement}} inches</b></h4>
              @endforeach

              <hr>
             <!--  <h4>Status: 
                @if($rent['status'] == "Pending")
                <span class="label label-warning">{{ $rent['status']}}</span>
                @elseif($rent['status'] == "In-Progress")
                <span class="label label-info">{{ $rent['status']}}</span>
                @elseif($rent['status'] == "Declined")
                <span class="label label-danger">{{ $rent['status']}}</span>
                @elseif($rent['status'] == "On Delivery")
                <span class="label label-primary">{{ $rent['status']}}</span>
                @elseif($rent['status'] == "For Pickup")
                <span class="label bg-teal">{{$rent['status']}}</span>
                @elseif($rent['status'] == "For Delivery")
                <span class="label bg-olive">{{$rent['status']}}</span>
                @elseif($rent['status'] == "On Delivery")
                <span class="label label-navy">{{$rent['status']}}</span>
                @elseif($rent['status'] == "On Rent")
                <span class="label bg-maroon">{{$rent['status']}}</span><
                @else
                <span class="label label-default">{{ $rent['status']}}</span>
                @endif
              </h4> -->

              <br><br>
            </div>

            <div class="col-md-6">
              <?php $counter = 1; ?>
              @if($rent->product != null)
                @foreach($rent->product->productFile as $image)
                @if($counter == 1)
                  <img src="{{ asset('/uploads').$image['filename'] }}" style="width:95%; height: auto; object-fit: cover;margin: 10px;">
                @endif
                <?php $counter++; ?>
                @endforeach
              @else
                @foreach($rent->set->items as $setItem)
                @foreach($setItem->product->productFile as $image)
                @if($counter == 1)
                  <img src="{{ asset('/uploads').$image['filename'] }}" style="width:95%; height: auto; object-fit: cover;margin: 10px;">
                @endif
                <?php $counter++; ?>
                @endforeach
                @endforeach
              @endif
              <!-- <input type="text" name="customerID" value="{{$rent->customer['id']}}" hidden> -->
            </div>
          </div>

        </div>

        <div class="box-footer" style="text-align: right;">
          <input type="text" name="rentID" value="{{$rent['rentID']}}" hidden>
          <a href="{{url('rents')}}" class="btn btn-default">Back to Rents</a>
          @if($rent['orderID'] != null)
          <a href="{{url('orders/'.$rent['orderID'])}}" class="btn btn-primary">View Order Details</a>
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

$('.transactions').addClass("active");
$('.rents').addClass("active");

</script>
@endsection