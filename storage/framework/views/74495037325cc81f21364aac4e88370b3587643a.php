<?php $__env->startSection('titletext'); ?>
  Boutique de Filipina
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<div class="page">
<div id="content-wrapper" style="background-color: white;">
<hr>


<section class="shop_grid_area section-padding-80">
<div class="container">
<div class="row">

<div class="col-8 col-md-8 col-lg-9">
<!-- <div class="shop_grid_product_area">
<div class="row">
<div class="col-12">

</div>
</div>


</div> -->
	<br>
	<a href="/hinimo/public/addproduct/">Add Products here</a>
	<br><br>



	<div class="product-topbar d-flex align-items-center justify-content-between">
        <!-- Total Products -->
        <div class="total-products">
            <p><span>186</span> products found</p>
        </div>
    </div>


    <div class="row">
    	<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <!--  -------------WALA PAKO NAHUMAN ARIIII---------------- -->
            <!--         <?php echo e($product->productFile); ?> -->
<!-- Single Product -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="single-product-wrapper">
                <!-- Product Image -->
                <div class="product-img">

                <?php 
                $counter = 1;
                ?> 

                <?php $__currentLoopData = $product->productFile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
        
                <?php if($counter == 1): ?>
                    <img src="<?php echo e(asset('/uploads').$image['filename']); ?>" alt="">
                    <img class="hover-img" src="<?php echo e(asset('/uploads').$product->productFile); ?>" alt="">
                <?php elseif($counter == 2): ?>
                    <!-- Hover Thumb -->
                    <img class="hover-img" src="<?php echo e(asset('/uploads').$product->productFile); ?>" alt="">
                    <?php endif; ?>
                    <?php $counter++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                
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
                    <p class="product-price"><?php echo e($product['productPrice']); ?></p>

                    <!-- Hover Content -->
                    <div class="hover-content">
                        <!-- Add to Cart -->
                        <div class="add-to-cart-btn">
                            <a href="#" class="btn essence-btn">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Single Product End -->
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<br><br>
</div>



</div>
</div>
</div>
</section>




</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>