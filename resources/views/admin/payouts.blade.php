@extends('layouts.boutique')
@extends('admin.sections')


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#pendings" data-toggle="tab">Pendings</a></li>
          <li><a href="#payouts" data-toggle="tab">Payouts</a></li>
          <!-- <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="pendings">
            <table class="table table-hover">
              <thead>
                <th>OrderID</th>
                <th>Boutique Name</th>
                <th class="align-center">Amount</th>
                <th></th>
              </thead>
              @foreach($orders as $order)
              @if($order['payoutID'] == null)
              <tr>
                <td>{{$order['id']}}</td>
                <td>{{$order->boutique['boutiqueName']}}</td>
                <td class="align-center">₱{{$order['boutiqueShare']}}</td>
                <td class="align-center"><a href="" class="btn btn-primary" data-toggle="modal" data-target="#confirmPayout{{$order['id']}}">Send Payout</a></td>
                <!-- <td class="align-center">
                  <div id="send-payout" class="btn btn-primary send-payout">
                    <p class="mg-bottom">Send Payout</p>
                    <input id="orderID" value="{{$order['id']}}" hidden>
                    <input id="orderJson" value="{{$order['json']}}" hidden>
                    <input id="amount" value="{{$order['boutiqueShare']}}" hidden>
                    <input id="boutiqueOwnerID" value="{{$order->boutique->owner['id']}}" hidden>
                  </div>
                </td> -->
              </tr>
              @endif
              @endforeach
            </table>
            
          </div>
          
          <div class="tab-pane" id="payouts">
            <table class="table">
              <thead>
                <th>Payout ID</th>
                <th class="align-center">Batch ID</th>
                <th class="align-center">Order ID</th>
                <th>Boutique Name</th>
                <th class="align-center">Amount</th>
                <th></th>
              </thead>
              @foreach($orders as $order)
              @if($order['payoutID'] != null)
              <tr>
                <td>{{$order['payoutID']}}</td>
                <td class="align-center">{{$order->payout['batchID']}}</td>
                <td class="align-center">{{$order['id']}}</td>
                <td>{{$order->boutique['boutiqueName']}}</td>
                <td class="align-center">₱{{$order->payout['amount']}}</td>
                <td class="align-center"><a href="{{url('view-payout/'.$order['id'])}}" class="btn btn-success">View Order</a></td>
                <!-- <td class="align-center"><a href="{{url('view-payout/'.$order['id'])}}" class="btn btn-success">View</a></td> -->
              </tr>
              @endif
              @endforeach
            </table>
              
          </div>
          
        </div>
      </div>

      <!-- /.box -->
    </div>
  </div>
</section>


@foreach($orders as $order)
  @if($order['payoutID'] == null)
    <div class="modal fade" id="confirmPayout{{$order['id']}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"><b>Confrim Payout?</b></h3>
          </div>
          <div class="modal-body">
            <h4>Once you continue, a payout will be sent to seller.</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <div id="send-payout" class="btn btn-success send-payout">
              <p class="mg-bottom">Continue</p>
              <input id="orderID" value="{{$order['id']}}" hidden>
              <input id="orderJson" value="{{$order['json']}}" hidden>
              <input id="amount" value="{{$order['boutiqueShare']}}" hidden>
              <input id="boutiqueOwnerID" value="{{$order->boutique->owner['id']}}" hidden>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
@endforeach


@foreach($orders as $order)
  @if($order['payoutID'] == null)
    <div class="modal fade" id="warningModal{{$order->boutique->owner['id']}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Oooops</h4>
          </div>
          <div class="modal-body">
            <h4>The request can't be processed beacause the seller of selected order has not provided a PayPal account yet.</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <a href="{{url('requestPaypalAccount/'.$order['id'])}}" class="btn btn-warning">Notify seller</a>
          </div>
        </div>
      </div>
    </div>
  @endif
@endforeach


<style type="text/css">

  .total{border-top: 2px solid #757575;}
  .align-center{text-align: center;}
  .align-right{text-align: right;}
  .mg-bottom{margin-bottom: 0;}

</style>
      
@endsection

@section('scripts')
<script type="text/javascript">

$('.payouts').addClass("active");  


$('.send-payout').on('click', function(){
  orderID = $(this).find("input").val();
  orderJson = $(this).find("#orderJson").val();
  amount = $(this).find("#amount").val();
  boutiqueOwnerID = $(this).find("#boutiqueOwnerID").val();

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
        var batchID = response.batch_header.payout_batch_id;

        window.location.href = "/hinimo/public/savePayout/"+orderID+"/"+batchID;

        // window.location.replace("/hinimo/public/savePayout/"+orderID+"/"+batchID);


        console.log(response);
      });


      $.ajax({
        url: "/hinimo/public/savePayout/"+orderJson,
        // type: "POST",
        // data: {id: productID}
      });
    });
  }else{
    // alert("oops");
    $('#warningModal'+boutiqueOwnerID).modal('show');
  }

});




// $(function () {
//   $('#orders-table').DataTable({
//     'paging'      : true,
//     'lengthChange': true,
//     'searching'   : false,
//     'ordering'    : true,
//     'info'        : true,
//     'autoWidth'   : false
//   })
// });

</script>

@endsection