@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">

      <div class="box direct-chat direct-chat-success collapsed-box" id="chat">
        <div class="box-header with-border">
          <h3 class="box-title">Chat with client</h3>
          <div class="box-tools pull-right">
            <!-- <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span> -->
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
        </div>

        <div class="box-body">

          <div class="direct-chat-messages">
            @foreach($chats as $chat)
              @if($chat['senderID'] != $id)
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">{{$chat->sender['fname'].' '.$chat->sender['lname']}}</span>
                    <span class="direct-chat-timestamp pull-left sender-time">{{ date('d M h:i a',strtotime($chat['created_at'])) }}</span>
                  </div>

                  <div class="direct-chat-text">
                    {{$chat['message']}}
                  </div>
                  <!-- /.direct-chat-text -->
                </div>


              @else
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                      <!-- <span class="direct-chat-name pull-right">{{$chat->sender->boutique['boutiqueName']}}</span> -->
                      <span class="direct-chat-timestamp pull-right">{{ date('d M h:i a',strtotime($chat['created_at'])) }}</span>
                    </div>

                    <div class="direct-chat-text">
                      {{$chat['message']}}
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
              @endif

            @endforeach

          </div>

        </div> <!-- /.box-body -->

        <div class="box-footer">
          <form action="{{url('bSendChat')}}" method="post">
            {{ csrf_field() }}
            <div class="input-group">
              <input type="text" name="message" placeholder="Type Message ..." class="form-control">
              <input type="text" name="orderID" value="{{$order['id']}}" hidden>
                  <span class="input-group-btn">
                    <input type="submit" name="btn_submit" class="btn btn-primary" value="Send">
                  </span>
            </div>
          </form>
        </div>
      </div>

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Order ID: {{$order['id']}}</h3>
        </div>

        <div class="box-body">
          <div class="col-md-12"> 
            <h4>Customer Name: <b>{{$order->customer['fname'].' '.$order->customer['lname']}}</b></h4>
            <h4>Boutique Name: <b>{{$order->boutique['boutiqueName']}}</b></h4>
            <h4>Delivery Address: <b>{{$order->address['completeAddress']}}</b></h4>
            <h4>Status: 
              @if($order['status'] == "Pending")
              <span class="label label-warning">{{$order['status']}}</span>

              @elseif($order['status'] == "In-Progress")
              <span class="label label-warning">{{$order['status']}}</span>

              @elseif($order['status'] == "For Alterations")
              <span class="label label-info">For Fitting</span>

              @elseif($order['status'] == "For Pickup")
              <span class="label bg-navy">{{$order['status']}}</span>

              @elseif($order['status'] == "For Delivery")
              <span class="label bg-olive">{{$order['status']}}</span>

              @elseif($order['status'] == "On Delivery")
              <span class="label bg-maroon">{{$order['status']}}</span>

              @elseif($order['status'] == "Delivered")
              <span class="label label-success">{{$order['status']}}</span>

              @elseif($order['status'] == "Completed")
              <span class="label label-success">{{$order['status']}}</span>

              @elseif($order['status'] == "On Rent")
              <span class="label label-info">{{$order['status']}}</span>

              @elseif($order['status'] == "On Hold")
              <span class="label label-danger">{{$order['status']}}</span>
              @endif
            </h4>

            <?php 
              $transactionID = explode("_", $order['transactionID']);
              $type = $transactionID[0];

              if($type == 'CART'){
                $transactionType = 'PURCHASE';
              }else if($type == 'MTO'){
                $transactionType = 'MADE-TO-ORDER';
              }else if($type == 'BIDD'){
                $transactionType = 'BIDDING';
              }else if($type == 'RENT'){
                $transactionType = 'RENT';
              }

            ?>
            <h4>Order Type: 
              @if($type == 'CART')
                <b>PURCHASE</b>
              @elseif($type == 'RENT')
                <b>RENT</b>
              <h4>Date Item will be used: <b>{{date('M d, Y',strtotime($order->rent['dateToUse']))}}</b></h4>
              @elseif($type == 'MTO')
                <b>MADE-TO-ORDER</b>
                <h4>Date of item's use: <b>{{date('M d, Y',strtotime($order->mto['deadlineOfProduct']))}}</b></h4>
              @elseif($type == 'BIDD')
                <b>BIDDING</b>
                <h4>Deadline of Product: <b>{{ date('M d, Y',strtotime($order->bidding['deadlineOfProduct'])) }}</b></h4>
              @endif
            </h4>
            <br>

            @if($order['cartID'] != null)
              <table class="table table-striped">
                <!-- <col width="250">
                <col width="150">
                <col width="250">
                <col width="70"> -->
                <thead>
                <tr>
                  <th>Qty</th>
                  <th>Product Name</th>
                  <th>Product Description</th>
                  <th>Price</th>
                </tr>
                </thead>
                  @foreach($order->cart->items as $item)
                  @if($item->product != null)
                    @if($item->product['boutiqueID'] == $boutique['id'])
                    <tr>
                      <td>1</td>
                      <td>{{$item->product['productName']}}</td>
                      <td>{{$item->product['productDesc']}}</td>
                      <td>{{$item->product['price']}}</td>
                    </tr>
                    @endif
                  @else
                    @if($item->set['boutiqueID'] == $boutique['id'])
                    <tr>
                      <td>1</td>
                      <td>{{$item->set['setName']}}</td>
                      <td>{{$item->set['setDesc']}}</td>
                      <td>{{$item->set['price']}}</td>
                    </tr>
                    @endif
                  @endif
                  @endforeach
              </table><br><br>
            @elseif($order['rentID'] != null)
              <table class="table table-striped">
                <!-- <col width="250">
                <col width="150">
                <col width="250">
                <col width="70"> -->
                <thead>
                <tr>
                  <th>Qty</th>
                  <th>Product Name</th>
                  <th>Product Description</th>
                  <th>Rent Price</th>
                </tr>
                </thead>
                  <tr>
                    @if($order->rent->product != null)
                    <td>1</td>
                    <td>{{$order->rent->product['productName']}}</td>
                    <td>{{$order->rent->product['productDesc']}}</td>
                    <td>{{$order->rent->product->rentDetails['price']}}</td>
                    @else
                    <td>1</td>
                    <td>{{$order->rent->set['setName']}}</td>
                    <td>{{$order->rent->set['setDesc']}}</td>
                    <td>{{$order->rent->set->rentDetails['price']}}</td>
                    @endif
                  </tr>
              </table><br><br>
            @endif
          </div>

          <div class="col-md-4" style="text-align: right">

            <table class="table">
              <col width="162">
              <col width="130">
              <tr>
                <th>Subtotal</th>
                <td>{{$order['subtotal']}}</td>
              </tr>
              <tr>
                <th>Delivery Fee</th>
                <td>{{$order['deliveryfee']}}</td>
              </tr>
              <tr>
                <th>Total</th>
                <td>{{$order['total']}}</td>
              </tr>
              <tr>
                <th>Payment Status</th>
                @if($order['paymentStatus'] == "Not Yet Paid")
                  <td><span class="label label-danger">{{ $order['paymentStatus']}}</span></td>
                @else
                  <td><span class="label label-success">{{ $order['paymentStatus']}}</span></td>
                @endif
              </tr>
            </table>
          </div>

          @if($order['courierID'] != null)
          <div class="col-md-12">
            <hr>
            <h4>Courier's Name: <b>{{$order->courier->user['fname'].' '.$order->courier->user['lname']}}</b></h4>
          </div>
          @endif

        </div>
        
        <div class="box-footer" style="text-align: right;">
          <a class="btn btn-success" data-toggle="modal" data-target="#qrCode{{$order['id']}}">View QR Code</a>
        @if($order['cartID'] != null)
          <a class="btn btn-default" href="{{url('orders')}}"> Back</a>
        @elseif($order['rentID'] != null)
          <a class="btn btn-default" href="{{url('rents/'.$order->rent['rentID'])}}"> Back to Rent Details</a>
        @elseif($order['mtoID'] != null)
          <a class="btn btn-default" href="{{url('made-to-orders/'.$order->mto['id'])}}"> Back to MTO Details</a>
        @elseif($order['biddingID'] != null)
          <a class="btn btn-default" href="{{url('boutique-bidding/'.$order->bidding['id'])}}"> Back to Bidding Details</a>
        @endif
        @if($order['paymentStatus'] == "Fully Paid" && $order['status'] == "In-Progress" && $order['cartID'] != null)
          <a class="btn btn-primary" href="" data-toggle="modal" data-target="#forPickupModal"> For Pickup</a>

        @elseif($order['paymentStatus'] == "Fully Paid" && $order['status'] == "In-Progress" && $order['cartID'] == null)
          <a class="btn btn-primary" href="" data-toggle="modal" data-target="#forAlterationsModal"> Set Date for Fittings</a>

        @elseif($order['status'] == "For Alterations" && $order['cartID'] == null)
          <a class="btn btn-primary" href="" data-toggle="modal" data-target="#confirmAlteration"> For Pickup</a>

        @elseif($order['paymentStatus'] == "Not Yet Paid" && $order['status'] == "In-Progress" && $order['cartID'] != null)
          <input type="submit" value="For Pickup" class="btn btn-primary" disabled>

        @elseif($order['paymentStatus'] == "Not Yet Paid" && $order['status'] == "In-Progress")
          <input type="submit" value="For Alterations" class="btn btn-primary" disabled>
          
        @elseif($order['status'] == "On Rent")
          <a href="{{url('rentReturned/'.$order['rentID'])}}" class="btn btn-primary">Item Returned</a>
        @endif
        </div>
      </div>


      @if($complaint != null)
      <div class="box box-danger">

        <div class="box-header with-border">
          <h3 class="box-title">Complaint</h3>
        </div>

        <div class="box-body">
          <div class="col-md-12"> 

            <!-- <h4>Complainant Name: <b>{{$complaint->order->customer['fname'].' '.$complaint->order->customer['lname']}}</b></h4> -->
            <h4>Complain: <b>{{$complaint['complain']}}</b></h4>
            <h4>Attachments:</h4>

            <div class="row"> 
              @foreach($complaint->complainFiles as $complainFile)
              <div class="col-md-2 image-container">
                <img src="{{ asset('/uploads').$complainFile['filename'] }}" style="width: calc(100% + 40px); height: 250px; object-fit: cover; ">
              </div>
              @endforeach
            </div>
            <br>

            @if($order['cartID'] == null)
              <hr>
              <h4>
                Was client present at the day of the scheduled fitting?
                @if($order->alteration['status'] == 'used')
                  <b>YES</b>
                @else
                  <b>NO</b>
                @endif
              </h4>
              <hr>
            @endif

            @if($complaint->dispute != null)
              <h4>Your dispute: <b>{{$complaint->dispute['dispute']}}</b></h4>
            @endif

            @if($complaint['status'] == 'Closed')
              <i><h4>Actions taken:
                @if($order->refund != null)
                  <b>Customer has been refunded</b>
                @else
                  none
                @endif
              </h4></i>
            @endif

          </div>
        </div>

        @if($order->complain['status'] == "Active")
        <div class="box-footer">
          <div class="box-footer" style="text-align: right;">
            @if($complaint->dispute == null)
              <a href="" class="btn btn-primary" data-toggle="modal" data-target="#fileForDisputeModal">File for Dispute</a>
            @else
              <a href="" class="btn btn-success" data-toggle="modal" data-target="#viewDisputeModal">View filed Dispute</a>
            @endif
          </div>
        </div>
        @endif

      </div>
      @endif

    </div>
  </div>
