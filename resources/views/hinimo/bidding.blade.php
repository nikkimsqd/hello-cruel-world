@extends('layouts.hinimo')
@extends('hinimo.sections')

@section('titletext')
	Hinimo | {{ $page_title }}
@endsection


@section('body')
<div class="page">
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

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            @if (\Auth::check() && \Auth::user()->roles === 'customer')
            <div class="row" style="padding-bottom: 20px;">
                <div class="col-md-12">
                    <button href="{{ url('/biddings/startNewBidding') }}" class="btn btn-success btn-start-a-bidding">Start A Bidding</button>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                   
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
                            @foreach($biddings as $bidding)
                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <?php 
                                    $counter = 1;
                                ?>
                            
                            @foreach($bidding->productFile as $image)
                                
                                <div class="product-img">
                                @if($counter == 1)    
                                    <img src="{{ asset('/uploads').$image['filename'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                                @else
                                @endif

                                @if($bidding['forRent'] == "true")
                                    <div class="product-badge new-badge">
                                        <span>Rentable</span>
                                    </div>
                                @elseif($bidding['productStatus'] == "Not Available")
                                    <div class="product-badge offer-badge">
                                        <span>NOT AVAILABLE</span>
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
                                    <span>{{ $bidding->owner['boutiqueName'] }}</span>
                                    <a href="#">
                                        <h6>{{ $bidding['productName'] }}</h6>
                                    </a>
                                    <p class="product-price">${{ number_format($bidding['productPrice']) }}</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <!-- <input type="text" name="productID" value="{{$bidding['productID']}}" hidden> -->
                                            @if($bidding['productStatus'] == "Available")
                                            <a href="single-product-details/{{$bidding['productID']}}" class="btn essence-btn">View Product</a>
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
                   <!--  <nav aria-label="navigation">
                        <ul class="pagination mt-50 mb-70">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">21</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </nav> -->
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->
</div>
<!-- page -->
@endsection

@section('scripts')
    <script type="text/javascript">
        let $body = $('body');

        $body.on('click', '.btn-start-a-bidding', function() {
            window.location = $(this).attr('href');
        });
    </script>
@endsection