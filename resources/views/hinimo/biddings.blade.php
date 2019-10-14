@extends('layouts.hinimo')
@extends('hinimo.sections')

@section('titletext')
	Hinimo | {{ $page_title }}
@endsection


@section('body')
<div class="page">
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset('bg/breadcumb.jpg')}});">
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
            <!-- @if (\Auth::check() && \Auth::user()->roles === 'customer')
            <div class="row" style="padding-bottom: 20px; text-align: right;">
                <div class="col-md-12">
                    <a href="{{ url('/biddings/startNewBidding') }}" class="btn essence-btn">Start A Bidding</a>
                    <a href="{{ url('/biddings/startNewBidding') }}" class="btn essence-btn">View your Biddings here</a>
                </div>
            </div>
            @endif -->
            <div class="row">

                <div class="col-12 col-md-12 col-lg-12"> <!-- Products show area -->
                    <div class="row" style="padding-bottom: 20px; text-align: right;">
                        <div class="col-md-12">
                    <!-- <div class="col-12 col-md-4 col-lg-3"> -->
                        <a href="{{ url('/biddings/startNewBidding') }}" class="btn essence-btn">Start A Bidding</a>
                        <a href="{{ url('/myBiddings') }}" class="btn essence-btn">View your Biddings here</a>
                        </div>  
                    </div>  
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span>{{$biddingsCount}}</span> biddings found</p>
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
                                <?php $bidcounter = 0; ?>
                            @foreach($biddings as $bidding)
                            @if($bidding['status'] == "Open")
                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-3">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <?php $imagecounter = 1; ?>
                            
                            @foreach($bidding->productFile as $image)
                                <div class="product-img">
                                @if($imagecounter == 1)    
                                    <img src="{{ asset('/uploads').$image['filepath'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                                @else
                                @endif
                                </div>
                                <?php $imagecounter++; ?>
                                @endforeach


                                <?php $bidcounter++; ?>
                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>by: {{$bidding->owner['fname'].' '.$bidding->owner['lname']}} </span><br>
                                    <span>Bidding closes in: </span> <span id="demo{{$bidcounter}}"></span>
                                    <a href="#">
                                        <h6>₱{{ number_format($bidding['quotationPrice']) }}</h6>
                                    </a>
                                    <p class="product-price">{{ $bidding['productName'] }}</p>
                                    <input name="endDate" id="endDate" value="{{ $bidding['endDate'] }}" hidden>
                                    @if(count($bidding->bids))
                                    <?php $bids = array(); ?>
                                    <span>
                                        Lowest offer:
                                    @foreach($bidding->bids as $bid)
                                        <?php array_push($bids, $bid['quotationPrice']) ?>
                                        <!-- {{$bid['bidAmount']}} -->
                                    @endforeach
                                        ₱{{min($bids)}}
                                    </span>
                                    @else
                                    <span>No offers</span>
                                    @endif

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
                    <!-- {{$biddingsCount}}<br>
                    {{$bidcounter}} -->
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

<style type="text/css">
.mb-10{margin-bottom: 10px;}
.custom-block{display: block;}
</style>
@endsection

@section('scripts')
<script type="text/javascript">

var date = $('#endDate').val();

// alert(date);

// Set the date we're counting down to
var countDownDate = new Date(date).getTime();

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
  for (i = 0; i <= {{$bidcounter}}; i++) {
      console.log(i);
      // console.log("tae");
  if(i == {{$bidcounter}}){
      // console.log(i);
      // console.log({{$bidcounter}});
    document.getElementById("demo{{$bidcounter}}").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
      // $('#demo{{$bidcounter}}').append(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
      // {{$biddingsCount--}}
  }else{
    // document.getElementById("demo{{$bidcounter}}").innerHTML = "dili equals";
  }
    }
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo{{$bidcounter}}").innerHTML = "EXPIRED";
  }
}, 1000);


</script>
@endsection