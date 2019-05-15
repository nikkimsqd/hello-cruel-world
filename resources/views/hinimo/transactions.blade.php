@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('titletext')
	Hinimo | Transactions
@endsection


@section('body')
<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Transactions</h2>
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

                	<div class="notif-area cart-area" style="text-align: right;">
                    	<a href="" class="btn essence-btn" data-toggle="modal" data-target="#notificationsModal">View Notifications here</a><span>2</span>
                    	<br><br><br>
                	</div>

                        <table class="table table-hover table-bordered">
                        	<col width="20">
				          	<col width="400">
				         	<col width="40">
				          	<col width="20">
            				<thead>
                        	<tr>
                        		<th style="text-align: center;">Order ID</th>
                        		<th style="text-align: center;">Product/s</th> <!-- kwaon ang naa sa cart/ or rent transac -->
                        		<th style="text-align: center;">Status</th>
                        		<th></th>
                        	</tr>
                        	</thead>
                        	<tr>
                        		<td style="text-align: center;">1</td>
                        		<td>[dummy product here], [dummy product here], [dummy product here]</td>
                        		<td style="text-align: center;"><label class="label label-primary">On Delivery</label></td>
                        		<td style="text-align: center;"><a href="">View Transaction</a></td>
                        	</tr>
                        	<tr>
                        		<td style="text-align: center;">2</td>
                        		<td >[dummy product here], [dummy product here], [dummy product here], [dummy product here], [dummy product here], [dummy product here]</td>
                        		<td style="text-align: center;"><label class="label label-warning">Pending</label></td>
                        		<td style="text-align: center;"><a href="">View Transaction</a></td>
                        	</tr>
                        </table>
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
	        	<table class="table">
	        		<tr>
	        			<td style="background-color: #e6f2ff;"><a href="">Boutique Filipina requests you to submit your measurements.</a></td>
	        		</tr>
	        		<tr>
	        			<td><a href="">Boutique Filipina requests you to submit your measurements.</a></td>
	        		</tr>
	        		<tr>
	        			<td><a href="">Boutique Filipina requests you to submit your measurements.</a></td>
	        		</tr>
	        	</table>
	        </div>

	        <div class="modal-footer">
	          <!-- <input type="submit" class="btn essence-btn" value="Place Request"> -->
	          <input type="" class="btn btn-danger" data-dismiss="modal" value="Close">
	        </div>
    	</div> 
    </div>
</div>



@endsection