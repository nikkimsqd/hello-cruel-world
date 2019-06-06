@extends('layouts.boutique')
@extends('boutique.sections') 

@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">MTO ID: {{$mto['id']}}</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <?php 
                $measurements = json_decode($mto->measurement['data'])
              ?>

              <label>Customer Name:</label>
              <h4>{{$mto->customer['fname'].' '.$mto->customer['lname']}}</h4>

              <label>Date request placed:</label>
              <h4>{{$mto['created_at']->format('M d, Y')}}</h4>

              <label>Date of item's use:</label>
              <h4>{{date('M d, Y',strtotime($mto['dateOfUse']))}}</h4>

              <label>Customer's Notes/Instructions:</label>
              <h4>{{$mto['notes']}}</h4>

              <label>Customer's Height:</label>
              <h4>{{$mto['height']}}</h4>

              <label>Budget:</label>
              <h4>{{number_format($mto['budget'])}}</h4>

              <label>Status:</label><br>
              @if($mto['status'] == "Pending")
                <label class="label label-warning">{{$mto['status']}}</label><br><br>

              @elseif($mto['status'] == "In-Transaction")
                <label class="label bg-teal">{{$mto['status']}}</label><br><br>
              
              @elseif($mto['status'] == "In-Progress")
                <label class="label label-info">{{$mto['status']}}</label><br><br>
              
              @elseif($mto['status'] == "For Pickup")
                <label class="label bg-navy">{{$mto['status']}}</label><br><br>
              
              @elseif($mto['status'] == "For Delivery")
                <label class="label bg-olive">{{$mto['status']}}</label><br><br>
              
              @elseif($mto['status'] == "On Delivery")
                <label class="label bg-maroon">{{$mto['status']}}</label><br><br>

              @elseif($mto['status'] == "Completed")
                <label class="label label-success">{{$mto['status']}}</label><br><br>

              @elseif($mto['status'] == "Declined")
                <label class="label label-danger">{{$mto['status']}}</label><br><br>
              @endif

              <label>Payment Status</label><br>
              @if($mto['paymentStatus'] == "Not Yet Paid")
              <h4 class="label label-danger">{{$mto['paymentStatus']}}</h4>
              @else
              <h4 class="label label-success">{{$mto['paymentStatus']}}</h4> &nbsp;
              <a href="{{url('get-paypal-transaction/'.$mto['paypalOrderID'])}}">View Payment Info</a>
              @endif <br><br>
            </div>

            <div class="col-md-6">
              <label>Customer's Measurements:</label>
              <div class="row">
                <div class="col-md-4" style="text-align: right;">
                  @foreach($measurementNames as $measurementName)
                   
                  <h4>{{$measurementName['mName']}} :</h4>
                      
                  @endforeach
                </div>
                <div class="col-md-4 measurements">
                  @foreach($measurements as $meas)
                    <h4>{{$meas}} inches</h4>
                  @endforeach
                </div>
              </div>

              @if($mto['deliveryAddress'] != null)
                <div class="row">
                  <div class="col-md-4">
                    <label>Delivery Address: </label>
                  </div>
                  <div class="col-md-6">
                    <h4>{{$mto['deliveryAddress']}}</h4>
                  </div>
                </div>
              @endif

              @if($mto['finalPrice'] != null)
                <div class="row">
                  <div class="col-md-3">
                    <label>Final Price: </label>
                  </div>
                  <div class="col-md-3">
                    <h4>{{number_format($mto['finalPrice'])}}</h4>
                  </div>
                </div>
              @endif

              @if($mto['total'] != null)
                <div class="row">
                  <div class="col-md-3">
                    <label>Subtotal: </label>
                  </div>
                  <div class="col-md-3">
                    <h4>{{number_format($mto['subtotal'])}}</h4>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <label>Delivery Fee: </label>
                  </div>
                  <div class="col-md-3">
                    <h4>{{number_format($mto['deliveryFee'])}}</h4>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <label>Total: </label>
                  </div>
                  <div class="col-md-3">
                    <h4>{{number_format($mto['total'])}}</h4>
                  </div>
                </div>
              @endif
              
            </div>
          </div>

            <div class="row">
              <div class="col-md-5">
               
                    <img src="{{ asset('/uploads/').$mto->productFile['filename'] }}" style="width:95%; height: auto; object-fit: cover;margin: 10px;">
              </div>
            </div>

            @if($mto['finalPrice'] == null)
              @if($mto['offerPrice'] != null)
              <div class="row">
                <div class="col-md-3">
                  <h4>Your current offer: </h4>
                </div>
                <div class="col-md-3">
                  <h4>{{number_format($mto['offerPrice'])}}</h4>
                </div>
              </div>
              @endif
            <div class="row">
              <div class="col-md-6">
                <form action="{{url('/addOfferPrice')}}" method="post">
                  {{csrf_field()}}
                  <label>Submit an offer:</label>
                  <input type="number" name="offerPrice" class="input form-control"><br>
                  <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>

                  <input type="submit" name="btn_submit" value="Place Offer" class="btn btn-primary">
                </form>
              </div>
            </div>
            @endif
        </div>

        <div class="box-footer" style="text-align: right;">
            <a href="{{url('made-to-orders')}}" class="btn btn-default">Back to MTOs</a>
          @if($mto['status'] == "Pending")
            <a href="" data-toggle="modal" data-target="#declineModal" class="btn btn-danger">Decline Request</a>
            <a href="{{url('halfapproveMto/'.$mto['id'])}}" class="btn btn-primary">Contact customer for negotiations</a>
          @elseif($mto['status'] == "In-Transaction")
            @if($mto['finalPrice'] != null)
            <a href="" data-toggle="modal" data-target="#declineModal" class="btn btn-danger">Decline Request</a>
            <a href="{{url('/acceptMto/'.$mto['id'])}}" class="btn btn-success">Accept Request</a>
            @else
            <a href="" data-toggle="modal" data-target="#declineModal" class="btn btn-danger">Decline Request</a>
            <input type="submit" class="btn btn-success" disabled value="Accept Request">
            @endif
          @elseif($mto['status'] == "In-Progress")
            @if($mto['paymentStatus'] == "Not Yet Paid")
              <input type="submit" class="btn btn-primary" value="For Pickup" disabled>
            @else
              <a href="" class="btn btn-primary" data-toggle="modal" data-target="#forPickupModal">For Pickup</a>
            @endif
          @endif
        </div>

      </div>
    </div>
  </div>
</section>


<!-- MODAL -->
<div class="modal fade" id="forPickupModal" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <p>Submit MTO for Pickup?</p>
            <!-- <input type="text" name="orerID" value="{{$mto['id']}}" hidden> -->
          </div>

          <div class="modal-footer">
            <a href="{{url('submitMTO/'.$mto['id'])}}" class="btn btn-primary">Confirm</a>
          </div>
      </div> 
    </div>
</div>


<!-- DECLINE RENT -->
<div class="modal fade" id="declineModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Submit a reason</b></h3>
      </div>

      <div class="modal-body">
        <form action="{{url('/declineMto')}}" method="post">
        {{csrf_field()}}
        <textarea name="reason" rows="3" cols="50" class="input form-control" placeholder="Place your reason here"></textarea>
        <input type="text" name="mtoID" value="{{$mto['id']}}" hidden>
      </div>

      <div class="modal-footer">
        <input type="submit" name="btn_sumbit" class="btn btn-success" value="Submit">
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<style type="text/css">
  h4{ margin-top: 0;}
  .borderless td, .borderless th {border: none;}
  .measurements {padding-left: 0;}
</style>




@endsection


@section('scripts')

<script type="text/javascript">
  //scripts here
</script>

@endsection

