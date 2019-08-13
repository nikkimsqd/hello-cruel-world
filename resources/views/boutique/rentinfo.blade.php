@extends('layouts.boutique')
@extends('boutique.sections') 

@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><b>RENT DETAILS</b></h3>
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

              <h4><b>Rent ID: {{$rent['rentID']}}</b></h4>
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
              @if($measurements != null)
                <a href="" data-toggle="modal" data-target="#measurementsModal">View measurements here</a>
              @else
                <a href="" data-toggle="modal" data-target="#requestMeasurementsModal">Ask client for measurements here</a>
              @endif
              <!-- foreach(measurements as mName => measurement)
              <h4>mName: <b>{measurement inches</b></h4>
              endforeach -->

              <!-- <hr>
              <h4>Status: 
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
          <!-- <a href="{{url('rents')}}" class="btn btn-default">Back to Rents</a> -->
          @if($rent['orderID'] != null)
          <!-- <a href="{{url('orders/'.$rent['orderID'])}}" class="btn btn-primary">View Order Details</a> -->
          @endif
          </form>
        </div>
      </div>

      <!-- RENT ORDER DETAILS ================================================================ -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><b>ORDER DETAILS</b></h3>
        </div>

        <div class="box-body">
          <div class="col-md-12"> 
            <h4><b>Order ID: {{$rent->order['id']}}</b></h4>
            <h4>Customer Name: <b>{{$rent->order->customer['fname'].' '.$rent->order->customer['lname']}}</b></h4>
            <h4>Boutique Name: <b>{{$rent->order->boutique['boutiqueName']}}</b></h4>
            <h4>Delivery Address: <b>{{$rent->order->address['completeAddress']}}</b></h4>
            <h4>Status: 
              @if($rent->order['status'] == "Pending")
              <span class="label label-warning">{{$rent->order['status']}}</span>

              @elseif($rent->order['status'] == "In-Progress")
              <span class="label label-warning">{{$rent->order['status']}}</span>

              @elseif($rent->order['status'] == "For Alterations")
              <span class="label label-info">{{$rent->order['status']}}</span>

              @elseif($rent->order['status'] == "For Pickup")
              <span class="label bg-navy">{{$rent->order['status']}}</span>

              @elseif($rent->order['status'] == "For Delivery")
              <span class="label bg-olive">{{$rent->order['status']}}</span>

              @elseif($rent->order['status'] == "On Delivery")
              <span class="label bg-maroon">{{$rent->order['status']}}</span>

              @elseif($rent->order['status'] == "Delivered")
              <span class="label label-success">{{$rent->order['status']}}</span>

              @elseif($rent->order['status'] == "Completed")
              <span class="label label-success">{{$rent->order['status']}}</span>

              @elseif($rent->order['status'] == "On Rent")
              <span class="label label-info">{{$rent->order['status']}}</span>
              @endif
            </h4>
            <!-- <h4>Order Type: 
              <b>RENT</b>
              <h4>Date Item will be used: <b>{{date('M d, Y',strtotime($rent['dateToUse']))}}</b></h4>
            </h4> -->
            <br>

              <table class="table table-striped">
                <thead>
                <tr>
                  <th>Qty</th>
                  <th>Product Name</th>
                  <th>Product Description</th>
                  <th>Rent Price</th>
                </tr>
                </thead>
                <tr>
                  @if($rent->product != null)
                  <td>1</td>
                  <td>{{$rent->product['productName']}}</td>
                  <td>{{$rent->product['productDesc']}}</td>
                  <td>₱{{$rent->product->rentDetails['price']}}</td>
                  @else
                  <td>1</td>
                  <td>{{$rent->set['setName']}}</td>
                  <td>{{$rent->set['setDesc']}}</td>
                  <td>₱{{$rent->set->rentDetails['price']}}</td>
                  @endif
                </tr>
              </table><br><br>
          </div>

          <div class="col-md-4" style="text-align: right">

            <table class="table">
              <col width="162">
              <col width="130">
              <tr>
                <th>Subtotal</th>
                <td>₱{{$rent->order['subtotal']}}</td>
              </tr>
              @if($rent->product != null)
              <tr>
                <th>Cashban</th>
                <td>₱{{$rent->rentDetails['depositAmount']}}</td>
              </tr>
              @else
              <tr>
                <th>Cashban</th>
                <td>₱{{$rent->set->rentDetails['depositAmount']}}</td>
              </tr>
              @endif
              <tr>
                <th>Delivery Fee</th>
                <td>₱{{$rent->order['deliveryfee']}}</td>
              </tr>
              <tr>
                <th>Total</th>
                <td>₱{{$rent->order['total']}}</td>
              </tr>
              <tr>
                <th>Payment Status</th>
                @if($rent->order['paymentStatus'] == "Not Yet Paid")
                  <td><span class="label label-danger">{{ $rent->order['paymentStatus']}}</span></td>
                @else
                  <td><span class="label label-success">{{ $rent->order['paymentStatus']}}</span></td>
                @endif
              </tr>
            </table>
          </div>
        </div>
        
        <div class="box-footer" style="text-align: right;">
          <!-- <a class="btn btn-default" href="{{url('rents/'.$rent['rentID'])}}"> Back to Rent Details</a> -->
        @if($rent->order['paymentStatus'] == "Paid" && $rent->order['status'] == "In-Progress" && $rent->order['cartID'] != null)
          <a class="btn btn-primary" href="" data-toggle="modal" data-target="#forPickupModal"> For Pickup</a>
        @elseif($rent->order['paymentStatus'] == "Paid" && $rent->order['status'] == "In-Progress" && $rent->order['cartID'] == null)
          <a class="btn btn-primary" href="" data-toggle="modal" data-target="#forAlterationsModal"> Set Date for Fittings</a>
        @elseif($rent->order['status'] == "For Alterations" && $rent->order['cartID'] == null)
          <a class="btn btn-primary" href="" data-toggle="modal" data-target="#forPickupModal"> For Pickup</a>
        @elseif($rent->order['paymentStatus'] == "Not Yet Paid" && $rent->order['status'] == "In-Progress")
          <input type="submit" value="For Pickup" class="btn btn-primary" disabled>
        @elseif($rent->order['paymentStatus'] == "Not Yet Paid" && $rent->order['status'] == "In-Progress")
          <input type="submit" value="For Alterations" class="btn btn-primary" disabled>
        @elseif($rent->order['status'] == "On Rent")
          <a href="{{url('rentReturned/'.$order['rentID'])}}" class="btn btn-primary">Item Returned</a>
        @endif
        </div>

      </div>
    </div>
  </div>
</section>



<div class="modal fade" id="forAlterationsModal" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title"><b>Set fitting schedule</b></h3>
          </div>

          <div class="modal-body">
            <p>Set date for fitting:</p>
            <form action="{{url('forAlterations')}}" method="post">
              {{csrf_field()}}
              <input type="text" name="alterationDateStart" id="alterationDateStart" class="form-control" placeholder="Set start date" required>
              <input type="text" name="alterationDateEnd" id="alterationDateEnd" class="form-control" placeholder="Set end date" required>
              <input type="text" name="orderID" value="{{$rent->order['id']}}" hidden>
          </div>

          <div class="modal-footer">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Confirm">
          </form>
          </div>
      </div> 
    </div>
</div>

<!-- REQUEST MEASUREMENT -->
<div class="modal fade" id="requestMeasurementsModal" role="dialog">
    <div class="modal-dialog modal-md">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title"><b>Request for Measurements</b></h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <form action="{{url('requestMeasurement')}}" method="post">
              {{csrf_field()}}
            <!-- <div class="form-group">
              Enter category count:
              <input type="text" id="category-count" class="form-control">
              <a class="count-submit">Enter</a>
            </div> -->
            <input type="text" name="biddingID" value="{{$rent['id']}}" hidden>


            <div class="form-group" id="select-div">
              <select name="category[]" id="category-select" class="form-control">
                <option selected></option>
                @foreach($categories as $category)
                <option value="{{$category['id']}}">{{$category['categoryName']}}</option>
                @endforeach
              </select><br>

              <div class="col-md-12" id="measurement-input" style="column-count: 2">

              </div>
            </div>

            <div class="form-group">
              <a id="addnew"><i class="fa fa-plus"></i> Request another</a>
              <!-- <input type="text" id="addnew" >Request another -->
              <!-- <select class="form-control"></select> -->
            </div>

          </div>

          <div class="modal-footer">
            <input type="submit" class="btn essence-btn" value="Place Request">
            <!-- <input type="" class="btn btn-danger" data-dismiss="modal" value="Cancel"> -->
          </form>
          </div>
      </div> 
    </div>
</div>

<!-- VIEW MEASUREMENTS -->
<div class="modal fade" id="measurementsModal" role="dialog">
    <div class="modal-dialog modal-md">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Measurements Submitted</b></h4>
          </div>

          <div class="modal-body">
                <!-- <p><b>Measurements Submitted:</b></p> -->
                @if($rent['measurementID'] != null)
                @foreach($measurements as $measurement)
                  @foreach($measurement as $person)
                  @if(!is_array($person)) <!-- filter if naay array si person -->
                    @foreach($person as $name => $personData)
                    @if(is_object($personData)) <!-- filter if naay object si personData -->
                      <h4><b>{{strtoupper($name)}}</b></h4>
                      <?php $personDataArray = (array) $personData; ?> <!-- convert object to array para ma access -->
                      @foreach($personDataArray as $measurementName => $dataObject) <!-- get name and data -->
                        <?php $dataArray = (array) $dataObject; ?> <!-- convert to array gihapon kay object pa ang variable -->
                        @foreach($dataArray as $dataName => $data)
                            <label>{{$measurementName}}: &nbsp; {{$data}}"</label><br>
                        @endforeach
                      @endforeach
                    @endif
                    <hr>
                    @endforeach
                  @else
                      <label><b>Name:</b> </label><br>
                  @endif
                  @endforeach
                @endforeach
                @endif
          </div>

          <div class="modal-footer">
            <!-- <input type="submit" class="btn essence-btn" value="Place Request"> -->
            <input type="submit" class="btn essence-btn" value="Cancel">
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


var dateToday = new Date();
var dateTomorrow = new Date();
dateTomorrow.setDate(dateToday.getDate()+1);
// dateTomorrow.setDate(dateToday.getDate()+1);

$('#alterationDateStart').datepicker({
  startDate: dateTomorrow
});

var dateStart = $('#alterationDateStart').val();

$('#alterationDateEnd').datepicker({
  startDate: dateTomorrow //dapat mag start sa d day after sa startDate
});


</script>
@endsection