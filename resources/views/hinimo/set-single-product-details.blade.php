@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
<!-- ##### Single Product Details Area Start ##### -->
    <a href="{{url('shop')}}" class="back_to_page"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>

    <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix test">
            <div class="product_thumbnail_slides owl-carousel">
                @foreach($set->items as $item)
                @foreach($item->product->productFile as $image)
                <img src="{{ asset('/uploads').$image['filepath'] }}" alt="">
                <?php break; ?>
                @endforeach
                @endforeach
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span>{{$set->owner->boutiqueName}}</span>
            <h2>{{ $set['setName'] }}</h2>
            @if($set['price'] != null && $set['rpID'] != null)
            <p class="product-price">Retail Price: ₱{{ number_format($set['price']) }}</p>
            <p class="product-price">Rent Price: ₱{{ number_format($set->rentDetails['price']) }}</p>
            @elseif($set['price'] != null)
            <p class="product-price">Retail Price: ₱{{ number_format($set['price']) }}</p>
            @elseif($set['rpID'] != null)
            <p class="product-price">Rent Price: ₱{{ number_format($set->rentDetails['price']) }}</p>
            @endif
            <p class="product-desc">{{ $set['setDesc'] }}</p>
            <p class="product-desc">In Stock: {{ $set['quantity'] }}</p>

            <?php $counter = 1; ?>
            @foreach($set->items as $item)
            <hr>
                <p class="product-name">Product {{$counter}}</p>
                <h4 class="product-nomargin"><b>{{$item->product['productName']}}</b></h4>
                <!-- <p class="product-nomargin">Available Sizes:</p> -->

                @if($item['measurements'] != null)
                    <p class="product-desc">Maximum Measurement:</p>
                    <?php $measurements = json_decode($item['measurements']) ?>
                    @foreach($measurements as $measurementName => $value)
                        <p>{{$measurementName}}: &nbsp; {{$value}} inches</p>
                    @endforeach
                    <br>

                @elseif($item->product['rtwID'] != null)

                    <?php  
                        $rtwSizes = json_decode($item->product->rtwDetails['sizes']);
                    ?>
                    <div class="select-box d-flex mb-30">
                        <select name="select" id="{{$item->product['id']}}" class="mr-5 productSize{{$counter}}">
                            @foreach($rtwSizes as $rtwSize => $value)
                                <option value="xs">{{ucfirst($rtwSize)}}</option>
                            @endforeach
                        </select>
                    </div>

                @endif



                <?php $counter ++; ?>
            @endforeach

                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                @if ($set['price'] != null && $set['rpID'] != null)     <!-- if item is available for rent & purchase -->

                    @if($user != null)
                        <div class="add-to-cart-btn">
                            <input type="text" name="productID" value="{{$set['id']}}" hidden>
                            <a class="btn essence-btn">Add to Cart</a>&nbsp;
                        </div>
                    @else
                        <a class="btn essence-btn">Add to Cart</a>&nbsp;
                    @endif

                <a href="{{url('requestToRentSet/'.$set['id'])}}" class="btn essence-btn">Request to Rent</a>

                @elseif($set['rpID'] != null)
                <a href="{{url('requestToRentSet/'.$set['id'])}}" class="btn essence-btn">Request to Rent</a>
            
                @elseif($set['price'] != null)

                    @if($user != null)
                    <div class="add-to-cart-btn">
                        <input type="text" name="productID" value="{{$set['id']}}" hidden>
                        <input type="text" name="counter" value="{{$counter-1}}" id="counter" hidden>
                        <a class="btn essence-btn">Add to Cart</a>&nbsp;
                    </div>
                    @else
                        <input type="submit" class="btn essence-btn" value="Add to Cart" data-toggle="modal" data-target="#LoginModal">
                    @endif
                @endif

                @if($user != null)
                @if($set->inFavorites)
                <div class="product-favourite ml-4">
                    <input type="text" name="productID" value="{{$set['id']}}" hidden>
                    <a href="#" class="favme fa fa-heart active"></a>
                </div>
                @else
                <div class="product-favourite ml-4">
                    <input type="text" name="productID" value="{{$set['id']}}" hidden>
                    <a href="#" class="favme fa fa-heart"></a>
                </div>
                @endif
                @endif
                </div>

        </div>
    </section>


    <!-- MODAAAAAAAAAAAAAAAL-------------------------------->
    @if($user == null && $set['rpID'] != null)
    <div class="modal fade" id="requestToRentModal{{$set['id']}}" role="dialog">
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
    .product-price{font-size: 20px !important; line-height: 1.5;}
    .product-name{line-height: 1.5; margin-bottom: 0; margin-top: 10px}
    .product-nomargin{margin-bottom: 0;}
    .price{text-align: right;}
    .payment-info{color: #0000;}
    .back_to_page{background-color: #ff084e; border-radius: 0;  box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.3); color: #ffffff; font-size: 18px;  height: 40px; line-height: 40px; right: 60px; left: 20px; top: 110px; text-align: center;  width: 40px; position: fixed; z-index: 2147483647; display: block;}
    /*a:hover{font-size: 18px; color: #ffffff;}*/
    .datepicker-dropdown{top: 181px !important; left: 281.5px; z-index: 11; display: block;}
    .select-box{margin-top: 20px}
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
    var setID = $(this).find("input").val();
    var image = $(this).closest('.product-description').siblings('.product-img').find('img').attr('src');

    // var size = $('.nice-select').find(":selected").text();
    var size = $('.productSize').next().find('.list .selected').data('value');
    var counter = $('#counter').val();

    var sizes = [];

    for( var i = 1; counter >= i; i++){

        var size = $('.productSize'+i).next().find('.list .selected').data('value');
        var productId = $('.productSize'+i).attr('id');
        sizes.push(productId + '-' + size);
    }

    $.ajax({
        url: "/hinimo/public/addSettoCart/"+setID,
        type: 'GET',
        data: {sizes},
        success:function(data){
            location.reload();
        }
    });


    // $.ajax({
    //     url: "/hinimo/public/getCart/"+setID,
    //     success:function(data){
    //         // $("#product").html(data.product)x    
    //         $(".cart-list").append('<div class="single-cart-item">' +
    //             '<a href="#" class="product-image">' +
    //                 '<img src="'+ image +'" class="cart-thumb" alt="">' +

                 
    //                 '<div class="cart-item-desc">' +
    //                   '<span id="delete" class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>' +
    //                     '<span class="badge">'+ data.owner.fname +'</span>' +
    //                     '<h6>'+ data.product.productName +'</h6>' +
    //                     '<p class="price">$'+ data.product.price +'</p>' +
    //                 '</div>' +
    //             '</a>' +
    //         '</div>'
    //         );
    //     }
    // }); //second ajax
    
}); //main ending


$('.product-favourite').on('click', function(){
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




</script>
@endsection