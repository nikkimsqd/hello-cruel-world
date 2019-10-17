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
	                    					{{$item['productName']}} <br>
	                    				@endforeach
		                    			</td>
		                    			<td>
	                    				@foreach($set['items'] as $item)
		                    				({{$item['subcategory']['id']}}) &nbsp; {{$item['subcategory']['subcatName']}} <br>
	                    				@endforeach
		                    			</td>
		                    			<td>
	                    				@foreach($set['items'] as $item)
		                    				({{$item['profilingCount']}}) &nbsp; {{$item['profilingScore']}} <br>
	                    				@endforeach
		                    			</td>
		                    			<td>
	                    				@foreach($set['items'] as $item)
		                    				({{$item['itemViewsCounter']}}) &nbsp; {{$item['viewPoints']}} <br>
	                    				@endforeach
		                    			</td>
		                    			<td>
	                    				@foreach($set['items'] as $item)
		                    				({{$item['favoriteCounter']}}) &nbsp; {{$item['favScore']}} <br>
	                    				@endforeach
		                    			</td>
		                    			<td>
	                    				@foreach($set['items'] as $item)
		                    				({{$item['orderCounter']}}) &nbsp; {{$item['historyScore']}} <br>
	                    				@endforeach
		                    			</td>
		                    			<td>{{$set['points']}}</td>
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
		                    			<td><b>PROFILING (1.3)</td>
		                    			<td><b>VIEW (1.2)</td>
		                    			<td><b>FAVORITE (1.4)</td>
		                    			<td><b>ORDER HISTORY (1.5)</td>
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
		                    				({{$product['subcategory']['id']}}) &nbsp;
		                    				{{$product['subcategory']['subcatName']}}
			                    		</td>
		                    			<td>
	                    					({{$product['profilingCount']}}) &nbsp; {{$product['profilingScore']}}
		                    			</td>
		                    			<td>
	                    					({{$product['viewsCounter']}}) &nbsp;{{$product['viewPoints']}}
		                    			</td>
		                    			<td>
	                    					({{$product['favoriteCounter']}}) &nbsp;{{$product['favScore']}}
		                    			</td>
		                    			<td>
	                    					({{$product['orderCounter']}}) &nbsp;{{$product['historyScore']}}
		                    			</td>
		                    			<td>{{$product['points']}}</td>
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