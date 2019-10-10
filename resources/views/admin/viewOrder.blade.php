@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
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
              <span class="label label-info">{{$order['status']}}</span>

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

              @elseif($order['status'] == "On Hold")
              <span class="label label-danger">{{$order['status']}}</span>
              @endif
            </h4>
            <h4>Order Type: 
              @if($order['cartID'] != null)
                <b>Purchase</b>
              @elseif($order['rentID'] != null)
                <b>Rent</b>
              @elseif($order['mtoID'] != null)
                <b>MTO</b>
              @elseif($order['biddingID'] != null)
                <b>Bidding</b>
              @endif
            </h4>
            <br>

            @if($order['cartID'] != null)
              <table class="table table-striped">
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
                    <tr>
                      <td>1</td>
                      <td>{{$item->product['productName']}}</td>
                      <td>{{$item->product['productDesc']}}</td>
                      <td>{{$item->product['price']}}</td>
                    </tr>
                    @else
                    <tr>
                      <td>1</td>
                      <td>{{$item->set['setName']}}</td>
                      <td>{{$item->set['setDesc']}}</td>
                      <td>{{$item->set['price']}}</td>
                    </tr>
                    @endif
                  @endforeach
              </table>
            @elseif($order['rentID'] != null)
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
                    <td>1</td>
                    <td>{{$order->rent->product['productName']}}</td>
                    <td>{{$order->rent->product['productDesc']}}</td>
                    <td>{{$order->rent->product->rentDetails['price']}}</td>
                  </tr>
              </table>
            @endif
          <hr>
          <br>
          </div>

          <div class="col-md-4" style="text-align: right">
            <table class="table">
              <col width="162">
              <col width="130">
              <tr>
                <th><h4>Subtotal</h4></th>
                <td><h4 class="bold">₱{{$order['subtotal']}}</h4></td>
              </tr>
              <tr>
              <tr>
                <th><h4>Delivery Fee</h4></th>
                <td><h4 class="bold">₱{{$order['deliveryfee']}}</h4></td>
              </tr>
              <tr>
                <th><h4>Total</h4></th>
                <td><h4 class="bold">₱{{$order['total']}}</h4></td>
              </tr>
              <tr>
                <th><h4>Payment Status</h4></th>
                @if($order['paymentStatus'] == "Not Yet Paid")
                  <td><h4><span class="label label-danger">{{ $order['paymentStatus']}}</span></h4></td>
                @else
                  <td><h4><span class="label label-success">{{ $order['paymentStatus']}}</span></h4></td>
                @endif
              </tr>
            </table>
          </div>
          <div class="col-md-4 col-md-offset-1" style="text-align: right">
            <table class="table">
              <col width="162">
              <col width="130">
              <tr>
                <th><h4>Boutique's Revenue</h4></th>
                <td><h4 class="bold">₱{{$order['boutiqueShare']}}</h4></td>
              </tr>
              <tr>
                <th><h4>Hinimo's Revenue</h4></th>
                <td><h4 class="bold">₱{{$order['adminShare']}}</h4></td>
              </tr>
            </table>
          </div>

        </div>
        <div class="box-footer" style="text-align: right;">
          <a class="btn btn-default" href="{{url('admin-orders')}}"> Back</a>
        </div>
      </div>


      <div class="box direct-chat direct-chat-success collapsed-box" id="chat">
        <div class="box-header with-border">
          <h3 class="box-title">Seller and Customer's chat</h3>
          <div class="box-tools pull-right">
            <!-- <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span> -->
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
        </div>

        <div class="box-body">

          <div class="direct-chat-messages">
            @foreach($chats as $chat)
              @if($chat['senderID'] != $order->customer['id'])
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">{{$order->customer['fname'].' '.$order->customer['lname']}}</span>
                    <span class="direct-chat-timestamp pull-left boutique-time">&nbsp;&nbsp; - &nbsp;&nbsp;{{ date('d M h:i a',strtotime($chat['created_at'])) }}</span>
                  </div>

                  <div class="direct-chat-text">
                    {{$chat['message']}}
                  </div>
                  <!-- /.direct-chat-text -->
                </div>


              @else
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name pull-right">{{$order->boutique['boutiqueName']}}</span>
                      <span class="direct-chat-timestamp pull-right client-time">{{ date('d M h:i a',strtotime($chat['created_at'])) }}&nbsp;&nbsp; - &nbsp;&nbsp;</span>
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

        <!-- <div class="box-footer">
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
        </div> -->
      </div>

      @if($complaint != null)
      <div class="box box-danger" id="complaint">

        <div class="box-header with-border">
          <h3 class="box-title">Complaint &nbsp;
            @if($order->complain['status'] == "Active")
              <label class="label label-danger">{{$order->complain['status']}}</label>
            @else
              <label class="label label-success">{{$order->complain['status']}}</label>
            @endif
          </h3>
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

            @if($complaint->dispute != null)
              <h4>Seller's dispute: <b>{{$complaint->dispute['dispute']}}</b></h4>
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
              <a href="" class="btn btn-danger" data-toggle="modal" data-target="#refuseRefund">Refuse Refund</a>
              @if($order->refund != null)
              <a href="" class="btn btn-primary" data-toggle="modal" data-target="#refundCustomer">Refund Customer</a>
              @else
              <a href="" class="btn btn-primary" data-toggle="modal" data-target="#askPayPalEmail">Ask Customer for PayPal email</a>
              @endif
          </div>
        </div>
        @endif

      </div>
      @endif

    </div>
  </div>

  <!-- MODAL -->

  <div class="modal fade" id="askPayPalEmail" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"><b>Ask Customer for PayPal email?</b></h3>
        </div>

        <!-- <form action="{{url('submitOrder')}}" method="post"> -->
          <!-- {{csrf_field()}} -->
          <div class="modal-body">
            <h4>Click yes to continue.</h4>
            <input type="text" name="orderID" value="{{$order['id']}}" hidden>
          </div>

          <div class="modal-footer">
            <a href="{{url('askPayPalEmail/'.$order['id'])}}" class="btn btn-success">Yes</a>
          </div>
        <!-- </form> -->
      </div> 
    </div>
  </div>

  <div class="modal fade" id="refundCustomer" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"><b>Refund Customer?</b></h3>
        </div>

          <div class="modal-body">
            <h4>When you click yes, a refund will be sent to customer via PayPal.</h4>
            <input type="text" name="orderID" value="{{$order['id']}}" hidden>
          </div>

          <div class="modal-footer">
            <!-- <a href="{{url('refundCustomer/'.$order['id'])}}" id="send-refund" class="btn btn-success">Yes</a> -->
            <div id="send-refund" class="btn btn-success send-refund">
              <p class="mg-bottom">Yes</p>
              <input id="orderID" value="{{$order['id']}}" hidden>
              <input id="orderJson" value="{{$order['json']}}" hidden>
            </div>
          </div>
      </div> 
    </div>
  </div>

  <div class="modal fade" id="refuseRefund" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"><b>Are you sure to refuse refund?</b></h3>
        </div>

          <div class="modal-body">
            <h4>Once you click yes, there's no way you can refund customer again.</h4>
            <input type="text" name="orderID" value="{{$order['id']}}" hidden>
          </div>

          <div class="modal-footer">
            <a href="{{url('refuseRefund/'.$order['id'])}}" id="send-refund" class="btn btn-primary">Yes</a>
          </div>
      </div> 
    </div>
  </div>


