@extends('layouts.hinimo')
@extends('hinimo.sections')


@section('body')
<!-- ##### Single Product Details Area Start ##### -->
    <a href="{{url('shop')}}" class="back_to_page"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>

    <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <!-- <div class="product_thumbnail_slides owl-carousel"> -->
                @foreach($product->productFile as $image)
                <img src="{{ asset('/uploads').$image['filename'] }}" alt="">
                @endforeach
            <!-- </div> -->
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span>{{$product->owner->boutiqueName}}</span>
            <h2>{{ $product['productName'] }}</h2>
            @if($product['price'] != null && $product['rpID'] != null)
            <p class="product-price">Retail Price: ₱{{ $product['price'] }}</p>
            <p class="product-price">Rent Price: ₱{{ $product->rentDetails['price'] }}</p>
            @elseif($product['price'] != null)
            <p class="product-price">Retail Price: ₱{{ $product['price'] }}</p>
            @elseif($product['rpID'] != null)
            <p class="product-price">Rent Price: ₱{{ $product->rentDetails['price'] }}</p>
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

                <input type="submit" class="btn essence-btn" value="Request to Rent" data-toggle="modal" data-target="#requestToRentModal{{$product['id']}}">

                <div class="product-favourite ml-4">
                    <a href="#" class="favme fa fa-heart"></a>
                </div>

                @elseif($product['rpID'] != null)
                <input type="submit" class="btn essence-btn" value="Request to Rent" data-toggle="modal" data-target="#requestToRentModal{{$product['id']}}">
            
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
                </div>

        </div>
    </section>


    <!-- MODAAAAAAAAAAAAAAAL-------------------------------->
    @if($user != null && $product['rpID'] != null)
    <div class="modal fade" id="requestToRentModal{{$product['id']}}" role="dialog">
        <div class="modal-dialog modal-lg">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title"><b>Rent Details</b></h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
            <div class="row justify-content-center checkout_details_area">
            <div class="col-md-11">
              <form action="/hinimo/public/requestToRent" method="post">
                {{csrf_field()}}

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-right">Product Rent Price:</label>
                    <div class="col-md-6">
                        <label class="col-form-label">{{$product->rentDetails['price']}}</label>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-right">Required Deposit Amount:</label>
                    <div class="col-md-6">
                        <label class="col-form-label">{{$product->rentDetails['depositAmount']}}</label>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-right">Required Penalty Amount:</label>
                    <div class="col-md-6">
                        <label class="col-form-label">{{$product->rentDetails['penaltyAmount']}}</label> 
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-right">Days item is available for rent:</label>
                    <div class="col-md-6">
                        <label class="col-form-label">{{$product->rentDetails['limitOfDays']}} days</label> 
                        <input type="text" name="limitOfDays" class="form-control" value="{{$product->rentDetails['limitOfDays']}}" hidden><br> 
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 col-form-label text-md-right">Fine incase item is lost:</label>
                    <div class="col-md-6">
                        <label class="col-form-label">{{$product->rentDetails['fine']}}</label> 
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Item is only allowed to be rented on these locations:</label>
                    <div class="col-md-6">
                        <?php $locs = json_decode($product->rentDetails['locationsAvailable']); ?>
                        @foreach($locs as $loc)
                            @foreach($cities as $city)
                            @if($city['citymunCode'] == $loc)
                            <label class="col-form-label">{{$city['citymunDesc']}},</label>
                            @endif
                            @endforeach 
                        @endforeach
                    </div>
                </div>

                <!-- // -->

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Name:</label>
                    <div class="col-md-6">
                        <input type="text" name="customerName" class="form-control" value="{{$user['lname'].', '.$user['fname']}}" disabled><br> 
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Email Address:</label>
                    <div class="col-md-6">
                        <input type="text" name="email" class="form-control" value="{{$user['email']}}" disabled><br> 
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Contact Number:</label>
                    <div class="col-md-6">
                        <input type="text" name="phoneNumber" class="form-control"><br> 
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-8 col-form-label text-md-right">Submit Measurements (inches)</label>
                </div>

                <div class="form-group row">
                    @foreach($product->getCategory->getMeasurements as $measurements)
                    <label class="col-md-4 col-form-label text-md-right">{{$measurements['mName']}}:</label>
                    <div class="col-md-6" id="measurement-input">
                        <input type="text" name="measurement[{{$measurements['mName']}}]" class="form-control"><br> 
                    </div>
                    @endforeach
                </div><br>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Date Item will be used:</label>
                    <div class="col-md-6">
                        <input type="date" name="dateToUse" class="form-control"><br> 
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Additional Notes:</label>
                    <div class="col-md-6">
                        <textarea name="additionalNotes" rows="3" cols="50" class="input form-control" placeholder="Type here your message to the seller like if you have changes to be done"></textarea><br> 
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Address of delivery:</label>
                    <div class="col-md-6">
                        <input type="text" name="addressOfDelivery" class="input form-control"><br>
                    </div>
                </div>

                <input type="text" name="boutiqueID" value="{{$product->owner->id}}" hidden>
                <input type="text" name="productID" value="{{$product['id']}}" hidden>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Subtotal:</label>
                    <div class="col-md-6">
                        <label class="col-form-label">{{$product->rentDetails['price']}}</label>
                        <input type="text" name="subtotal" class="form-control" value="{{$product->rentDetails['price']}}" hidden>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Required Deposit Amount:</label>
                    <div class="col-md-6">
                        <label class="col-form-label">{{$product->rentDetails['depositAmount']}}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Delivery Fee:</label>
                    <div class="col-md-6">
                        <label class="col-form-label">50</label>
                        <input type="text" name="deliveryfee" class="form-control" value="50" hidden>
                    </div>
                </div>

                <hr>
                <?php $total = $product->rentDetails['price'] + $product->rentDetails['depositAmount'] + 50; ?> <!-- replace 50 with delveryfee -->
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Total Payment:</label>
                    <div class="col-md-6">
                        <label class="col-form-label">{{$total}}</label>
                        <input type="text" name="total" class="form-control" value="{{$total}}" hidden>
                    </div>
                </div>

                <div class="form-group row">
                    <!-- <label class="col-md-4 col-form-label text-md-right">Total Payment:</label> -->
                    <input type="checkbox" id="t&c" class="form-control col-md-4" required>
                    <div class="col-md-6">
                        <label for="t&c">I agree to Terms & Conditions</label>
                    </div>
                </div>

            </div>
            </div>
            </div> <!-- modal body -->

            <div class="modal-footer">
              <input type="submit" class="btn essence-btn" value="Place Request">
              <!-- <input type="" class="btn essence-btn" data-dismiss="modal" value="Cancel"> -->
              </form>

            </div>
          </div>
          
        </div>
    </div>
    <!-- ##### Single Product Details Area End ##### -->
    @else
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