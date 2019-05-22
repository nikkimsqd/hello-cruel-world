@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
<div id="page" style="background-color: white;">


	<!-- ##### Welcome Area Start ##### -->
    <section class="welcome_area bg-img background-overlay" style="background-image: url({{ asset('pics_for_upload/long/oo.jpg') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        <!-- <h6>asoss</h6> -->
                        <h2>{{$boutique['boutiqueName']}}</h2>
                        <a href="#" class="btn essence-btn">shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Welcome Area End ##### -->

    <div class="container section-padding-80-0">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Ratings</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
          </div>
        </div>
     
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
   
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Products</p>
            </div>
            <div class="icon">
              <i class="ion-ios-pricetags"></i>
            </div>
          </div>
        </div>
  
    </div>
    </div>

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">
                       
                        <a href="{{url($boutique['id'].'/made-to-order')}}" class="btn essence-btn">made to orders here</a><br><br><br>
                        <!-- <a href="" class="btn essence-btn" data-toggle="modal" data-target="#madeToOrderModal">made to orders here</a><br><br><br> -->
                
                        <div class="widget catagory mb-50">
                            <h6 class="widget-title mb-30">Categories</h6>

                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">

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

                        <div class="widget price mb-50">
                            <h6 class="widget-title mb-30">Filter by</h6>
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
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <div class="total-products">
                                        <p><span>{{$productsCount}}</span> products found</p>
                                    </div>

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



                        <div class="products_list row">
                            @foreach($products as $product)
                      
                            <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                               
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
                                @elseif($product['forRent'] == "true")
                                    <div class="product-badge new-badge">
                                        <span>Rentable</span>
                                    </div>
                                @endif
                                    
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>
                                
                                <?php $counter++; ?>
                                @endforeach

                                <div class="product-description">
                                    <span>{{ $product->owner['boutiqueName'] }}</span>
                                    <a href="#">
                                        <h6>{{ $product['productName'] }}</h6>
                                    </a>
                                    <p class="product-price">${{ number_format($product['productPrice']) }}</p>

                                    <div class="hover-content">
                                        <div class="add-to-cart-btn">
                                            @if($product['productStatus'] == "Available")
                                            <a href="{{url('single-product-details/').'/'.$product['productID']}}" class="btn essence-btn">View Product</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

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
                    <div class="products_list row"> 
                            @foreach($notAvailables as $notAvailable)
                            <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
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
                                    
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>
                                
                                <?php $counter++; ?>
                                @endforeach

                                <div class="product-description">
                                    <span>{{ $notAvailable->owner['boutiqueName'] }}</span>
                                    <a href="#">
                                        <h6>{{ $notAvailable['productName'] }}</h6>
                                    </a>
                                    <p class="product-price">${{ number_format($notAvailable['productPrice']) }}</p>

                                    <div class="hover-content">
                                        <div class="add-to-cart-btn">
                                            @if($notAvailable['productStatus'] == "Available")
                                            <a href="single-product-details/{{$notAvailable['productID']}}" class="btn essence-btn">View Product</a>
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


</div> <!-- sa page -->


<!-- MODAL -->
<div class="modal fade" id="madeToOrderModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title"><b>Submit your item</b></h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <form method="post" action="{{url('/saveMadeToOrder')}}"  enctype="multipart/form-data">
                {{csrf_field()}}

                <p>The boutique still needs to confirm your request before proceeding to the much more details about your item.</p>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Image</label>

                    <div class="col-md-6">
                        <input name="file" type="file" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Instructions/Notes</label>

                    <div class="col-md-6">
                        <textarea class="form-control" name="notes" rows="5" placeholder="Place here your instructions for the item. Ex: what is your preferred type of cloth for your item etc."></textarea>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Date of use of the product</label>

                    <div class="col-md-6">
                        <input name="dateOfUse" type="date" class="form-control" required>
                    </div>
                </div>
            <!-- </form> -->
          </div>

          <div class="modal-footer">
            <!-- <a href="{{url('biddings')}}" class="btn essence-btn" data-toggle="modal" data-target="#confirmedModal"  data-dismiss="modal">Submit for confirmation</a> -->
            <input type="text" name="boutiqueID" value="{{$boutique['id']}}" hidden>
            <input type="submit" name="btn_submit" class="btn essence-btn" value="Submit for confirmation">
            <input type="" class="btn essence-btn" data-dismiss="modal" value="Cancel">
          </div>
        </form>
      </div> 
    </div>
</div>

<div class="modal fade" id="confirmedModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
            <!-- <h3 class="modal-title"><b>Submit your item</b></h3> -->
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <p>Your request is now sent to the boutique! Please wait for more details.</p>
          </div>

          <div class="modal-footer">
            <input type="" class="btn essence-btn" data-dismiss="modal" value="Close">
          </div>
      </div> 
    </div>
</div>


<style type="text/css">
.small-box{
    box-shadow: 0 1px 10px rgba(0, 0, 0, 0.13);
    background-color: transparent !important;
}

.small-box:hover .icon {
    font-size: 90px;
}

</style>

@endsection






