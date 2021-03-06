@extends('layouts.hinimo')
@extends('hinimo.sections')

@section('body')
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
<!-- ##### Blog Wrapper Area Start ##### -->
<div class="blog-wrapper" style="padding-top: 30px; padding-bottom: 30px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-11">
        <div class="regular-page-content-wrapper">
          <div class="regular-page-text">
            <div class="row">
              <div class="col-md-8">
                <div class="row tops-div">
                  @foreach($products as $product)
                    @if($product->getCategory['categoryName'] == "Tops")
                    <div class="col-md-3">
                      <?php $counter = 1; ?>
                      @foreach( $product->productFile as $image)
                        @if($counter == 1)
                          <label class="product-top product-top{{$product['id']}}">
                            <input type="radio" name="product" class="productTop" value="{{$product['id']}}">
                            <img src="{{ asset('/uploads').$image['filename'] }}" style="width:100%; height: 100%; object-fit: cover;">
                          </label>
                        @endif
                        <?php $counter++; ?>
                      @endforeach
                    </div>
                    @endif
                  @endforeach
                </div>
                <div class="row bottoms-div">
                  @foreach($products as $product)
                    @if($product->getCategory['categoryName'] == "Shorts" || 
                    $product->getCategory['categoryName'] == "Trousers" || 
                    $product->getCategory['categoryName'] == "Pants" || 
                    $product->getCategory['categoryName'] == "Bottoms")

                    <div class="col-md-3">
                      <?php $counter = 1; ?>
                      @foreach( $product->productFile as $image)
                        @if($counter == 1)
                          <label class="product-bottom product-bottom{{$product['id']}}">
                            <input type="radio" name="product" class="productBottom" value="{{$product['id']}}">
                            <img src="{{ asset('/uploads').$image['filename'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                          </label>
                        @endif
                        <?php $counter++; ?>
                      @endforeach
                    </div>
                    @endif
                  @endforeach
                </div>
              </div>
              <div class="col-md-4">
                  <!-- <form action="{{url('submitMixnmatch')}}" method="post"> -->
                      <!-- {{csrf_field()}} -->
                     <div class="row">
                         <div class="col-md-12 view-top">
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12 view-bottom">
                         </div>
                     </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12" style="text-align: right;"><br><br>
                <div class="add-to-cart-btn">
                  <div id="view-top">
                      
                  </div>
                  <div id="view-bottom">
                      
                  </div>
                  <!-- input type="text" id="top" name="top" value="" hidden>
                  <input type="text" id="bottom" name="bottom" value="" hidden> -->
                  <a href="" class="btn essence-btn">Add items to Cart</a>&nbsp;
                </div>
                <!-- <input type="submit" name="btn" value="Add items to cart" class="btn essence-btn"> -->
                <!-- </form> -->
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<style type="text/css">

  .tops-div{
    height: 350px;
    border: 1px solid #cecece;
  }

  .bottoms-div{
    height: 350px;
    border: 1px solid #cecece;
    overflow-y: scroll;
  }

  .view-top{
    height: 350px;
    border: 1px solid #cecece;
  }

  .view-bottom{
    height: 350px;
    border: 1px solid #cecece;
  }

  .product-top, .product-bottom{
    height: 150px;
    width: 150px;
    overflow: hidden;
  }

  [type=radio] { 
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
  }

  [type=radio] + img {
    cursor: pointer;
  }

  /*[type=radio]:checked + img {
    outline: 2px solid #f00;
  }*/

  .selected-item{
    outline: 2px solid #f00;
  }
</style>
@endsection



@section('scripts')
<script type="text/javascript">


  $('.productTop').on('change', function(){
    var productID = $(this).val();
    $('.product-top').removeClass('selected-item');
    $('.product-top'+productID).addClass('selected-item');

    $.ajax({
      url: "/hinimo/public/getMProduct/"+productID,
      success:function(data){
        data.files.forEach(function(file){
        $('.view-top').empty();
        $('#view-top').empty();

        $('.view-top').append('<img src="{{asset("/uploads")}}.'+file.filename+'" style="width:100%; height: 100%; object-fit: cover;">');
        $('#view-top').append('<input type="text" name="top" value="'+ data.product.id +'" hidden>');
        // var top = $('#view-top').val();
        // console.log(top);
        });
      }
    });
  });

  $('.productBottom').on('change', function(){
    var productID = $(this).val();
    $('.product-bottom').removeClass('selected-item');
    $('.product-bottom'+productID).addClass('selected-item');

    $.ajax({
      url: "/hinimo/public/getMProduct/"+productID,
      success:function(data){
        data.files.forEach(function(file){
        $('.view-bottom').empty();
        $('#view-bottom').empty();

        $('.view-bottom').append('<img src="{{asset("/uploads")}}.'+file.filename+'" style="width:100%; height: 100%; object-fit: cover;">');
        $('#view-bottom').append('<input type="text" name="bottom" value="'+ data.product.id +'" hidden>');
        });
        // var bots = $('.productBottom').val();  
      }
    });
  });


  $('.add-to-cart-btn').on('click', function(){
  var image = $(this).closest('.product-description').siblings('.product-img').find('img').attr('src');
  var top = $('#view-top').find("input").val();
  var bottom = $('#view-bottom').find("input").val();
  // alert(top);

  $.ajax({
    url: "/hinimo/public/addtoCart/"+top
  });

  $.ajax({
       url: "/hinimo/public/addtoCart/"+bottom
  });

  $.ajax({
    url: "/hinimo/public/getCart/"+top,
    success:function(data){  
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