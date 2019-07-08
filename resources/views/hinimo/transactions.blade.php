@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>{{$page_title}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ##### Breadcumb Area End ##### -->

<div class="single-blog-wrapper">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-11">
                <div class="regular-page-content-wrapper section-padding-80">
                    <div class="regular-page-text">

                	<!-- <div class="notif-area cart-area" style="text-align: right;">
                    	<a href="" class="btn essence-btn" data-toggle="modal" data-target="#notificationsModal">View Notifications here</a>
                    	<br><br><br>
                	</div> -->
                    @if(count($orders) > 0)
                        <table class="table table-hover ">
                        	<col width="100"><col width="100"><col width="482"><col width="170"><col width="150">
            				<thead>
                        	<tr>
                                <th style="text-align: center;">Order ID</th>
                        		<th style="text-align: center;">Type</th>
                        		<th style="text-align: center;">Product/s</th> <!-- kwaon ang naa sa cart/ or rent transac -->
                        		<th style="text-align: center;">Order Status</th>
                        		<th></th>
                        	</tr>
                        	</thead>
                            @foreach($orders as $order)
                            @if($order['cartID'] != null)
                        	<tr>
                                <td style="text-align: center;">{{$order['id']}}</td>
                        		<td style="text-align: center;"><b>PURCHASE</b></td>
                                <td>
                                    @foreach($order->cart->items as $item)
                            		  {{$item->product['productName']}} 
                                    @endforeach
                                </td>
                        		<td style="text-align: center;">{{$order['status']}}</td>
                        		<td style="text-align: center;"><a href="{{url('/view-order/'.$order['id'])}}">View Order</a></td>
                        	</tr>
                            @elseif($order['rentID'] != null)
                            <tr>
                                <td style="text-align: center;">{{$order['id']}}</td>
                                <td style="text-align: center;"><b>RENT</b></td>
                                <td>{{$order->rent->product['productName']}}</td>
                                <td style="text-align: center; color: #0315ff;">{{$order['status']}}</td>
                                <td style="text-align: center;"><a href="{{url('/view-rent/'.$order->rent['rentID'])}}">View Transaction</a></td>
                            </tr>
                            @elseif($order['mtoID'] != null)
                                @if($order->mto['status'] == "Active")
                                <tr>
                                    <td style="text-align: center;">{{$order['id']}}</td>
                                    <td style="text-align: center;"><b>MTO</b></td>
                                    <td>{{$order->mto['notes']}}</td>
                                    @if($order->mto['orderID'] != null && $order->mto['status'] == "Active")
                                        <td style="text-align: center; color: #0315ff;">{{$order['status']}}</td>
                                    @elseif($order->mto['orderID'] == null && $order->mto['status'] == "Active")
                                        <td style="text-align: center; color: green;">MTO has no order yet</td>
                                    @elseif($order->mto['orderID'] == null && $order->mto['status'] == "Cancelled")
                                        <td style="text-align: center; color: red;">MTO has been cancelled</td>
                                    @else
                                        <td style="text-align: center; color: red;">MTO has been declined</td>
                                    @endif
                                    <td style="text-align: center;"><a href="{{url('/view-mto/'.$order->mto['id'])}}">View Transaction</a></td>
                                </tr>
                                @endif
                            @elseif($order['bidding'] != null)
                            <tr>
                                <td style="text-align: center;">{{$order['id']}}</td>
                                <td style="text-align: center;"><b>BIDDING</b></td>
                                <td>{{$order->bidding['notes']}}</td>
                                <td style="text-align: center; color: #0315ff;">{{$order['status']}}</td>
                                <td style="text-align: center;"><a href="{{url('/view-bidding-order/'.$order->bidding['id'])}}">View Transaction</a></td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                        <br><br><br>
                    @endif

                    <!-- @if(count($rents) > 0)
                        <table class="table table-hover table-bordered">
                            <col width="100"><col width="582"><col width="170"><col width="150">
                            <thead>
                            <tr>
                                <th style="text-align: center;">RENT ID</th>
                                <th style="text-align: center;">Product/s</th> 
                                <th style="text-align: center;">Order Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($rents as $rent)
                            <tr>
                                <td style="text-align: center;">{{$rent['rentID']}}</td>
                                <td>{{$rent->product['productName']}}</td>
                                <td style="text-align: center;">
                                    @if($rent['orderID'] != null)
                                    {{$rent->order['status']}}
                                    @elseif($rent['orderID'] == null)
                                    Rent has no order yet
                                    @endif
                                </td>
                                <td style="text-align: center;"><a href="{{url('/view-rent/'.$rent['rentID'])}}">View Transaction</a></td>
                            </tr>
                            @endforeach
                        </table>
                        <br><br><br>
                    @endif -->

                    <!-- Pending MTOs -->
                    @if(count($mtos) > 0)
                        <table class="table table-hover table-bordered">
                            <col width="100"><col width="562"><col width="190"><col width="150">
                            <thead>
                            <tr>
                                <th style="text-align: center;">MTO ID</th>
                                <th style="text-align: center;">Notes/Instructions</th>
                                <th style="text-align: center;">Order Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($mtos as $mto)
                            <tr>
                                <td style="text-align: center;">{{$mto['id']}}</td>
                                <td>{{$mto['notes']}}</td>
                                @if($mto['orderID'] != null && $mto['status'] == "Active")
                                    <td style="text-align: center; color: #0315ff;">{{$mto->order['status']}}</td>
                                @elseif($mto['orderID'] == null && $mto['status'] == "Active")
                                    <td style="text-align: center; color: green;">MTO has no order yet</td>
                                @elseif($mto['orderID'] == null && $mto['status'] == "Cancelled")
                                    <td style="text-align: center; color: red;">MTO has been cancelled</td>
                                @else
                                    <td style="text-align: center; color: red;">MTO has been declined</td>
                                @endif
                                <td style="text-align: center;"><a href="{{url('/view-mto/'.$mto['id'])}}">View Transaction</a></td>
                            </tr>
                            @endforeach
                        </table>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="notificationsModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
    	<div class="modal-content">
	        <div class="modal-header">
	          <h3 class="modal-title"><b>Notifications</b></h3>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>

	        <div class="modal-body">
	        	<table class="table table-bordered">
                    @foreach($notifications as $notification)
                    @if($notification->read_at != null)
                    <tr>
                        <td>
                            <a href="{{ url('user-notifications/'.$notification->id) }}">{{$notification->data['text']}}</a> 
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td style="background-color: #e6f2ff;">
                            <a href="{{ url('user-notifications/'.$notification->id) }}">{{$notification->data['text']}}</a> 
                        </td>
                    </tr>
                    @endif
                    @endforeach
	        	</table>
	        </div>

	        <div class="modal-footer">
	          <!-- <input type="submit" class="btn essence-btn" value="Place Request"> -->
	          <input type="" class="btn btn-danger" data-dismiss="modal" value="Close">
	        </div>
    	</div> 
    </div>
</div>
<!-- </div> -->



@endsection