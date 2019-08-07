@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
<!-- ##### Single Product Details Area Start ##### -->
<a href="{{url('biddings')}}" class="back_to_page"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>

<section class="single_product_details_area d-flex align-items-center">

    <!-- Single Product Thumb -->
    <div class="single_product_thumb clearfix">
        <!-- <div class="product_thumbnail_slides owl-carousel"> -->
            @foreach($bidding->productFile as $image)
            <img src="{{ asset('/uploads').$image['filename'] }}" alt="">
            @endforeach
        <!-- </div> -->
    </div>

    <?php
        // $measurements = json_decode($bidding->measurement->data);
    ?>

    <!-- Single Product Description -->
    <div class="single_product_desc clearfix">
        @if($bidding['status'] == "Closed")
        <p class="product-price">[CLOSED]</p>
        @endif
        <span>By: &nbsp; {{$bidding->owner['fname'].' '.$bidding->owner['lname']}}</span>
        <!-- <h4>Maximum Price Limit: ₱{{ $bidding['maxPriceLimit'] }}</h4> -->
        <p><b>Maximum Price Limit:</b> &nbsp;  ₱{{ $bidding['quotationPrice'] }}</p>
        <p><b>Bidding End Date:</b> &nbsp; {{ date('M d, Y',strtotime($bidding['endDate'])) }}</p>
        <p><b>Deadline of Product:</b> &nbsp; {{ date('M d, Y',strtotime($bidding['deadlineOfProduct'])) }}</p>
        <hr>
        <p><b>Customer's notes/instructions:</b></p>
        <p class="">{{ $bidding['notes'] }}</p>
        <hr>
        <p><b>Number of offers:</b> &nbsp; {{$bidsCount}}</p>
        

        <br>
        <!-- Cart & Favourite Box -->
        @if($bidding['status'] == "Closed" && $bidding['bidID'] != null)
        <div class="cart-fav-box d-flex align-items-center">
            <a href="{{url('view-bidding-order/'.$bidding['id'])}}" class="btn essence-btn">View Order Details</a>
        </div>
        @endif

    </div>
</section>

@if($bidding['userID'] == $userID && $bidding['bidID'] == null)
<hr>
<section class="align-items-center" id="bidders">
    <div class="row justify-content-center section-padding-80">
        <div class="col-md-10">
            @if(count($bids))
            <h3>Your bidders</h3>
            @foreach($bids as $bid)
            <hr>
            <table class="table table-borderless">
                <col width="698"><col width="349">
                <tr>
                    <td><p><b>Boutique Name:</b> &nbsp; {{$bid->owner['boutiqueName']}}</p></td>
                    <td rowspan="3"> <a href="{{url('reviewBidding/'.$bid['id'])}}" class="btn essence-btn">Accept Offer</a></td>
                </tr>
                <tr>
                    <td><p><b>Boutique Address:</b> &nbsp; {{$bid->owner['boutiqueAddress']}}</p></td>
                </tr>
                @if($bid['fabricName'] != null)
                <tr>
                    <td><p><b>Boutique's Fabric Suggestion:</b> &nbsp; {{$bid['fabricName']}}</p></td>
                </tr>
                @endif
                <tr>
                    <td><p class="product-price"><b>Bid:</b> &nbsp; ₱{{$bid['quotationPrice']}}</td></p>
                </tr>
            </table>
            @endforeach
            @else
                <h3>You have no bidders</h3>
            @endif
        </div>
    </div>
</section>
@endif


<!-- MODAAAAAAAAAAAAAAAL-------------------------------->
<div class="modal fade" id="submitABidModal{{$bidding['id']}}" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title"><b>Submit your bid</b></h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{url('submitBid')}}" method="post">
                        {{csrf_field()}}
                    <input type="number" name="bidAmount" min="1" max="{{$bidding['maxPriceLimit']}}" class="form-control">
                    <input type="text" name="biddingID" value="{{$bidding['id']}}" hidden>
                </div>
            </div>
        </div> <!-- modal body -->

        <div class="modal-footer">
          <input type="submit" class="btn essence-btn" value="Submit Bid">
          <!-- <input type="" class="btn essence-btn" data-dismiss="modal" value="Cancel"> -->
          </form>

        </div>
      </div>
      
    </div>
</div>

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