</section>

<!-- MODAL -->
@if(!empty($complaint))
<div class="modal fade" id="viewDisputeModal" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Filed Dispute</b></h3>
      </div>

        {{csrf_field()}}
        <div class="modal-body">
          <h4>{{$complaint->dispute['dispute']}}</h4>
        </div>

        <div class="modal-footer">
          <a href="" class="btn btn-default" data-dismiss="modal">Cancel</a>
        </div>
    </div> 
  </div>
</div>
@endif

<div class="modal fade" id="fileForDisputeModal" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>File for Dispute</b></h3>
      </div>

      <form action="{{url('fileforDispute')}}" method="post">
        {{csrf_field()}}
        <div class="modal-body">
          <p>Enter below your dispute regarding the complaint.</p>
          <textarea name="dispute" class="form-control" rows="4"></textarea>
          <input type="text" name="orderID" value="{{$order['id']}}" hidden>
        </div>

        <div class="modal-footer">
          <input type="submit" name="btn_submit" class="btn btn-primary" value="Submit">
        </div>
      </form>
    </div> 
  </div>
</div>

<div class="modal fade" id="forAlterationsModal" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title"><b>Set fitting schedule</b></h3>
          </div>

          <form action="{{url('forAlterations')}}" method="post">
            {{csrf_field()}}
            <div class="modal-body">
              <p>Set date for fitting:</p>
                <input type="text" name="alterationDateStart" id="alterationDateStart" class="form-control" placeholder="Set start date" required>
                <input type="text" name="alterationDateEnd" id="alterationDateEnd" class="form-control" placeholder="Set end date" required>
                <input type="text" name="orderID" value="{{$order['id']}}" hidden>
            </div>

            <div class="modal-footer">
              <input type="submit" name="btn_submit" class="btn btn-primary" value="Confirm">
            </div>
          </form>
      </div> 
    </div>
