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

  <section class="shop_grid_area section-padding-80">
    <div class="container">
      <div class="row">
        <!-- <div class="col-12 col-md-4 col-lg-3">
          <div class="shop_sidebar_area">

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
             
            <div class="widget brands mb-50">
              <p class="widget-title2 mb-30">Boutiques</p>
              <div class="widget-desc">
                <ul>
                  @foreach($boutiques as $boutique)
                  <li><a href="{{url('/boutique').'/'.$boutique['id']}}">{{$boutique['boutiqueName']}}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div> -->

        <div class="col-12 col-md-12 col-lg-12"> 
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
                        <option value="value">Price: ₱10,000 - ₱5,000</option>
                        <option value="value">Price: ₱1,000 - ₱5,000</option>
                        <option value="value">Price: below $1,000</option>
                      </select>
                      <input type="submit" class="d-none" value="">
                    </form> 
                  </div>

                  <!-- Sorting -->
                  <div class="product-sorting d-flex">
                    <p>Sort by:</p>
                    <form action="#" method="get">
                      <select name="select" id="sortByselect">
                        <option value="highest_rated">Highest Rated</option>
                        <option value="newest">Newest</option>
                        <option value="value">Price: ₱10,000 - ₱5,000</option>
                        <option value="value">Price: ₱1,000 - ₱5,000</option>
                        <option value="value">Price: below $1,000</option>
                      </select>
                      <input type="submit" class="d-none" value="">
                    </form> 
                  </div>

                  <!-- Sorting -->
                  <div class="product-sorting d-flex">
                    <p>Sort by:</p>
                    <form action="#" method="get">
                      <select name="select" id="sortByselect">
                        <option value="highest_rated">Recommended</option>
                        <option value="newest">Newest</option>
                        <option value="value">Price: ₱10,000 - ₱5,000</option>
                        <option value="value">Price: ₱1,000 - ₱5,000</option>
                        <option value="value">Price: below $1,000</option>
                      </select>
                      <input type="submit" class="d-none" value="">
                    </form> 
                  </div>

                </div>
              </div>
            </div>



           
          </div>

          <div class="products_list row"> 
            @foreach($products as $product)
            @if($product['productStatus'] == "Not Available")
            <div class="col-12 col-sm-6 col-lg-3">
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

                    <div class="product-badge offer-badge">
                      <span>NOT AVAILABLE</span>
                    </div>
                  </div>
                  
                  <?php $counter++; ?>
                @endforeach

                <div class="product-description">
                  <span>{{ $product->owner['boutiqueName'] }}</span>
                  <a href="#">
                      <h6>{{ $product['productName'] }}</h6>
                  </a>
                  <p class="product-price">₱{{ number_format($product['price']) }}</p>

                  <div class="hover-content">
                    <div class="add-to-cart-btn">
                      @if($product['productStatus'] == "Available")
                      <a href="single-product-details/{{$product['id']}}" class="btn essence-btn">View Product</a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            @endforeach

          </div>
        </div>
      </div>
    </div>
  </section>


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

  $('#sortByselect').on('change', function(){
    var condition = $(this).val();
    var counter = 1;

    $.ajax({
     url: "{{ url('/getProducts') }}" + '/' + condition,
     success:function(data){

      $(".products_list").empty();
      data.products.forEach(function(product) {

        $(".products_list").append('<div class="col-12 col-sm-6 col-lg-4">' +
          '<div class="single-product-wrapper">' + 
            '<div class="product-img">' +   

            
            
              '<div class="product-favourite"> <a href="#" class="favme fa fa-heart"></a></div>' +
            '</div>' +

            '<div class="product-description">' +
            '<span>' + product.owner.boutiqueName +'</span>' +
            '<a href="#"> <h6>' + product.productName + '</h6> </a>' +
            '<p class="product-price">$' + product.price + '</p>' +

              '<div class="hover-content">' +
                '<div class="add-to-cart-btn">' +
                '<input type="text" name="productID" value="' + product.id + '" hidden>' +
                '<a href="single-product-details/' + product.id + '" class="btn essence-btn">View Product</a>' +
                '</div>' +
              ' </div>' +
            ' </div>' +
          ' </div>' +
          ' </div>'
          );

        console.log(product.productFile.filename);
        // console.log(product);
        // console.log(product.owner.boutiqueName);
      });
     }
    });
});



</script>

@endsection