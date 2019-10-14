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

        <div class="col-12 col-md-12 col-lg-12"> 
          <div class="shop_grid_product_area">
            <div class="row">
              <div class="col-12">
                <div class="product-topbar d-flex align-items-center justify-content-between">
                  <!-- Sorting -->
                  <div class="product-sorting d-flex">
                    <p>Select Event:</p>
                      <select name="select" id="sortByEvent">
                        <option disabled selected>-- Select event --</option>
                      @foreach($eventNames as $event => $value)
                        <option value="{{$event}}">{{$event}}</option>
                      @endforeach
                      </select>
                  </div>

                  <!-- Sorting -->
                <!--   <div class="product-sorting d-flex">
                    <p>Select Type:</p>
                      <select name="select" id="sortByType">
                        <option disabled selected>-- Select event first --</option>
                      </select>
                  </div> -->

                  <!-- Total Products -->
                  <div class="total-products">
                      <p><span>{{$productsCount}}</span> products found</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="products_list row"> 
            @foreach($products as $product)
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="single-product-wrapper">
                <?php 
                    $counter = 1;
                ?>
              
                @foreach($product->productFile as $image)
                  <div class="product-img">
                    @if($counter == 1)    
                      <img src="{{ asset('/uploads').$image['filepath'] }}" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">
                    @else
                    @endif

                    @if($product['productStatus'] == "Not Available")
                      <div class="product-badge offer-badge">
                        <span>NOT AVAILABLE</span>
                      </div>
                    @elseif($product['rpID'] != null && $product['price'] != null)
                      <div class="product-badge new-badge">
                        <span>RENTABLE</span>
                      </div>
                    @elseif($product['rpID'] != null && $product['price'] == null)
                      <div class="product-badge new-badge">
                        <span>FOR RENT ONLY</span>
                      </div>
                    @endif
                                        
                    @if($product->inFavorites)
                      <div class="product-favourite unfavorite-product">
                        <input type="text" name="productID" value="{{$product['id']}}" hidden>
                        <a href="#" class="favme fa fa-heart active"></a>
                      </div>
                    @else
                      <div class="product-favourite ml-4 favorite-product">
                        <input type="text" name="productID" value="{{$product['id']}}" hidden>
                        <a href="#" class="favme fa fa-heart"></a>
                      </div>
                    @endif
                  </div>
                  
                  <?php $counter++; ?>
                @endforeach

                <div class="product-description">
                  <span>{{ $product->owner['boutiqueName'] }}</span>
                  <a href="#">
                      <h6>{{ $product['productName'] }}</h6>
                  </a>
                  @if($product['price'] != null)
                  <p class="product-price">₱{{ number_format($product['price']) }}</p>
                  @else
                  <p class="product-price">₱{{ number_format($product->rentDetails['price']) }}</p>
                  @endif

                  <div class="hover-content">
                    <div class="add-to-cart-btn">
                      <!-- @if($product['productStatus'] == "Available") -->
                      <a href="single-product-details/{{$product['id']}}" class="btn essence-btn">View Product</a>
                      <!-- @endif -->
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


<style type="text/css">
  .product-topbar .nice-select{min-width: 180px;}
</style>
@endsection



@section('scripts')
<script type="text/javascript">

  $('#sortByEvent').on('change', function(){
    var event = $(this).val();
    var counter = 1;

    if(event != null){
      $('#sortByType').prop('disabled',false);
      // console.log($('.sortByType').val());
    }
    console.log(event);


    $.ajax({
     url: "{{ url('/getEventTags') }}/" + event,
     success:function(data){
      $(".products_list").empty();


        data.sortedProducts.forEach(function(product) {
          // products.forEach(function(product) {
          var name = null;
          var price = null;
          var picture = null;
          var fileAddress = "<?= asset('/uploads') ?>";
          var productID = product.id;

          if(product.productName != null){
            name = product.productName;
            picture = data.productURL[productID][0];
          }else{
            name = product.setName;
            picture = data.setURL[productID][0];
          }

          if(product.price != null){
            price = product.price;
          }else{
            price = product.rentDetails.price;
          }


          $(".products_list").append(
            '<div class="col-12 col-sm-6 col-lg-3">' +
              '<div class="single-product-wrapper">' + 

                '<div class="product-img">' +


                  '<img src="' + fileAddress + '/' + picture + '" style="width:calc(100% + 40px); height: 350px; object-fit: cover; ">' +
                
                  '<div class="product-favourite">' +
                    '<a href="#" class="favme fa fa-heart"></a>' +
                  '</div>' +
                '</div>' +


                '<div class="product-description">' +
                  '<span>' + product.owner.boutiqueName +'</span>' +
                  '<a href="#"> <h6>' + name + '</h6> </a>' +
                  '<p class="product-price">$' + price + '</p>' +

                  '<div class="hover-content">' +
                    '<div class="add-to-cart-btn">' +
                    '<input type="text" name="productID" value="' + product.id + '" hidden>' +
                    '<a href="single-product-details/' + product.id + '" class="btn essence-btn">View Product</a>' +
                    '</div>' + 
                '</div>' + 
                '</div>' + 
              '</div>' + 
            '</div>'
            );

          // console.log(product.productFile.filename);
          // });
        });

      data.tags.forEach(function(tag) {
        $('#sortByType').next().find('.list').append('<li data-value="" class="option">'+ tag['name'] +'</li>');
      });
     }
    });
});



</script>

@endsection