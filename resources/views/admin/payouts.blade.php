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
                <td class="align-center">
                  <div id="send-payout" class="btn btn-success send-payout">
                    <p class="mg-bottom">Send Payout</p>
                    <input id="orderID" value="{{$order['id']}}" hidden>
                    <input id="orderJson" value="{{$order['json']}}" hidden>
                    <input id="amount" value="{{$order['boutiqueShare']}}" hidden>
                  </div>
                </td>
              </tr>
              @endif
              @endforeach
            </table>
            
          </div>
          
          <div class="tab-pane" id="payouts">
            <table class="table">
              <thead>
                <th>Payout ID</th>
                <th>Boutique Name</th>
                <th>Order ID</th>
                <th>Batch ID</th>
                <th>Transaction ID</th>
                <th>Amount</th>
              </thead>
              @foreach($orders as $order)
              @if($order['payoutID'] != null)
              <tr>
                <td>{{$order['payoutID']}}</td>
                <td>{{$order->boutique['boutiqueName']}}</td>
                <td>{{$order->payout['batchID']}}</td>
                <td class="align-center">₱{{$order->payout['transactionID']}}</td>
                <td class="align-center">₱{{$order->payout['amount']}}</td>
                <td class="align-center"><a href="{{url('send-payout')}}" class="btn btn-primary">Send Payout</a></td>
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
        console.log(response);
        console.log(access_token);
      });
  });






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