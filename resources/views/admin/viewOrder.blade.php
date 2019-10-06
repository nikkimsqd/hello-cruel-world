@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">

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
                  <tr>
                    <td>1</td>
                    <td>{{$item->product['productName']}}</td>
                    <td>{{$item->product['productDesc']}}</td>
                    <td>{{$item->product['price']}}</td>
                  </tr>
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


      <div class="box box-success direct-chat direct-chat-success" id="chat">
        <div class="box-header with-border">
          <h3 class="box-title">Chat with client</h3>
          <div class="box-tools pull-right">
            <!-- <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span> -->
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
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
      <div class="box">

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

          </div>

          <div class="col-md-12"> 
          </div>

        </div>
      </div>
      @endif

    </div>
  </div>
</section>

<style type="text/css">

  .bold{font-weight: bold;}
  .right .direct-chat-text{margin-left: 500px; margin-right: 2px}
/*  .boutique-time{margin-right: 50%;}
  .client-time{margin-left: 45%;}*/
  .direct-chat-text{margin: 5px 500px 0 2px;}

</style>



@endsection

@section('scripts')
<script type="text/javascript">

$('.orders').addClass("active");
$('.on-going').addClass("active");

</script>
@endsection