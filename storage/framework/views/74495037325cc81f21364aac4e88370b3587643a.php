<?php $__env->startSection('titletext'); ?>
  Boutique de Filipina
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
  Products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="">
<div style="padding: 50px;">


	<br>
	<a href="/hinimo/public/addproduct/">Add Products here</a>
	<br><br>



	<div class="product-topbar d-flex align-items-center justify-content-between">
        <!-- Total Products -->
        <div class="total-products">
            <p><span>186</span> products found</p>
        </div>
    </div>



<!-- ------------------------NEW OPTION------------------------------ -->



<div class="row">
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


    <!-- <div class="col-md-3 col-sm-6 col-xs-12"> -->
        <div class="col-12 col-sm-6 col-lg-4">

        <div class="info-box" style="padding: 20px;">
        <div style="padding-right: 20px; padding-left: 20px;">

        <div class="row" style="width: auto; height: auto; overflow: hidden;">
            <?php 
                $counter = 1;
            ?>

            <?php $__currentLoopData = $product->productFile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if($counter == 1): ?>  
                <img src="<?php echo e(asset('/uploads').$image['filename']); ?>" style="width:calc(100% + 40px); height: 400px; object-fit: cover;">
            <?php else: ?>
                
            <?php endif; ?>

            <?php $counter++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>


        <div class="row">

            <a href="single-product-details.html">
                <h6><?php echo e($product['productName']); ?></h6>
            </a>

            <h2></h2>


            <div class="hover">
                <!-- Add to Cart -->
                <div class="add-to-cart-btn">
                    <a href="viewproduct/<?php echo e($product['productID']); ?>" class="btn btn-block btn-primary">View Product</a>
                </div>
            </div>
        </div>

    	</div>
        </div>
    </div>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>




</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.boutique', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>