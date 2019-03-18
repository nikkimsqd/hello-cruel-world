<?php $__env->startSection('titletext'); ?>
  Boutique de Filipina
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
  Products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">

<div class="col-md-12">
<div class="col-md-9">
    <!-- Total Products -->
    <div class="total-products">
        <p><span>186</span> products found</p>
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
	   <a class="btn btn-block btn-info" href="/hinimo/public/addproduct/">Add Products here</a>
    </div>
</div>
</div>


</div>



<!-- ------------------------NEW OPTION------------------------------ -->



<div class="row">
  <div class="col-md-12">
    <div class="box box-success" style="padding: 10px;">
      <div class="box-body">

      <?php if(empty($products)): ?>
        <label>You have no products in your store</label>
      <?php else: ?>
      <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class=" col-md-4" style="padding-right: 20px; padding-left: 20px;">
          <div class="box " style="padding: 10px;">
            <div class="box-body">
              <?php $counter = 1; ?>

              <?php $__currentLoopData = $product->productFile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <?php if($counter == 1): ?>  
                <img src="<?php echo e(asset('/uploads').$image['filename']); ?>" style="width:100%; height: 350px; object-fit: cover;">
              <?php else: ?>
              <?php endif; ?>
              <?php $counter++; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <div class="row">
                <a href="viewproduct/<?php echo e($product['productID']); ?>">
                  <h4><?php echo e($product['productName']); ?></h4>
                </a>
                <h2></h2>

                <a href="viewproduct/<?php echo e($product['productID']); ?>" class="btn btn-block btn-primary">View Product</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
      </div>
    </div>
  </div>
</div>




<?php $__env->stopSection(); ?>


<?php $__env->startSection('inbox'); ?>
<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-envelope-o"></i>
    <span class="label label-success">4</span>
  </a>
  <ul class="dropdown-menu">
    <li class="header">You have 4 messages</li>
    <li>
      <!-- inner menu: contains the actual data -->
      <ul class="menu">
        <li><!-- start message -->
          <a href="#">
            <div class="pull-left">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <h4>
              Support Team
              <small><i class="fa fa-clock-o"></i> 5 mins</small>
            </h4>
            <p>Why not buy a new awesome theme?</p>
          </a>
        </li>
        <!-- end message -->
      </ul>
    </li>
    <li class="footer"><a href="#">See All Messages</a></li>
  </ul>
</li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('notifications'); ?>
<!-- Notifications: style can be found in dropdown.less -->
<li class="dropdown notifications-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell-o"></i>
    <span class="label label-warning">10</span>
  </a>
  <ul class="dropdown-menu">
    <li class="header">You have 10 notifications</li>
    <li>
      <!-- inner menu: contains the actual data -->
      <ul class="menu">

        <li>
          <a href="#">
            <i class="fa fa-users text-aqua"></i> 5 new members joined today
          </a>
        </li>

      </ul>
    </li>
    <li class="footer"><a href="#">View all</a></li>
  </ul>
</li>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('tasks'); ?>
<li class="dropdown tasks-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-flag-o"></i>
    <span class="label label-danger">9</span>
  </a>
  <ul class="dropdown-menu">
    <li class="header">You have 9 tasks</li>
    <li>
      <!-- inner menu: contains the actual data -->
      <ul class="menu">

        <li><!-- Task item -->
          <a href="#">
            <h3>
              Design some buttons
              <small class="pull-right">20%</small>
            </h3>
            <div class="progress xs">
              <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                   aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                <span class="sr-only">20% Complete</span>
              </div>
            </div>
          </a>
        </li>
        <!-- end task item -->

      </ul>
    </li>
    <li class="footer">
      <a href="#">View all tasks</a>
    </li>
  </ul>
</li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('useraccount'); ?>
<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="<?php echo e(asset('adminlte/dist/img/user2-160x160.jpg')); ?>" class="user-image" alt="User Image">
    <span class="hidden-xs"><?php echo e($boutique['boutiqueName']); ?></span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      <img src="<?php echo e(asset('adminlte/dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">

      <p>
        <?php echo e($boutique['boutiqueName']); ?>

        <!-- <small>Member since <?php echo e($boutique['created_at']); ?></small> -->
        <small>by <?php echo e($user['fname']." ".$user['lname']); ?></small>
      </p>
    </li>
    <!-- Menu Body -->
    <li class="user-body">
      <div class="row">
        <div class="col-xs-4 text-center">
          <a href="#">Followers</a>
        </div>
        <div class="col-xs-4 text-center">
          <a href="#">Sales</a>
        </div>
        <div class="col-xs-4 text-center">
          <a href="#">Friends</a>
        </div>
      </div>
      <!-- /.row -->
    </li>
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a href="#" class="btn btn-default btn-flat">Profile</a>
      </div>
      <div class="pull-right">
        <a href="#" class="btn btn-default btn-flat">Sign out</a>
      </div>
    </li>
  </ul>
</li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('sidebar'); ?>
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo e(asset('adminlte/dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p><?php echo e($boutique['boutiqueName']); ?></p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>

   <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
   
    <li>
      <a href="/hinimo/public/dashboard">
        <i class="fa fa-th"></i> <span>Dashboard</span>
        <span class="pull-right-container">
          <!-- <small class="label pull-right bg-green">new</small> -->
        </span>
      </a>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Products</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/hinimo/public/products/"><i class="fa fa-circle-o"></i> View Products</a></li>
        <li><a href="/hinimo/public/categories"><i class="fa fa-circle-o"></i> Categories</a></li>
        <li><a href="/hinimo/public/weddinggowns"><i class="fa fa-circle-o"></i> Wedding gowns</a></li>
        <li><a href="/hinimo/public/dashboard"><i class="fa fa-circle-o"></i> Entourage Set</a></li>
        <li><a href="/hinimo/public/dashboard"><i class="fa fa-circle-o"></i> Accessories</a></li>
      </ul>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Transactions</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Made-to-Orders</a></li>
        <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Rent</a></li>
      </ul>
    </li>

  </ul>
</section>
<!-- /.sidebar -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.boutique', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>