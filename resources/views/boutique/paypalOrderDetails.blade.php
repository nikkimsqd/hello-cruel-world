@extends('layouts.boutique')
@extends('boutique.sections')


@section('content')
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-globe"></i> AdminLTE, Inc.
        <small class="pull-right">Date: 2/10/2014</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      From
      <address>
        @foreach($order->purchase_units as $pu)
        <strong>{{$pu->shipping->name->full_name}}</strong><br>
        {{$pu->shipping->address->address_line_1}}<br>
        {{$pu->shipping->address->admin_area_2}}, {{$pu->shipping->address->admin_area_1}} {{$pu->shipping->address->country_code}} {{$pu->shipping->address->postal_code}}<br>
        Phone: (555) 539-1037<br>
        Email: {{$pu->payee->email_address}}
        @endforeach
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      To
      <address>
        <strong>{{$order->payer->name->given_name}}</strong><br>
        {{$order->payer->address->country_code}}<br>
        San Francisco, CA 94107<br>
        <!-- if($order->payer->phone)
        Phone: $order->payer->phone->phone_number->national_number<br>
        endif -->
        Email: {{$order->payer->email_address}}
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <b>Invoice #007612</b><br>
      <br>
      <b>Order ID:</b> {{$order->id}}<br>
      <b>Payment Due:</b> 2/22/2014<br>
      <b>Account:</b> 968-34567
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      @if($rent != null)
      <table class="table table-striped">
        <thead>
        <tr>
          <th>Qty</th>
          <th>Product</th>
          <th>Product ID #</th>
          <th>Description</th>
          <th>Price</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>1</td>
          <td>{{$rent->product['productName']}}</td>
          <td>{{$rent->product['productID']}}</td>
          <td>{{$rent->product['productDesc']}}</td>
          <td>{{$rent['subtotal']}}</td>
        </tr>
        </tbody>
      </table>
      @endif

      @if($mto != null)
      <table class="table table-striped">
        <thead>
        <tr>
          <th>MTO ID #</th>
          <th>Notes</th>
          <th>Price</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>{{$mto['id']}}</td>
          <td>{{$mto['notes']}}</td>
          <td>{{$mto['finalPrice']}}</td>
        </tr>
        </tbody>
      </table>
      @endif

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">
      <p class="lead">Payment Method:</p>
      <img src="{{asset('adminlte/dist/img/credit/paypal2.png') }}" alt="Paypal">

      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
      </p>
    </div>
    <!-- /.col -->
    <div class="col-xs-6">
      <!-- <p class="lead">Amount Due 2/22/2014</p> -->

      <div class="table-responsive">
      @if($rent != null)
        <table class="table">
          <tr>
            <th style="width:50%">Subtotal:</th>
            <td>{{$rent['subtotal']}}</td>
          </tr>
          <tr>
            <th>Shipping:</th>
            <td>{{$rent['deliveryFee']}}</td>
          </tr>
          <tr>
            <th>Total:</th>
            <td>{{$rent['total']}}</td>
          </tr>
        </table>
      @endif

      @if($mto != null)
        <table class="table">
          <tr>
            <th style="width:50%">Subtotal:</th>
            <td>{{$mto['subtotal']}}</td>
          </tr>
          <tr>
            <th>Shipping:</th>
            <td>{{$mto['deliveryFee']}}</td>
          </tr>
          <tr>
            <th>Total:</th>
            <td>{{$mto['total']}}</td>
          </tr>
        </table>
      @endif
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-xs-12">
      <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
      <button type="button" class="btn btn-primary pull-right">
        <i class="fa fa-download"></i> Generate PDF
      </button>
      @if($rent != null)
      <a href="{{url('rents/'.$rent['rentID'])}}" class="btn btn-default pull-right" style="margin-right: 5px;"><i class="fa fa-arrow-left"></i> Back</a>
      @else
      <a href="{{url('made-to-orders/'.$mto['id'])}}" class="btn btn-default pull-right" style="margin-right: 5px;"><i class="fa fa-arrow-left"></i> Back</a>
      @endif
      <!-- <button type="button" class="btn btn-default pull-right" style="margin-right: 5px;"> Back -->
      </button>
    </div>
  </div>
</section>


@endsection