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
		                    	<!-- <br><br><br> -->
		                    	<!-- <table class="table">
		                    		<tr>
		                    			<td><b>ID</td>
		                    			<td><b>PRODUCTS</td>
		                    			<td><b>SUBCAT</td>
		                    			<td><b>VIEWS</td>
		                    			<td><b>FAVS</td>
		                    			<td><b>ORDER HISTORY</td>
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
		                    			<td>{{$product['subcategory']['subcatName']}}</td>

		                    			<td>
		                    				@foreach($product['favoriteTags'] as $favoriteTag)
		                    					{{$favoriteTag}} -
		                    				@endforeach
		                    			</td>
		                    			<td>
		                    				<b>{{count($product['favSimilarTags'])}}</b> |
		                    				@foreach($product['favSimilarTags'] as $favSimilarTag)
		                    					{{$favSimilarTag}} - 
		                    				@endforeach
		                    			</td>

		                    			<td>
		                    				@foreach($product['orderTags'] as $orderTag)
		                    					{{$orderTag}}
		                    				@endforeach
		                    			</td>
		                    			<td>
		                    				@foreach($product['orderSimilarTags'] as $orderSimilarTags)
		                    					{{$orderSimilarTags}}
		                    				@endforeach
		                    			</td>
		                    		</tr>
                    				@endforeach
		                    	</table> -->
		                    	<br><br><br>
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
		                    			<td>
	                    				<?php $profilingPoints = 0; ?>
	                    				@foreach($set['items'] as $item)
		                    				({{$item['profilingCount']}}) &nbsp; {{$item['profilingScore']}} <br><br><hr>
		                    				<?php $profilingPoints += $item['profilingScore']	 ?>
	                    				@endforeach
	                    					<b>{{$profilingPoints}}</b>
		                    			</td>
		                    			<td> <!-- view -->
	                    				<?php $totalViewPoints = 0; ?>
	                    				@foreach($set['items'] as $item)
		                    				({{$item['itemViewsCounter']}}) &nbsp; {{$item['viewPoints']}} <br>
		                    				t = ({{round($item['viewTagsCount'], 2)}}) &nbsp; {{$item['viewTagsScore']}} <hr>
		                    				<?php $totalViewPoints += $item['viewPoints'] + $item['viewTagsScore'] ?>
	                    				@endforeach
	                    					<b>{{$totalViewPoints}}</b>
		                    			</td>
		                    			<td>
	                    				@foreach($set['items'] as $item)
		                    				({{$item['favoriteCounter']}}) &nbsp; {{$item['favScore']}} <br><br><hr>
	                    				@endforeach
		                    			</td>
		                    			<td>
	                    				@foreach($set['items'] as $item)
		                    				({{$item['orderCounter']}}) &nbsp; {{$item['historyScore']}} <br><br><hr>
	                    				@endforeach
		                    			</td>
		                    			<td><b>{{round($set['points'],2)}}</b></td>
		                    		</tr>
		                    		@endforeach
		                    	</table>
		                    	<br><br><br>
		                    	<!-- PRODUCTS -->
		                    	<table class="table table-bordered">
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
	                    					({{$product['profilingCount']}}) &nbsp; {{$product['profilingScore']}}
		                    			</td>
		                    			<td> <!-- VIEWS -->
	                    					({{$product['viewsCounter']}}) &nbsp; {{$product['viewPoints']}} <br>
	                    					t = ({{round($product['viewTagsCount'], 2)}}) &nbsp; {{round($product['viewTagsScore'], 2)}} <br>
	                    					<b>{{round($product['totalViewPoints'], 2)}}</b>
		                    			</td>
		                    			<td> <!-- FAVORITES -->
	                    					({{$product['favoriteCounter']}}) &nbsp;{{$product['favScore']}} <br>
	                    					t = ({{round($product['favTagsCount'],2)}}) &nbsp; {{round($product['favoriteTagsScore'], 2)}} <br>
	                    					<b>{{round($product['totalFavPoints'],2)}}</b>
		                    			</td>
		                    			<td> <!-- ORDERS -->
	                    					({{$product['orderCounter']}}) &nbsp;{{$product['historyScore']}} <br>
	                    					t = ({{round($product['orderTagsCount'],2)}}) &nbsp; {{round($product['orderTagsScore'], 2)}} <br>
	                    					<b>{{round($product['totalOrderScore'],2)}}</b>
		                    			</td>
		                    			<td><b>{{round($product['points'],2)}}</b></td>
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