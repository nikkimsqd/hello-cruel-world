@extends('layouts.boutique')


@section('titletext')
  Boutique de Filipina
@endsection



@section('content')
<div class="page">
<div id="content-wrapper" style="background-color: white;">

<section id="home" style="height: 170px;  background-size:cover; ">
</section>
<hr>

<div>
	<br>
	<form action="" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}

	@foreach($products as $product)
	<img src="{{ $product }}" width="100">

	@endforeach

</div>

</div>
</div>


@endsection