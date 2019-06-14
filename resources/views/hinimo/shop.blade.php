@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
<div class="page">

<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(bg/breadcumb.jpg);">
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
                                        <a href="#">Womens</a>
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
                                        <a href="#">Mens</a>
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

                        <!-- ##### Single Widget ##### -->
                        <div class="widget price mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Filter by</h6>
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Price</p>

                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div data-min="49" data-max="360" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="49" data-value-max="360" data-label-result="Range:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <div class="range-price">Range: $49.00 - $360.00</div>
                                </div>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <!-- <div class="widget color mb-50">
                            <p class="widget-title2 mb-30">Color</p>
                            <div class="widget-desc">
                                <ul class="d-flex">
                                    <li><a href="#" class="color1"></a></li>
                                    <li><a href="#" class="color2"></a></li>
                                    <li><a href="#" class="color3"></a></li>
                                    <li><a href="#" class="color4"></a></li>
                                    <li><a href="#" class="color5"></a></li>
                                    <li><a href="#" class="color6"></a></li>
                                    <li><a href="#" class="color7"></a></li>
                                    <li><a href="#" class="color8"></a></li>
                                    <li><a href="#" class="color9"></a></li>
                                    <li><a href="#" class="color10"></a></li>
                                </ul>
                            </div>
                        </div> -->

                        <!-- ##### Single Widget ##### -->
                        <div class="widget brands mb-50">
                            <!-- Widget Title 2 -->
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

                <div class="col-12 col-md-8 col-lg-9"> <!-- Products show area -->
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span>{{$productsCount}}</span> products found</p>
                                    </div>
                                    <!-- Sorting -->
                                    <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                                        <form action="#" method="get">
                                            <select name="select" id="sortByselect">
                                                <option value="highest_rated">Highest Rated</option>
                                                <option value="newest">Newest</option>
                                                <option value="value">Price: $10,000 - $5,000</option>
                                                <option value="value">Price: $1,000 - $5,000</option>
                                                <option value="value">Price: below $1,000</option>
                                            </select>
                                            <input type="submit" class="d-none" value="">
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="products_list row"> <!-- Products Display -->
                        	@foreach($products as $product)
	                        <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
	                        <div class="single-product-wrapper">
	                            <!-- Product Image -->
                                <?php 
                                    $counter = 1;
                                ?>
                            
                            @foreach($product->productFile as $image)
                                
	                            <div class="product-img">
	                            @if($counter == 1)    
                                    <img src="{{ asset('/uploads').$image['filename'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
	                            @else
                                @endif

                                @if($product['productStatus'] == "Not Available")
                                    <div class="product-badge offer-badge">
                                        <span>NOT AVAILABLE</span>
                                    </div>
                                @elseif($product['rpID'] != null && $product['price'] != null)
                                    <div class="product-badge new-badge">
                                        <span>Rentable</span>
                                    </div>
                                @elseif($product['rpID'] != null && $product['price'] == null)
                                    <div class="product-badge new-badge">
                                        <span>FOR RENT ONLY</span>
                                    </div>
                                @endif
	                                <!-- Favourite -->
	                                <div class="product-favourite">
	                                    <a href="#" class="favme fa fa-heart"></a>
	                                </div>
	                            </div>
                                
                                <?php $counter++; ?>
                                @endforeach

	                            <!-- Product Description -->
	                            <div class="product-description">
	                                <span>{{ $product->owner['boutiqueName'] }}</span>
	                                <a href="#">
	                                    <h6>{{ $product['productName'] }}</h6>
	                                </a>
                                    @if($product['price'] != null)
	                                <p class="product-price">${{ number_format($product['price']) }}</p>
                                    @else
                                    <p class="product-price">${{ number_format($product->rentDetails['price']) }}</p>
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
                    <div class="products_list row"> <!-- Products Display -->
                            @foreach($notAvailables as $notAvailable)
                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <?php 
                                    $counter = 1;
                                ?>
                            
                            @foreach($notAvailable->productFile as $image)
                                
                                <div class="product-img">
                                @if($counter == 1)    
                                    <img src="{{ asset('/uploads').$image['filename'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                                @else
                                @endif

                                    <div class="product-badge offer-badge">
                                        <span>NOT AVAILABLE</span>
                                    </div>
                                    <!-- Favourite -->
                                    <!-- <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div> -->
                                </div>
                                
                                <?php $counter++; ?>
                                @endforeach

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>{{ $notAvailable->owner['boutiqueName'] }}</span>
                                    <a href="#">
                                        <h6>{{ $notAvailable['productName'] }}</h6>
                                    </a>
                                    <p class="product-price">${{ number_format($notAvailable['productPrice']) }}</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <!-- <input type="text" name="productID" value="{{$notAvailable['id']}}" hidden> -->
                                            @if($notAvailable['productStatus'] == "Available")
                                            <a href="single-product-details/{{$notAvailable['id']}}" class="btn essence-btn">View Product</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            @endforeach

                        </div>
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
                '<p class="product-price">$' + product.productPrice + '</p>' +

                '<div class="hover-content">' +
                '<div class="add-to-cart-btn">' +
                '<input type="text" name="productID" value="' + product.productID + '" hidden>' +
                '<a href="single-product-details/' + product.productID + '" class="btn essence-btn">View Product</a>' +
                '</div> </div> </div> </div> </div>'
                );


            console.log(product.productID);
            console.log(product.productName);
        });
     }
    });
});


</script>
@endsection