</div>

<div class="modal fade" id="confirmAlteration" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Confirm Alterations</b></h3>
      </div>

      <!-- <form action="{{url('submitOrder')}}" method="post"> -->
        <!-- {{csrf_field()}} -->
        <div class="modal-body">
          <p>Did client show up at scheduled fittings? </p>
          <input type="text" name="orderID" value="{{$order['id']}}" hidden>
        </div>

        <div class="modal-footer">
          <!-- <a href="" class="btn btn-default" id="noAlterations">No</a>
          <a href="" class="btn btn-primary" id="yesAlterations">Yes</a> -->
          <input type="text" id="alterationID" value="{{$order['alterationID']}}" hidden>
          <input type="submit" id="noAlterations" name="btn_submit" class="btn btn-default" value="No">
          <input type="submit" id="yesAlterations" name="btn_submit" class="btn btn-primary" value="Yes">
        </div>
      <!-- </form> -->
    </div> 
  </div>
</div>

<div class="modal fade" id="forPickupModal" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Submit Order for Pickup?</b></h3>
      </div>

      <div class="modal-body" id="forPickup">
        <p>Set date for pickup:</p>
        <form action="{{url('submitOrder')}}" method="post">
          {{csrf_field()}}
          <!-- <input type="text" id="alterationDateEnd" class="form-control" value="{{$order['alterationDateEnd']}}" hidden> -->
          <input type="text" name="deliverySchedule" id="deliverySchedule" class="form-control datepicker" required>
          <input type="text" name="orderID" value="{{$order['id']}}" hidden>
      </div>

      <div class="modal-footer">
        <!-- <a href="{{url('submitOrder/'.$order['id'])}}" class="btn btn-primary">Confirm</a> -->
        <input type="submit" name="btn_submit" class="btn btn-primary" value="Confirm">
      </form>
      </div>
    </div> 
  </div>
