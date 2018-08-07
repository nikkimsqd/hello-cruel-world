@extends('layouts.admin')


@section('titletext')
  Boutique de Filipina
@endsection



@section('content')
<div class="page">
<div id="content-wrapper" style="background-color: white;">
<hr>


<div class="container">

<div class="col-md-10">

	<br>
	<a href="/hinimo/public/products">Back</a>
	<br><br>

    <?php 
        $counter = 1;
    ?>

    
<div class="row">
    <div class="box">
    <div class="col-md-4">
    
        
        @foreach( $product->productFile as $image)
        
        @if($counter == 1)
            <img src="{{ asset('/uploads').$image['filename'] }}" style="width: 100%; align-self: center; padding: 20px;">
        @else
            
        @endif

        <?php $counter++; ?>
        @endforeach
        </div>

        <div class="col-md-5">
            <br><br>
            <table class="table">
                <tr>
                    <td>Product ID: </td>
                    <td>{{ $product['productID'] }}</td>
                </tr>
                <tr>
                    <td>Product Name: </td>
                    <td>{{ $product['productName'] }}</td>
                </tr>
                <tr>
                    <td>Description: </td>
                     <td>{{ $product['productDesc'] }}</td>
                </tr>
                <tr>
                     <td>Price:</td> 
                     <td>{{ $product['productPrice'] }}</td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>{{ $product->getCategory->gender.', '.$product->getCategory->categoryName }}</td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>{{ $product['productStatus'] }}</td>
                </tr>
            </table>
            <br><br>

            <a href="/hinimo/public/editView/{{$product['productID']}}" class="btn btn-success">Edit</a>
            <a href="/hinimo/public/delete/{{$product['productID']}}" class="btn btn-danger">Delete</a>

        </div>

    </div>
</div>





</div>
</div>



</div>
</div>


@endsection

<!-- $category['gender'].', '.$category['categoryName'] -->