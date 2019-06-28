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
                    <a href="{{ url('/biddings/startNewBidding') }}" class="btn essence-btn">Start A Bidding</a>
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
                            @if($bidding['status'] == "Active")
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

                                <!-- @if($bidding['forRent'] == "true")
                                    <div class="product-badge new-badge">
                                        <span>Rentable</span>
                                    </div>
                                @elseif($bidding['productStatus'] == "Not Available")
                                    <div class="product-badge offer-badge">
                                        <span>NOT AVAILABLE</span>
                                    </div>
                                @endif -->
                                </div>
                                
                                <?php $counter++; ?>
                                @endforeach

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>Bidding closes in: </span> <span id="demo"></span>
                                    <a href="#">
                                        <h6>${{ number_format($bidding['maxPriceLimit']) }}</h6>
                                    </a>
                                    <p class="product-price">{{ $bidding['productName'] }}</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <!-- <input type="text" name="productID" value="{{$bidding['productID']}}" hidden> -->
                                            <a href="view-bidding/{{$bidding['id']}}" class="btn essence-btn">View Product</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            @endif
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
    

// Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
  // $('#demo').append(days + "d " + hours + "h " + minutes + "m " + seconds + "s ")
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);


</script>
@endsection