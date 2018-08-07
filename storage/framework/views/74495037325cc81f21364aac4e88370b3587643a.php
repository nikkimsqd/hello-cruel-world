<?php $__env->startSection('titletext'); ?>
  Boutique de Filipina
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
  Products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page">
<div id="content-wrapper">
<hr>


<section class="shop_grid_area">
<div class="container">


	<br>
	<a href="/hinimo/public/addproduct/">Add Products here</a>
	<br><br>



	<div class="product-topbar d-flex align-items-center justify-content-between">
        <!-- Total Products -->
        <div class="total-products">
            <p><span>186</span> products found</p>
        </div>
    </div>


    <!-- <div class="row"> -->
    	<!-- <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  -------------WALA PAKO NAHUMAN ARIIII---------------- -->
            <!--         <?php echo e($product->productFile); ?> -->
<!-- Single Product -->
 <!--        <div class="col-md-12 col-lg-3">
            <div class="single-product-wrapper"> -->
                <!-- Product Image -->
               <!--  <div class="product-img">

                <?php 
                $counter = 1;
                ?> 

                <?php $__currentLoopData = $product->productFile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
        
                <?php if($counter == 1): ?>
                    <img src="<?php echo e(asset('/uploads').$image['filename']); ?>" alt="">
                <?php elseif($counter == 2): ?> -->
                    <!-- Hover Thumb -->
                    <!-- <img class="hover-img" src="<?php echo e(asset('/uploads').$product->productFile); ?>" alt=""> -->
                   <!--  <?php endif; ?>
                    <?php $counter++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
                
                <!-- </div> -->

                <!-- Product Description --><!-- 
                <div class="product-description">
                    <span><?php echo e($product->owner['username']); ?></span>
                    <a href="single-product-details.html">
                        <h6><?php echo e($product['productName']); ?></h6>
                    </a>
                    <p class="product-price"><?php echo e($product['productPrice']); ?></p> -->

                    <!-- Hover Content -->
                    <!-- <div class="hover-content"> -->
                        <!-- Add to Cart -->
           <!--              <div class="add-to-cart-btn">
                            <a href="viewproduct/<?php echo e($product['productID']); ?>" class="btn essence-btn">View Product</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    <!-- Single Product End -->
		<!-- <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->

<!-- <br><br> -->
<!-- </div> -->

<!-- <div class="row">
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Carousel</h3>
            </div>
            <!-- /.box-header -->
            <!-- <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
           
                <div class="carousel-inner">
            <?php $__currentLoopData = $product->productFile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                  <div class="item">
                    <img src="<?php echo e(asset('/uploads').$image['filename']); ?>">

                  </div>



            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
                
              </div>
            </div> -->
            <!-- /.box-body -->
        
          <!-- </div> -->
          <!-- /.box -->
        <!-- </div> -->
        <!-- /.col -->
        <!-- <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
        <!-- </div> --> 



</div>

<!-- ------------------------NEW OPTION------------------------------ -->



<div class="row">
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


    <div class="col-md-3">

        <div class="box">
        	<div style="padding: 20px;">

        <?php 
            $counter = 1;
        ?>

        <?php $__currentLoopData = $product->productFile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if($counter == 1): ?>
            <img src="<?php echo e(asset('/uploads').$image['filename']); ?>" style="width: 100%; align-self: center;">
        <?php else: ?>
            
        <?php endif; ?>

        <?php $counter++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <a href="single-product-details.html">
            <h6><?php echo e($product['productName']); ?></h6>
        </a>

        <h2></h2>

        <style type="text/css">

        .hover{
          
        }

        </style>

        <div class="hover">
            <!-- Add to Cart -->
            <div class="add-to-cart-btn">
                <a href="viewproduct/<?php echo e($product['productID']); ?>" class="btn btn-block btn-primary">View Product</a>
            </div>
        </div>

    	</div>
        </div>
    </div>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>






</section>




</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>