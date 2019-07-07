@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
<!-- ##### Single Product Details Area Start ##### -->
<a href="{{url('view-bidding/'.$bid->bidding['id'])}}" class="back_to_page"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>

<section class="single_product_details_area d-flex align-items-center">

    <!-- Single Product Thumb -->
    <div class="single_product_thumb clearfix">
        <!-- <div class="product_thumbnail_slides owl-carousel"> -->
            @foreach($bid->bidding->productFile as $image)
            <img src="{{ asset('/uploads').$image['filename'] }}" alt="">
            @endforeach
        <!-- </div> -->
    </div>

    <?php
        $measurements = json_decode($bid->bidding->measurement->data);
    ?>

    <!-- Single Product Description -->
    <div class="single_product_desc clearfix">
        <span>By: &nbsp; {{$bid->bidding->owner['fname'].' '.$bid->bidding->owner['lname']}}</span>
        <!-- <h4>Maximum Price Limit: ₱{{ $bid->bidding['maxPriceLimit'] }}</h4> -->
        <p class="product-price"></p>
        <p class="product-price"><b>Maximum Price Limit:</b> &nbsp;  ₱{{ $bid->bidding['maxPriceLimit'] }}</p>
        <p><b>Bidding End Date:</b> &nbsp; {{ date('M d, Y',strtotime($bid->bidding['endDate'])) }}</p>
        <p><b>Deadline of Product:</b> &nbsp; {{ date('M d, Y',strtotime($bid->bidding['deadlineOfProduct'])) }}</p>
        <hr>
        <p><b>Your notes/instructions:</b></p>
        <p class="">{{ $bid->bidding['notes'] }}</p>
        <hr>
        <p><b>Your Measurements:</b></p>
        @foreach($measurements as $measurementName => $measurement)
        <p>{{$measurementName.': '. $measurement}}</p>
        @endforeach
        <p><b>Your height:</b> &nbsp; {{ $bid->bidding['height'] }}</p>
        <hr>
        <p><b>Your chosen Bid</b></p>
        <p><b>Boutique Name:</b> &nbsp; {{$bid->owner['boutiqueName']}}</p>
        <p><b>Boutique's plan:</b> &nbsp; {{$bid['plans']}}</p>
        <p class="product-price"><b>Bid:</b> &nbsp; ₱{{$bid['bidAmount']}}</p>

        <br>
        <span>When you continue, you will be creating an order for your bidding item</span>
            <a href="{{url('bidding/inputAddress/'.$bid['id'])}}" class="btn essence-btn">Continue</a>

    </div>
</section>


<style type="text/css">
    .table td{vertical-align: middle; padding: 0}
    p{line-height: 1.5; margin-bottom: 0; font-size: 16px;}
    .product-desc{margin-bottom: 1rem;}
    .price{text-align: right;}
    .payment-info{color: #0000;}
    .back_to_page{background-color: #ff084e; border-radius: 0;  box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.3); color: #ffffff; font-size: 18px;  height: 40px; line-height: 40px; right: 60px; left: 20px; top: 110px; text-align: center;  width: 40px; position: fixed; z-index: 2147483647; display: block;}
    /*a:hover{font-size: 18px; color: #ffffff;}*/
</style>

@endsection




@section('scripts')
<script type="text/javascript">

 $('.add-to-cart-btn').on('click', function(){
 var productID = $(this).find("input").val();
 var image = $(this).closest('.product-description').siblings('.product-img').find('img').attr('src');


 $.ajax({
     url: "/hinimo/public/addtoCart/"+productID,
     // type: "POST",
     // data: {id: productID}
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
                            '<p class="price">$'+ data.product.productPrice +'</p>' +
                        '</div>' +
                    '</a>' +
                '</div>'
                );
     }

 }); //second ajax
    
 }); //main ending




</script>
@endsection