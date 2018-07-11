<?php $__env->startSection('titletext'); ?>
  Boutique de Filipina
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<div class="page">
<div id="content-wrapper" style="background-color: white;">

<section id="home" style="height: 170px;  background-size:cover; ">
</section>
<hr>

<div>
	<br>
	<form action="<?php echo e(url('/uploadproduct')); ?>" method="post" enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?>

		<input type="file" name="product[]" multiple>
		<input type="submit" name="btn_upload">
	</form>
	<br><br>

	<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<img src="<?php echo e(asset('/uploads').$product->productName); ?>" width="100">
	<!-- <img src="<?php echo e($product['productName']); ?>"> -->

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<!-- <img src="<?php echo e(asset('/uploads/f9seR.jpg')); ?>"> -->

</div>

</div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.boutique', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>