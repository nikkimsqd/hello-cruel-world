@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
<!-- ##### Single Product Details Area Start ##### -->
    <a href="{{url('shop')}}" class="back_to_page"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>

    <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                @foreach($product->productFile as $image)
                <img src="{{ asset('/uploads').$image['filename'] }}" alt="">
                @endforeach
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span>{{$product->owner->boutiqueName}}</span>
            <h2>{{ $product['productName'] }}</h2>
            @if($product['price'] != null && $product['rpID'] != null)
            <p class="product-price">Retail Price: ₱{{ number_format($product['price']) }}</p>
            <p class="product-price">Rent Price: ₱{{ number_format($product->rentDetails['price']) }}</p>
            @elseif($product['price'] != null)
            <p class="product-price">Retail Price: ₱{{ number_format($product['price']) }}</p>
            @elseif($product['rpID'] != null)
            <p class="product-price">Rent Price: ₱{{ number_format($product->rentDetails['price']) }}</p>
            @endif
            <p class="product-desc">{{ $product['productDesc'] }}</p>

                <!-- elseif($product['rpID'] != null) -->
                <!-- Select Box -->
             <!--    <div class="select-box d-flex mt-50 mb-30">
                    <select name="select" id="productSize" class="mr-5">
                        <option value="value">Size: XL</option>
                        <option value="value">Size: X</option>
                        <option value="value">Size: M</option>
                        <option value="value">Size: S</option>
                    </select>
                    <select name="select" id="productColor">
                        <option value="value">Color: Black</option>
                        <option value="value">Color: White</option>
                        <option value="value">Color: Red</option>
                        <option value="value">Color: Purple</option>
                    </select>
                </div> -->
            <p class="product-desc">In Stock: {{ $product['quantity'] }}</p>
            <hr>
            @if($product['measurements'] != null)
            <p class="product-desc">Maximum Measurement:</p>
            <?php $measurements = json_decode($product['measurements']) ?>
            @foreach($measurements as $measurementName => $value)
                <p>{{$measurementName}}: &nbsp; {{$value}} inches</p>
            @endforeach
            <br>
            @endif
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                @if ($product['price'] != null && $product['rpID'] != null)
                @if($user != null)
                <div class="add-to-cart-btn">
                    <input type="text" name="productID" value="{{$product['id']}}" hidden>
                    <a href="" class="btn essence-btn">Add to Cart</a>&nbsp;
                </div>
                @else
                    <a href="" class="btn essence-btn">Add to Cart</a>&nbsp;
                @endif

                <a href="{{url('requestToRent/'.$product['id'])}}" class="btn essence-btn">Request to Rent</a>
                <!-- <input type="submit" class="btn essence-btn" value="Request to Rent" data-toggle="modal" data-target="#requestToRentModal{{$product['id']}}"> -->

                @elseif($product['rpID'] != null)
                <a href="{{url('requestToRent/'.$product['id'])}}" class="btn essence-btn">Request to Rent</a>
            
                @elseif($product['price'] != null)
                @if($user != null)
                <div class="add-to-cart-btn">
                    <input type="text" name="productID" value="{{$product['id']}}" hidden>
                    <a href="" class="btn essence-btn">Add to Cart</a>&nbsp;
                </div>
                @else
                    <input type="submit" class="btn essence-btn" value="Add to Cart" data-toggle="modal" data-target="#LoginModal">
                @endif
                @endif

                @if($product->inFavorites)
                <div class="product-favourite ml-4">
                    <input type="text" name="productID" value="{{$product['id']}}" hidden>
                    <a href="#" class="favme fa fa-heart active"></a>
                </div>
                @else
                <div class="product-favourite ml-4">
                    <input type="text" name="productID" value="{{$product['id']}}" hidden>
                    <a href="#" class="favme fa fa-heart"></a>
                </div>
                @endif
                </div>

        </div>
    </section>


    <!-- MODAAAAAAAAAAAAAAAL-------------------------------->
    @if($user == null && $product['rpID'] != null)
    <div class="modal fade" id="requestToRentModal{{$product['id']}}" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title"><b>Login</b></h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              
            You are required to log in.

            </div>

            <div class="modal-footer">
                <a href="{{url('login')}}" class="btn essence-btn">Login Here</a>
            </div>
          </div>
        </div>
    </div>
    @endif

    <div class="modal fade" id="LoginModal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title"><b>Login</b></h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              
            You are required to log in.

            </div>

            <div class="modal-footer">
                <a href="{{url('login')}}" class="btn essence-btn">Login Here</a>
            </div>
          </div>
        </div>
    </div>

<style type="text/css">
    p{margin-bottom: 0;}
    .product-price{font-size: 20px !important; line-height: 1.5;}
    .price{text-align: right;}
    .payment-info{color: #0000;}
    .back_to_page{background-color: #ff084e; border-radius: 0;  box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.3); color: #ffffff; font-size: 18px;  height: 40px; line-height: 40px; right: 60px; left: 20px; top: 110px; text-align: center;  width: 40px; position: fixed; z-index: 2147483647; display: block;}
    /*a:hover{font-size: 18px; color: #ffffff;}*/
.datepicker-dropdown{top: 181px !important; left: 281.5px; z-index: 11; display: block;}
</style>

@endsection




@section('scripts')
<script type="text/javascript">

var dateToday = new Date();
var dateTomorrow = new Date();
var dateNextMonth = new Date();
dateTomorrow.setDate(dateToday.getDate()+1);
dateNextMonth.setDate(dateToday.getDate()+14);

$('#dateToUse').datepicker({
    startDate: dateNextMonth
});


$('.add-to-cart-btn').on('click', function(){
  var productID = $(this).find("input").val();
  var image = $(this).closest('.product-description').siblings('.product-img').find('img').attr('src');


  $.ajax({
    url: "/hinimo/public/addtoCart/"+productID
  });


  $.ajax({
    url: "/hinimo/public/getCart/"+productID,
    success:function(data){
        // $("#product").html(data.product)x    
      $(".cart-list").append('<div class="single-cart-item">' +
          '<a href="#" class="product-image">' +
              '<img src="'+ image +'" class="cart-thumb" alt="">' +

           
              '<div class="cart-item-desc">' +
                '<span id="delete" class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>' +
                  '<span class="badge">'+ data.owner.fname +'</span>' +
                  '<h6>'+ data.product.productName +'</h6>' +
                  '<p class="price">$'+ data.product.price +'</p>' +
              '</div>' +
          '</a>' +
      '</div>'
      );
    }
  }); //second ajax 
}); //main ending

$('.product-favourite').on('click', function(){
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