</div>

<div class="modal fade" id="qrCode{{$order['id']}}" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><b>QR Code</b></h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <p style="text-align: center;">
          {!! QrCode::size(300)->generate( 
         $order['id'].'-'.$order['userID'].'-'.$order['boutiqueID']  
          ); !!}

        <!--   {!! QrCode::size(300)->generate( 
          'http://192.168.43.176/hinimo/public/ionic-getqr/'.$order['id'].'/'.$order['id'].'_'.$order['userID'].'_'.$order['boutiqueID']  
          ); !!} -->
        </p>
      </div>

      <div class="modal-footer">
        <!-- <input type="" class="btn btn-default" data-dismiss="modal" value="Cancel"> -->
        <a href="" class="btn btn-default" data-dismiss="modal">Cancel</a>
        <!-- <input type="submit" class="btn btn-primary" value="Print"> -->
        <!-- <a href="" class="btn btn-primary">Print</a> -->
      </div>
    </div> 
  </div>
</div>

<style type="text/css">
  .right .direct-chat-text{margin-left: 500px; margin-right: 2px}
  .sender-time{margin-left: 300px;}
  .direct-chat-text{margin: 5px 500px 0 2px;}
  .image-container{overflow: hidden;}
</style>

@endsection

@section('scripts')
<script type="text/javascript">

  $('.transactions').addClass("active");
  $('.orders').addClass("active");

  // ---------------------------------------------------------------------
  var dateToday = new Date();
  var dateTomorrow = new Date();
  dateTomorrow.setDate(dateToday.getDate());
  // dateTomorrow.setDate(dateToday.getDate()+1);

  $('#alterationDateStart').datepicker({
    startDate: dateTomorrow
  });

  var dateStart = $('#alterationDateStart').val();

  $('#alterationDateEnd').datepicker({
    startDate: dateTomorrow //dapat mag start sa d day after sa startDate
  });

  // ---------------------------------------------------------------------
  // {{$order['alterationDateEnd']}}
  var alterationDateEnd = new Date();
  // alert(alterationDateEnd);
  $('#deliverySchedule').datepicker({
    startDate: dateTomorrow
    //set sad ug date limit sa mto nga dapat 1 week before the use ideliver
  });

  $('#noAlterations').on('click', function(){
    var value = $(this).val();
    var alterationID = $('#alterationID').val();

    $.ajax({
      url: "{{url('updateAlteration')}}"+'/'+alterationID+'/'+value,
      success:function(data){
        // $('#forPickup').html(data);
        $('#forPickupModal').modal('show');
        $('#confirmAlteration').modal('hide');
      }
    });

  });

  $('#yesAlterations').on('click', function(){
    var value = $(this).val();
    var alterationID = $('#alterationID').val();

    $.ajax({
      url: "{{url('updateAlteration')}}"+'/'+alterationID+'/'+value,
      success:function(data){
        // $('#forPickup').html(data);
        $('#forPickupModal').modal('show');
        $('#confirmAlteration').modal('hide');
      }
    });

  });


</script>
@endsection