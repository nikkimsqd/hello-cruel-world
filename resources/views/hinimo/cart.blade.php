@extends('layouts.hinimo')


@section('titletext')
	Hinimo | Cart
@endsection


@section('body')

<div class="page">

<div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Cart</h2>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="container">
	<br>
	<div class="row">
		<?php
        	$subtotal = 0;
        ?>
		<div class="col-md-12">
		<table class="table">
            @foreach($carts as $cart)
			<tr style="height: 300px;">
				<td width="60%">
					<img src="{{ asset('/uploads').$cart->productFile['filename'] }}" style="width: 200px; height:250px; object-fit: cover; ">
				</td>
				<td width="20%">
                    <h6>{{ $cart->product['productName'] }}</h6>

				</td>
				<td width="10%">
					<a href=""><i>Remove</i></a>
				</td>
				<td width="10%">
					${{ number_format($cart->product['productPrice']) }}
				</td>
			</tr>

			<?php
            	$subtotal += $cart->product['productPrice'];
            ?>
			@endforeach

		</table>
		</div>
	</div>

	<hr>
	<div class="row text-right">
		<div class="col-md-12">
            <div class="cart-amount-summary">
                <!-- <h2>Summary</h2> -->
                <ul class="summary-table">
                    <li><span><b>${{ number_format($subtotal, 2) }}</b></span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="checkout" class="btn essence-btn">proceed to check out</a>
                </div>
            </div>
        </div>
	</div>

	<br><br>


</div>

</div> <!-- page ending -->



@endsection