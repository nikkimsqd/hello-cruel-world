@extends('layouts.hinimo')
@extends('hinimo.sections')

@section('body')
<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>{{ $page_title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ##### Breadcumb Area End ##### -->
<!-- ##### Blog Wrapper Area Start ##### -->
<div class="blog-wrapper" style="padding-top: 30px; padding-bottom: 30px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="regular-page-content-wrapper">
                    <div class="regular-page-text">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row tops-div">
                                    @foreach($products as $product)
                                        @if($product->getCategory['categoryName'] == "Top")
                                        <div class="col-md-3">
                                            <?php $counter = 1; ?>
                                            @foreach( $product->productFile as $image)
                                                @if($counter == 1)
                                                    <label class="product-top product-top{{$product['id']}}">
                                                        <input type="radio" name="product" class="productTop" value="{{$product['id']}}">
                                                        <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: 100%; object-fit: cover;">
                                                    </label>
                                                @endif
                                                <?php $counter++; ?>
                                            @endforeach
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="row bottoms-div">
                                    @foreach($products as $product)
                                        @if($product->getCategory['categoryName'] == "Shorts" || 
                                        $product->getCategory['categoryName'] == "Trousers" || 
                                        $product->getCategory['categoryName'] == "Pants")

                                        <div class="col-md-3">
                                            <?php $counter = 1; ?>
                                            @foreach( $product->productFile as $image)
                                                @if($counter == 1)
                                                    <label class="product-bottom product-bottom{{$product['id']}}">
                                                        <input type="radio" name="product" class="productBottom" value="{{$product['id']}}">
                                                        <img src="{{ asset('/uploads').$image['filename'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                    </label>
                                                @endif
                                                <?php $counter++; ?>
                                            @endforeach
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- <form action="{{url('submitMixnmatch')}}" method="post"> -->
                                    <!-- {{csrf_field()}} -->
                                   <div class="row">
                                       <div class="col-md-12 view-top">
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-md-12 view-bottom">
                                       </div>
                                   </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="text-align: right;"><br><br>
                                <input type="submit" name="btn" value="submit" class="btn essence-btn">
                                <!-- </form> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style type="text/css">

    .tops-div{
        height: 350px;
        border: 1px solid black;
    }

    .bottoms-div{
        height: 350px;
        border: 1px solid black;
        overflow-y: scroll;
    }

    .view-top{
        height: 350px;
        border: 1px solid black;
    }

    .view-bottom{
        height: 350px;
        border: 1px solid black;
    }

    .product-top, .product-bottom{
        height: 150px;
        width: 150px;
        overflow: hidden;
    }

    [type=radio] { 
      position: absolute;
      opacity: 0;
      width: 0;
      height: 0;
    }

    [type=radio] + img {
      cursor: pointer;
    }

    /*[type=radio]:checked + img {
      outline: 2px solid #f00;
    }*/

    .selected-item{
        outline: 2px solid #f00;
    }
</style>
@endsection



@section('scripts')
<script type="text/javascript">


$('.productTop').on('change', function(){
    var productID = $(this).val();
    $('.product-top').removeClass('selected-item');
    $('.product-top'+productID).addClass('selected-item');

    $.ajax({
        url: "/hinimo/public/getMProduct/"+productID,
        success:function(data){
            data.files.forEach(function(file){
            $('.view-top').empty();
            $('.view-top').append('<img src="{{asset("/uploads")}}.'+file.filename+'" style="width:100%; height: 100%; object-fit: cover;">');
            $('.view-top').append('<input type="text" name="top" value="'+ data.product.id +'" hidden>');
            });
        }
    });
});

$('.productBottom').on('change', function(){
    var productID = $(this).val();
    $('.product-bottom').removeClass('selected-item');
    $('.product-bottom'+productID).addClass('selected-item');

    $.ajax({
        url: "/hinimo/public/getMProduct/"+productID,
        success:function(data){
            data.files.forEach(function(file){
            $('.view-bottom').empty();
            $('.view-bottom').append('<img src="{{asset("/uploads")}}.'+file.filename+'" style="width:100%; height: 100%; object-fit: cover;">');
            $('.view-bottom').append('<input type="text" name="bottom" value="'+ data.product.id +'" hidden>');
            });
            // var bots = $('.productBottom').val();  
        }
    });
});

//  var top = $('.productTop').find("input").val();
// console.log(top);



</script>

@endsection