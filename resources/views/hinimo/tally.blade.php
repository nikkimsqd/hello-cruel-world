@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
 <div class="single-blog-wrapper">

<!-- ##### Breadcumb Area Start ##### -->
<!--     <div class="breadcumb_area bg-img" style="background-image: url({{ asset('bg/breadcumb.jpg')}});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>TALLY</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<!-- ##### Breadcumb Area End ##### -->

	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-12 col-md-12">
	            <div class="regular-page-content-wrapper section-padding-80">
	                <div class="regular-page-text">

	                    <div class="row">
		                    <div class="col-md-12">
		                    	<h3>ID: {{$user['id']}}</h3>
		                    	<h3>NAME: {{$user['fname'] .' '.$user['lname']}}</h3>
		                    	<!-- <br><br><br> -->
		                    	<!-- <table class="table">
		                    		<tr>
		                    			<td><b>ID</td>
		                    			<td><b>PRODUCTS</td> -->
		                    			<!-- <td><b>SUBCAT</td> -->
		                    			<!-- <td><b>VIEWS</td> -->
		                    			<!-- <td><b>FAVS</td> -->
		                    			<!-- <td><b>ORDER HISTORY</td>
		                    			<td><b>SIMILARS</td>
		                    		</tr>
		                    		@foreach($products as $product)
		                    		<tr>
		                    			<td>{{$product['id']}}</td>
		                    			<td>
		                    				<b>{{count($product['productTags'])}}</b> |
		                    				@foreach($product['productTags'] as $productTag)
		                    				{{$productTag}} - 
		                    				@endforeach
		                    			</td>
		                    			<td>{{$product['subcategory']['subcatName']}}</td> -->

		                    			<!-- <td>
		                    				@foreach($product['favoriteTags'] as $favoriteTag)
		                    					{{$favoriteTag}} -
		                    				@endforeach
		                    			</td>
		                    			<td>
		                    				<b>{{count($product['favSimilarTags'])}}</b> |
		                    				@foreach($product['favSimilarTags'] as $favSimilarTag)
		                    					{{$favSimilarTag}} - 
		                    				@endforeach
		                    			</td> -->

		                    			<!-- <td>
		                    				@foreach($product['orderTags'] as $orderTag)
		                    					{{$orderTag}}
		                    				@endforeach
		                    			</td>
		                    			<td>
		                    				<b>{{count($product['orderSimilarTags'])}}</b> |
		                    				@foreach($product['orderSimilarTags'] as $orderSimilarTags)
		                    					{{$orderSimilarTags}} - 
		                    				@endforeach
		                    			</td>
		                    		</tr>
                    				@endforeach
		                    	</table> -->
		                    	<br><br>
		                    	<!-- VIEWS -->
		                    	<table class="table table-bordered">
		                    		<tr style="text-align: center;">
		                    			<td colspan="2"><b>VIEWS</td>
		                    		</tr>
		                    		<tr>
		                    			<td style="text-align: right;"><b>ITEM ID</td>
		                    			<td><b>COUNT</td>
		                    		</tr>
		                    		@foreach($views as $view)
		                    		<tr>
		                    			<td style="text-align: right;">{{$view['itemID']}}</td>
		                    			<td>{{$view['count']}}</td>
		                    		</tr>

		                    		@endforeach
		                    	</table>
		                    	<br><br>
		                    	<!-- FAVORITES -->
		                    	<table class="table table-bordered">
		                    		<tr style="text-align: center;">
		                    			<td colspan="2"><b>FAVORITES</td>
		                    		</tr>
		                    		<tr>
		                    			<td style="text-align: center;"><b>ITEM ID</td>
		                    		</tr>
		                    		@foreach($favorites as $favorite)
		                    		<tr>
		                    			<td style="text-align: center;">{{$favorite['itemID']}}</td>
		                    		</tr>

		                    		@endforeach
		                    	</table>
		                    	<br><br>
		                    	<!-- ORDERS -->
		                    	<table class="table table-bordered">
		                    		<tr style="text-align: center;">
		                    			<td colspan="3"><b>ORDERS HISTORY</td>
		                    		</tr>
		                    		<tr>
		                    			<td><b>ORDER ID</td>
		                    			<td><b>ORDER TYPE</TD>
		                    			<TD><B>ITEM ID</td>
		                    		</tr>
		                    		@foreach($orderItems as $order)
		                    		<?php
						                $transactionID = explode("_", $order['transactionID']);
						                $type = $transactionID[0];
					                ?>
		                    		<tr>
		                    			<td>{{$order['id']}}</td>
		                    			<td>
		                    				@if($type == 'CART')
		                    					PURCHASE
		                    				@elseif($type == 'RENT')
		                    					RENT
		                    				@endif
		                    			</td>
		                    			<td>
		                    				@if($type == 'CART')
                    							@foreach($order->cart->items as $cartItem)
                        							@if($cartItem->product != null)
		                    							{{$cartItem['productID']}}
		                    						@else
		                    							{{$cartItem['setID']}}
		                    						@endif
		                    					@endforeach
		                    				@elseif($type == 'RENT')
		                    					{{$order->rent['itemID']}}
		                    				@endif
		                    			</td>
		                    		</tr>
		                    		@endforeach
		                    		<tr></tr>
		                    	</table>
		                    	<br><br>
		                    	<!-- SETS -->
		                    	<table class="table table-bordered">
		                    		<tr style="text-align: center;">
		                    			<td colspan="9"><b>SETS</td>
		                    		</tr>
		                    		<tr>
		                    			<td><b>S ID</td>
		                    			<td><b>S NAME</td>
		                    			<td><b>S ITEMS</td>
		                    			<td><b>SUBCAT</td>
		                    			<td><b>PROFILING (1.3)</td>
		                    			<td><b>VIEW (1.2)</td>
		                    			<td><b>FAVORITE (1.4)</td>
		                    			<td><b>ORDER HISTORY (1.5)</td>
		                    			<td><b>TOTAL SCORE</td>
		                    		</tr>
		                    		@foreach($sets as $set)
		                    		<tr>
		                    			<td>{{$set['id']}}</td>
		                    			<td>{{$set['setName']}}</td>
		                    			<td>
	                    				@foreach($set['items'] as $item)
	                    					{{$item['productName']}} <br><br><hr>
	                    				@endforeach
		                    			</td>
		                    			<td>
	                    				@foreach($set['items'] as $item)
		                    				[{{$item['subcategory']['id']}}] &nbsp; {{$item['subcategory']['subcatName']}} <br><br><hr>
	                    				@endforeach
		                    			</td>

		                    			<td> <!-- PROFILING -->
	                    				<?php $profilingPoints = 0; ?>
	                    				@foreach($set['items'] as $item)
		                    				({{$item['profilingCount']}}) &nbsp; {{$item['profilingScore']}} <br><br><hr>
		                    				<?php $profilingPoints += $item['profilingScore']	 ?>
	                    				@endforeach
	                    					<b>{{$profilingPoints}}</b>
		                    			</td>

		                    			<td> <!-- VIEW -->
	                    				<?php $totalViewPoints = 0; ?>
	                    				@foreach($set['items'] as $item)
		                    				({{$item['itemViewsCounter']}}) &nbsp; {{$item['viewPoints']}} <br>
		                    				({{round($item['viewTagsCount'], 2)}}) &nbsp; {{$item['viewTagsScore']}} <hr>
		                    				<?php $totalViewPoints += $item['viewPoints'] + $item['viewTagsScore'] ?>
	                    				@endforeach
	                    					<b>{{$totalViewPoints}}</b>
		                    			</td>

		                    			<td> <!-- FAV -->
	                    				<?php $totalFavPoints = 0; ?>
	                    				@foreach($set['items'] as $item)
		                    				({{$item['favoriteCounter']}}) &nbsp; {{$item['favScore']}} <br>
		                    				({{round($item['favTagsCount'], 2)}}) &nbsp; {{$item['favoriteTagsScore']}} <hr>
		                    				<?php $totalFavPoints += $item['favScore'] + $item['favoriteTagsScore'] ?>
	                    				@endforeach
	                    					<b>{{round($totalFavPoints, 2)}}</b>
		                    			</td>

		                    			<td> <!-- HISTORY -->
	                    				<?php $totalOrderScore = 0; ?>
	                    				@foreach($set['items'] as $item)
		                    				({{$item['orderCounter']}}) &nbsp; {{$item['historyScore']}} <br>
		                    				({{round($item['orderTagsCount'], 2)}}) &nbsp; {{$item['orderTagsScore']}} <hr>
		                    				<?php $totalOrderScore += $item['historyScore'] + $item['orderTagsScore'] ?>
	                    				@endforeach
	                    					<b>{{round($totalOrderScore, 2)}}</b>
		                    			</td>
		                    			<td><b>{{round($set['points'], 2)}}</b></td>
		                    		</tr>
		                    		@endforeach
		                    	</table>
		                    	<br><br><br>
		                    	<!-- PRODUCTS -->
		                    	<table class="table table-bordered">
		                    		<col width="80"><col width="150"><col width="150"><col width="150"><col width="170"><col width="170"><col width="170">
		                    		<tr style="text-align: center;">
		                    			<td colspan="9"><b>PRODUCTS</td>
		                    		</tr>
		                    		<tr>
		                    			<td><b>P ID</td>
		                    			<td><b>P NAME</td>
		                    			<td><b>SUBCAT</td>
		                    			<td><b>PROFILING <br> (1.3)</td>
		                    			<td><b>VIEW <br> (1.2)</td>
		                    			<td><b>FAVORITE <br> (1.4)</td>
		                    			<td><b>ORDER HISTORY <br> (1.5)</td>
		                    			<td><b>TOTAL SCORE</td>
		                    		</tr>
		                    		@foreach($products as $product)
		                    		<tr>
		                    			<td>{{$product['id']}}</td>
		                    			<td>
                							{{$product['productName']}}
		                    					{{$product['setName']}}
		                    			</td>
		                    			<td>
		                    				[{{$product['subcategory']['id']}}] &nbsp;
		                    				{{$product['subcategory']['subcatName']}} <br>
			                    		</td>
		                    			<td>
	                    					({{$product['profilingCount']}}) &nbsp; {{$product['profilingScore']}}<br><br><hr>
	                    					<b>{{$product['profilingScore']}}</b>
		                    			</td>
		                    			<td> <!-- VIEWS -->
	                    					({{$product['viewsCounter']}}) &nbsp; {{$product['viewPoints']}} <br>
	                    					({{round($product['viewTagsCount'], 2)}}) &nbsp; {{round($product['viewTagsScore'], 2)}} <br><hr>
	                    					<b>{{round($product['totalViewPoints'], 2)}}</b>
		                    			</td>
		                    			<td> <!-- FAVORITES -->
	                    					({{$product['favoriteCounter']}}) &nbsp;{{$product['favScore']}} <br>
	                    					({{round($product['favTagsCount'],2)}}) &nbsp; {{round($product['favoriteTagsScore'], 2)}} <br><hr>
	                    					<b>{{round($product['totalFavPoints'],2)}}</b>
		                    			</td>
		                    			<td> <!-- ORDERS -->
	                    					({{$product['orderCounter']}}) &nbsp;{{$product['historyScore']}} <br>
	                    					({{round($product['orderTagsCount'],2)}}) &nbsp; {{round($product['orderTagsScore'], 2)}} <br><hr>
	                    					<b>{{round($product['totalOrderScore'],2)}}</b>
		                    			</td>
		                    			<td style="text-align: center;">
		                    				<br><br><br>
	                    					<b>{{round($product['points'],2)}}</b>
	                    				</td>
		                    		</tr>
		                    		@endforeach
		                    	</table>
		                    	<br>
		                    </div>
	                    </div>


	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>

<style type="text/css">
	.container{max-width: 100%;}

</style>


@endsection