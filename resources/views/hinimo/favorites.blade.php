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

                    <div class="products_list row">
                    @foreach($favorites as $favorite)
                        <div class="col-md-3">
                            <div class="single-product-wrapper">
                                <?php
                                    $itemID = explode("_", $favorite['itemID']);
                                    $itemType = $itemID[0]; 
                                ?>
                                @if($itemType == "PROD")
                                    <?php $counter = 1; ?>
                                    <div class="product-img">
                                        @foreach($favorite->product->productFile as $image)
                                            @if($counter == 1)    
                                            <img src="{{ asset('/uploads').$image['filepath'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                                            @elseif($counter == 2)    
                                            <img class="hover-img" src="{{ asset('/uploads').$image['filepath'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                                            @endif

                                            @if($favorite->product['productStatus'] == "Not Available")
                                                <div class="product-badge offer-badge">
                                                    <span>NOT AVAILABLE</span>
                                                </div>
                                            @elseif($favorite->product['rpID'] != null && $favorite->product['price'] != null)
                                                <div class="product-badge new-badge">
                                                    <span>RENTABLE</span>
                                                </div>
                                            @elseif($favorite->product['rpID'] != null && $favorite->product['price'] == null)
                                                <div class="product-badge new-badge">
                                                    <span>FOR RENT ONLY</span>
                                                </div>
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

                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <span>{{ $favorite->product->owner['boutiqueName'] }}</span>
                                        <a href="#">
                                            <h6>{{ $favorite->product['productName'] }}</h6>
                                        </a>
                                        @if($favorite->product['price'] != null)
                                        <p class="product-price">₱{{ number_format($favorite->product['price']) }}</p>
                                        @else
                                        <p class="product-price">₱{{ number_format($favorite->product->rentDetails['price']) }}</p>
                                        @endif

                                        <!-- Hover Content -->
                                        <div class="hover-content">
                                            <!-- Add to Cart -->
                                            <div class="add-to-cart-btn">
                                                <!-- <input type="text" name="productID" value="{{$favorite['id']}}" hidden> -->
                                                @if($favorite->product['productStatus'] == "Available")
                                                <a href="{{url('single-product-details/').'/'.$favorite->product['id']}}" class="btn essence-btn">View Product</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @elseif($favorite->set)
                                        <?php $counter = 1; ?>
                                    <div class="product-img">
                                        <!-- <div class="row"> -->
                                    @foreach($favorite->set->items as $item)
                                            <!-- <div class="col-md-6"> -->
                                    @foreach($item->product->productFile as $image)
                                        @if($counter == 1)    
                                            <img src="{{ asset('/uploads').$image['filepath'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                                        <?php break; ?>
                                        @elseif($counter == 2)    
                                            <img class="hover-img" src="{{ asset('/uploads').$image['filepath'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                                        <?php break; ?>
                                        @endif
                                    @endforeach
                                            <?php $counter++; ?>
                                            <!-- </div> -->
                                    @endforeach
                                        <!-- </div> -->

                                    <div class="product-badge set-badge">
                                        <span>SET</span>
                                    </div>

                                    @if($favorite->set['productStatus'] == "Not Available")
                                    <div class="product-badge offer-badge">
                                        <span>NOT AVAILABLE</span>
                                    </div>
                                    @elseif($favorite->set['rpID'] != null && $favorite->set['price'] != null)
                                    <div class="product-badge new-badge">
                                        <span>RENTABLE</span>
                                    </div>
                                    @elseif($favorite->set['rpID'] != null && $favorite->set['price'] == null)
                                    <div class="product-badge new-badge">
                                        <span>FOR RENT ONLY</span>
                                    </div>
                                    @endif

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

                                    <div class="product-description">
                                        <span>{{ $favorite->set->owner['boutiqueName'] }}</span>
                                        <a href="#">
                                            <h6>{{ $favorite->set['setName'] }}</h6>
                                        </a>
                                        @if($favorite->set['price'] != null)
                                        <p class="product-price">₱{{ number_format($favorite->set['price']) }}</p>
                                        @else
                                        <p class="product-price">₱{{ number_format($favorite->set->rentDetails['price']) }}</p>
                                        @endif

                                        <!-- <div class="add-to-cart-btn">
                                            @if($favorite['setStatus'] == "Available")
                                            <a href="{{url('set-single-product-details/').'/'.$favorite->set['id']}}" class="btn essence-btn">View Product</a>
                                            @endif
                                        </div> -->


                                        <!-- Hover Content -->
                                        <div class="hover-content">
                                            <!-- Add to Cart -->
                                            <div class="add-to-cart-btn">
                                                <!-- <input type="text" name="productID" value="{{$favorite['id']}}" hidden> -->
                                                @if($favorite->set['setStatus'] == "Available")
                                                <a href="{{url('set-single-product-details/').'/'.$favorite->set['id']}}" class="btn essence-btn">View Product</a>
                                                @endif
                                            </div>
                                        </div>

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