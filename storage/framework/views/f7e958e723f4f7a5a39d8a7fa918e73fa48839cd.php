<?php $__env->startSection('titletext'); ?>
	Hinimo
<?php $__env->stopSection(); ?>


<?php $__env->startSection('search'); ?>
<!-- Search Area -->
    <div class="search-area">
        <form action="#" method="post">
            <input type="search" name="search" id="headerSearch" placeholder="Type for search">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('favorites'); ?>
<!-- Favourite Area -->
    <div class="favourite-area">
        <a href="#"><img src="<?php echo e(asset('essence/img/core-img/heart.svg')); ?>" alt=""></a>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('userinfo'); ?>

<!-- User Login Info -->
    <div class="user-login-info classynav">
        <ul>
            <li> <a href="#"><img src="<?php echo e(asset('essence/img/core-img/user1.svg')); ?>"></a>
            <ul class="dropdown">
                <li><a href="user-account/<?php echo e($userID); ?>">My account</a></li>
                <li><a href="shop.html">My Purchase</a></li>
                <li><a href="<?php echo e(route('logout')); ?>"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <?php echo e(__('Logout')); ?>

                    </a></li>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                

            </ul>
            </li>
        </ul>
    
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>
<div id="page" style="background-color: white;">


	<!-- ##### Welcome Area Start ##### -->
    <section class="welcome_area bg-img background-overlay" style="background-image: url(long/o.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        <h6>asoss</h6>
                        <h2>New Collection</h2>
                        <a href="#" class="btn essence-btn">view collection</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Welcome Area End ##### -->


    <!-- ##### Top Catagory Area Start ##### -->
    <div class="top_catagory_area section-padding-80 clearfix">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(long/h.jpg);">
                        <div class="catagory-content">
                            <a href="shop/womens">Womens</a>
                        </div>
                    </div>
                </div>
                <!-- Single Catagory -->
                <div class="col-sm-6 col-md-6">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(mens/b.jfif);">
                        <div class="catagory-content">
                            <a href="shop/mens">Mens</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Top Catagory Area End ##### -->


    <!-- ##### CTA Area Start ##### -->
    <div class="cta-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-content bg-img background-overlay" style="background-image: url(essence/img/bg-img/bg-5.jpg);">
                        <div class="h-100 d-flex align-items-center justify-content-end">
                            <div class="cta--text">
                                <h6>-60%</h6>
                                <h2>Global Sale</h2>
                                <a href="#" class="btn essence-btn">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### CTA Area End ##### -->

    <!-- ##### New Arrivals Area Start ##### -->
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Recent Products</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">

                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    				<?php $__currentLoopData = $product->productFile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="<?php echo e(asset('/uploads').$image['filename']); ?>" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="<?php echo e(asset('/uploads').$image['filename']); ?>" alt="">
                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span><?php echo e($product->owner['username']); ?></span>
                                <a href="single-product-details.html">
                                    <h6><?php echo e($product['productName']); ?></h6>
                                </a>
                                <p class="product-price">$<?php echo e($product['productPrice']); ?></p>

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="#" class="btn essence-btn">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### New Arrivals Area End ##### -->



</div> <!-- sa page -->

<?php $__env->stopSection(); ?>



<?php $__env->startSection('cartbutton'); ?>

<!-- Cart Area -->
    <div class="cart-area">
        <a href="#" id="essenceCartBtn"><img src="<?php echo e(asset('essence/img/core-img/bag.svg')); ?>" alt="">
        <?php if($cartCount > 0): ?>
            <span><?php echo e($cartCount); ?></span>
        <?php else: ?>
        <?php endif; ?>
        </a>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('cart'); ?>

<!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div id="cart-area" class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="<?php echo e(asset('essence/img/core-img/bag.svg')); ?>" alt=""> 
            <?php if($cartCount > 0): ?>
                <span><?php echo e($cartCount); ?></span>
            <?php else: ?>
            <?php endif; ?>
            </a>
        </div>

        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list">
                <!-- Single Cart Item -->
                <?php
                    $subtotal = 0;
                ?>
                <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img src="<?php echo e(asset('/uploads').$cart->productFile['filename']); ?>" class="cart-thumb" alt="">

                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <span id="delete" class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                            <span class="badge"><?php echo e($cart->owner['username']); ?></span>
                            <h6><?php echo e($cart->product['productName']); ?></h6>
                            <!-- <p class="size">Size: S</p> -->
                            <!-- <p class="color">Color: Red</p> -->
                            <p class="price">$<?php echo e(number_format($cart->product['productPrice'])); ?></p>
                        </div>
                    </a>
                </div>
                <?php
                    $subtotal += $cart->product['productPrice'];
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Cart Summary -->
            <div class="cart-amount-summary">

                <h2>Summary</h2>
                <ul class="summary-table">
                    <li><span>subtotal:</span> <span>$<?php echo e(number_format($subtotal, 2)); ?></span></li>
                    <!-- <li><span>delivery:</span> <span>Free</span></li> -->
                    <!-- <li><span>discount:</span> <span>-15%</span></li> -->
                    <!-- <li><span>total:</span> <span>$232.00</span></li> -->
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="/hinimo/public/cart" class="btn essence-btn">open cart</a>
                </div>
            </div>
        </div>
    </div>
<!-- ##### Right Side Cart End ##### -->


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.hinimo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>