</section>

<style type="text/css">

  .bold{font-weight: bold;}
  .right .direct-chat-text{margin-left: 500px; margin-right: 2px}
/*  .boutique-time{margin-right: 50%;}
  .client-time{margin-left: 45%;}*/
  .direct-chat-text{margin: 5px 500px 0 2px;}
  .image-container{overflow: hidden;}

</style>



@endsection

@section('scripts')
<script type="text/javascript">

$('.orders').addClass("active");
$('.on-going').addClass("active");


$('.send-refund').on('click', function(){
  orderID = $(this).find("input").val();
  orderJson = $(this).find("#orderJson").val();
  // console.log(orderID);

  if(orderJson != "null"){

    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "https://api.sandbox.paypal.com/v1/oauth2/token",
      "method": "POST",
      "headers": {
        "Content-Type": "application/x-www-form-urlencoded",
        "Authorization": "Basic QWFtVHJlV2V6clp1amdiUW12UW9BUXp5alkxVWVtSFphMFd2TUpBcFdBVnNJamUteUNhVnp5UjliX0stWXhEWGh6VFhsbWwxN0plRW5US206RUxpbEFOWGh4aTZ2WDE2QUh4Y1RLb2pWMHNyT0MzZF9nSTAtUFBHSUpoVkowNFJIRGg4UW43RTkxMnMwV29DVDZlcWE0a0x5azdfUWhnT3M=",
        "Accept": "*/*",
        "Cache-Control": "no-cache",
        "Postman-Token": "0013b7c1-7b7e-484a-a8bc-d3be392a5ab3,430b3eba-da78-42ec-b63b-9a3e97e320fe",
        "cache-control": "no-cache"
      },
      "data": {
        "grant_type": "client_credentials"
      }
    }



    $.ajax(settings).done(function (response) {
      access_token = response.access_token;
      // console.log(response.access_token);

      var payout = {
        "async": true,
        "crossDomain": true,
        "url": "https://api.sandbox.paypal.com/v1/payments/payouts",
        "method": "POST",
        "headers": {
          "Content-Type": "application/json",
          "Authorization": "Bearer "+access_token,
          "cache-control": "no-cache",
          "Postman-Token": "f2e8f5d5-522b-4e1b-98c7-f812ed96b226"
        },
        "processData": false,
        "data": orderJson
      }

      $.ajax(payout).done(function (response) {
        // var batchID = response.batch_header.payout_batch_id;

        window.location.href = "{{url('refundCustomer')}}/"+orderID;

        // window.location.replace("/hinimo/public/savePayout/"+orderID+"/"+batchID);


        console.log(response);
      });


      // $.ajax({
      //   url: "{{url('refundCustomer')}}/"+orderJson,
      //   // type: "POST",
      //   // data: {id: productID}
      // });
    });
  }else{
    alert("Customer has no PayPal email.");
    // $('#warningModal'+boutiqueOwnerID).modal('show');
  }

});

</script>
@endsection