@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
 <div class="single-blog-wrapper">

<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('bg/breadcumb.jpg')}});">
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12">
            <div class="regular-page-content-wrapper section-padding-80">
                <div class="regular-page-text">
                    <!-- <h3 class="mb-2">Thank you. Now you can proceed on shopping. Enjoy!</h3> -->

                    <div class="row">
                    @foreach($favorites as $favorite)
                        <div class="col-md-3">
                            <div class="single-product-wrapper">
                                @if($favorite->product)
                                    <?php $counter = 1; ?>
                                    <div class="product-img">
                                        @foreach($favorite->product->productFile as $image)
                                            @if($counter == 1)    
                                            <img src="{{ asset('/uploads').$image['filename'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                                            @elseif($counter == 2)    
                                            <img class="hover-img" src="{{ asset('/uploads').$image['filename'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                                            @endif
                                            
                                            @if($favorite->product->inFavorites)
                                                <div class="product-favourite unfavorite-product">
                                                    <input type="text" name="productID" value="{{$favorite->product['id']}}" hidden>
                                                    <a href="#" class="favme fa fa-heart active"></a>
                                                </div>
                                            @else
                                                <div class="product-favourite ml-4 favorite-product">
                                                    <input type="text" name="productID" value="{{$favorite->product['id']}}" hidden>
                                                    <a href="#" class="favme fa fa-heart"></a>
                                                </div>
                                            @endif
                                            <?php $counter++; ?>
                                        @endforeach
                                    </div>
                                @elseif($favorite->set)
                                    <div class="product-img">
                                        <div class="row">
                                    @foreach($favorite->set->items as $item)
                                            <div class="col-md-6">
                                    @foreach($item->product->productFile as $image)
                                    
                                        <img src="{{ asset('/uploads').$image['filename'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                                    
                                    <?php break; ?>
                                    @endforeach
                                            </div>
                                    @endforeach
                                        </div>

                                    @if($favorite->set->inFavorites)
                                        <div class="product-favourite unfavorite-set">
                                            <input type="text" name="productID" value="{{$favorite->set['id']}}" hidden>
                                            <a href="#" class="favme fa fa-heart active"></a>
                                        </div>
                                    @else
                                        <div class="product-favourite ml-4 favorite-set">
                                            <input type="text" name="productID" value="{{$favorite->set['id']}}" hidden>
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style type="text/css">
    .product-img{padding-bottom: 30px;}
</style>

@endsection

@section('scripts')
<script type="text/javascript">

    $('.favorite-set').on('click', function(){
        var setID = $(this).find("input").val();

        $.ajax({
            url: "{{url('addSetToFavorites')}}/"+setID,
            success:function(){
                location.reload();
            }
        });
    });

    $('.unfavorite-set').on('click', function(){
        var setID = $(this).find("input").val();

        $.ajax({
            url: "{{url('unFavoriteSet')}}/"+setID,
            success:function(){
                location.reload();
            }
        });
    });

    $('.favorite-product').on('click', function(){
        var productID = $(this).find("input").val();

        $.ajax({
            url: "{{url('addToFavorites')}}/"+productID,
            success:function(){
                location.reload();
            }
        });
    });

    $('.unfavorite-product').on('click', function(){
        var productID = $(this).find("input").val();

        $.ajax({
            url: "{{url('unFavoriteProduct')}}/"+productID,
            success:function(){
                location.reload();
            }
        });
    });

</script>
@endsection