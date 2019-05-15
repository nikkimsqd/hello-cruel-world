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
                        <h2>Notifications</h2>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection