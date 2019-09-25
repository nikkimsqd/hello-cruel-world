@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
<div class="page">

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

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Categories</h6>

                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">

                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#womens">
                                        <a href="#">Women</a>
                                        <ul class="sub-menu collapse show" id="womens">
                                		@foreach($categories as $category)
                                		@if($category['gender'] == "Womens")
                                            <li><a href="#">{{ $category['categoryName'] }}</a></li>
                                            @else
                                            @endif
                                        @endforeach
                                        </ul>
                                    </li>

                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#mens">
                                        <a href="#">Men</a>
                                        <ul class="sub-menu collapse" id="mens">
                                		@foreach($categories as $category)
                                		@if($category['gender'] == "Mens")
                                            <li><a href="#">{{ $category['categoryName'] }}</a></li>
                                            @else
                                            @endif
                                        @endforeach
                                        </ul>
                                    </li>
                                   
                                </ul>
                            </div>
                        </div>

                       
                        <div class="widget brands mb-50">
                            <p class="widget-title2 mb-30">Boutiques</p>
                            <div class="widget-desc">
                                <ul>
                                    @foreach($boutiques as $boutique)
                                    <li><a href="{{url('/boutique').'/'.$boutique['id']}}">{{$boutique['boutiqueName']}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9"> 
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span>{{$productsCount}}</span> products found</p>
                                    </div>
                                    <!-- Sorting -->
                                  <!--   <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                                        <form action="#" method="get">
                                            <select name="select" id="sortByselect">
                                                <option value="highest_rated">Highest Rated</option>
                                                <option value="newest">Newest</option>
                                                <option value="value">Price: ₱10,000 - ₱5,000</option>
                                                <option value="value">Price: ₱1,000 - ₱5,000</option>
                                                <option value="value">Price: below $1,000</option>
                                            </select>
                                            <input type="submit" class="d-none" value="">
                                        </form> 
                                    </div> -->
                                </div>
                            </div>
                        </div>



                            <!-- //INDIVIDUAL PRODUCTS -->
                        <div class="products_list row"> <!-- Products Display -->
                        	@foreach($products as $product)

                                @if($product['productName'])
    	                        <!-- Single Product -->
                                <div class="col-12 col-sm-6 col-lg-4">
        	                        <div class="single-product-wrapper">
        	                            <!-- Product Image -->
                                        <?php $counter = 1; ?>
                                    
                                        <div class="product-img">
                                            @foreach($product->productFile as $image)
                                            
            	                            @if($counter == 1)    
                                                <img src="{{ asset('/uploads').$image['filename'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                                            @elseif($counter == 2)    
                                                <img class="hover-img" src="{{ asset('/uploads').$image['filename'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                                            @endif

                                            @if($product['productStatus'] == "Not Available")
                                                <div class="product-badge offer-badge">
                                                    <span>NOT AVAILABLE</span>
                                                </div>
                                            @elseif($product['rpID'] != null && $product['price'] != null)
                                                <div class="product-badge new-badge">
                                                    <span>RENTABLE</span>
                                                </div>
                                            @elseif($product['rpID'] != null && $product['price'] == null)
                                                <div class="product-badge new-badge">
                                                    <span>FOR RENT ONLY</span>
                                                </div>
                                            @endif
                                                
                                            @if($product->inFavorites)
                                                <div class="product-favourite unfavorite-product">
                                                    <input type="text" name="productID" value="{{$product['id']}}" hidden>
                                                    <a href="#" class="favme fa fa-heart active"></a>
                                                </div>
                                            @else
                                                <div class="product-favourite ml-4 favorite-product">
                                                    <input type="text" name="productID" value="{{$product['id']}}" hidden>
                                                    <a href="#" class="favme fa fa-heart"></a>
                                                </div>
                                            @endif
                                            
                                            <?php $counter++; ?>
                                            @endforeach
                                        </div>

        	                            <!-- Product Description -->
        	                            <div class="product-description">
        	                                <span>{{ $product->owner['boutiqueName'] }}</span>
        	                                <a href="#">
        	                                    <h6>{{ $product['productName'] }}</h6>
        	                                </a>
                                            @if($product['price'] != null)
        	                                <p class="product-price">₱{{ number_format($product['price']) }}</p>
                                            @else
                                            <p class="product-price">₱{{ number_format($product->rentDetails['price']) }}</p>
                                            @endif

        	                                <!-- Hover Content -->
        	                                <div class="hover-content">
        	                                    <!-- Add to Cart -->
        	                                    <div class="add-to-cart-btn">
        	                                    	<!-- <input type="text" name="productID" value="{{$product['id']}}" hidden> -->
                                                    @if($product['productStatus'] == "Available")
        	                                        <a href="{{url('single-product-details/').'/'.$product['id']}}" class="btn essence-btn">View Product</a>
                                                    @endif
        	                                    </div>
        	                                </div>
        	                            </div>
                                    </div>
    	                        </div>
                                @else
                                <!-- Single Product -->
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="single-product-wrapper">
                                        <div class="product-img">
                                            <div class="row">
                                                @foreach( $product->items as $item)
                                                <div class="col-md-6">
                                                    @foreach($item->product->productFile as $image)
                                                        <img src="{{ asset('/uploads').$image['filename'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                                                    <?php //break; ?>
                                                    @endforeach
                                                </div>
                                                @endforeach
                                            </div>

                                            @if($product['productStatus'] == "Not Available")
                                            <div class="product-badge offer-badge">
                                                <span>NOT AVAILABLE</span>
                                            </div>
                                            @elseif($product['rpID'] != null && $product['price'] != null)
                                            <div class="product-badge new-badge">
                                                <span>RENTABLE</span>
                                            </div>
                                            @elseif($product['rpID'] != null && $product['price'] == null)
                                            <div class="product-badge new-badge">
                                                <span>FOR RENT ONLY</span>
                                            </div>
                                            @endif

                                            @if($product->inFavorites)
                                            <div class="product-favourite unfavorite-set">
                                                <input type="text" name="productID" value="{{$product['id']}}" hidden>
                                                <a href="#" class="favme fa fa-heart active"></a>
                                            </div>
                                            @else
                                            <div class="product-favourite ml-4 favorite-set">
                                                <input type="text" name="productID" value="{{$product['id']}}" hidden>
                                                <a href="#" class="favme fa fa-heart"></a>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="product-description">
                                            <span>{{ $product->owner['boutiqueName'] }}</span>
                                            <a href="#">
                                                <h6>{{ $product['setName'] }}</h6>
                                            </a>
                                            @if($product['price'] != null)
                                            <p class="product-price">₱{{ number_format($product['price']) }}</p>
                                            @else
                                            <p class="product-price">₱{{ number_format($product->rentDetails['price']) }}</p>
                                            @endif

                                            <div class="add-to-cart-btn">
                                                @if($product['setStatus'] == "Available")
                                                <a href="{{url('set-single-product-details/').'/'.$product['id']}}" class="btn essence-btn">View Product</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination mt-50 mb-70">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">21</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->


	
		

</div> <!-- page -->

@endsection

@section('scripts')
<script type="text/javascript">


$('#sortByselect').on('change', function(){
    var condition = $(this).val();

    $.ajax({
     url: "{{ url('/getProducts') }}" + '/' + condition,
     success:function(data){

        $(".products_list").empty();
        data.products.forEach(function(product) {

            $(".products_list").append('<div class="col-12 col-sm-6 col-lg-4">' +
                '<div class="single-product-wrapper">' + 
                '<div class="product-img">' +
                
               + '<div class="product-favourite"> <a href="#" class="favme fa fa-heart"></a></div>' +
                '</div>' +

                '<div class="product-description">' +
                '<span>' + product.owner.username +'</span>' +
                '<a href="#"> <h6>' + product.productName + '</h6> </a>' +
                '<p class="product-price">$' + product.price + '</p>' +

                '<div class="hover-content">' +
                '<div class="add-to-cart-btn">' +
                '<input type="text" name="productID" value="' + product.id + '" hidden>' +
                '<a href="single-product-details/' + product.id + '" class="btn essence-btn">View Product</a>' +
                '</div> </div> </div> </div> </div>'
                );


            console.log(product.id);
            console.log(product.productName);
        });
     }
    });
});


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



