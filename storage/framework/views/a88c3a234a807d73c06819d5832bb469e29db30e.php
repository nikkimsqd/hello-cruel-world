<?php $__env->startSection('titletext'); ?>
Hinimo | Register
<?php $__env->stopSection(); ?>

<?php $__env->startSection('auth'); ?>
<div class="classynav" style="padding-right: 50px;">
    <ul>
        <li><a href="register-boutique">Sell on Hinimo</a></li>  
        <li><a href="login">Login</a></li>  
        <li><a href="register">Signup</a></li>
    </ul>
    
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>
<div class="single-blog-wrapper">
    <!-- Single Blog Post Thumb -->
    <div class="single-blog-post-thumb">
    <img src="<?php echo e(asset('essence/img/bg-img/bg-8.jpg')); ?>" alt="" value="">
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="regular-page-content-wrapper section-padding-80">
                    <div class="regular-page-text">
                        <div class="cart-page-heading mb-30" style="text-align: center;"><h4>Register</h4></div>
                        <form method="POST" action="<?php echo e(route('register')); ?>" aria-label="<?php echo e(__('Register')); ?>">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group row">
                                <label for="fname" class="col-md-4 col-form-label text-md-right"><?php echo e(__('First Name')); ?></label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control<?php echo e($errors->has('fname') ? ' is-invalid' : ''); ?>" name="fname" value="<?php echo e(old('fname')); ?>" required autofocus>

                                    <?php if($errors->has('fname')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('fname')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lname" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Last Name')); ?></label>

                                <div class="col-md-6">
                                    <input id="lname" type="text" class="form-control<?php echo e($errors->has('lname') ? ' is-invalid' : ''); ?>" name="lname" value="<?php echo e(old('lname')); ?>" required autofocus>

                                    <?php if($errors->has('lname')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('lname')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Username')); ?></label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control<?php echo e($errors->has('username') ? ' is-invalid' : ''); ?>" name="username" value="<?php echo e(old('username')); ?>" required autofocus>

                                    <?php if($errors->has('username')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('username')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Gender')); ?></label>

                                <div class="col-md-6">
                                    <select id="gender" class="form-control<?php echo e($errors->has('gender') ? ' is-invalid' : ''); ?>" name="gender" required autofocus>
                                        <option selected disabled></option>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                    </select>

                                    <?php if($errors->has('gender')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('gender')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>

                                    <?php if($errors->has('email')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                                    <?php if($errors->has('password')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Confirm Password')); ?></label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(__('Register')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_menu'); ?>
<!-- Footer Menu -->
<div class="footer_menu">
    <ul>
        <li><a href="<?php echo e(url('/shop')); ?>">Shop</a></li>
        <li><a href="<?php echo e(url('/biddings')); ?>">Biddings</a></li>
        <li><a href="contact.html">Contact</a></li>
    </ul>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.hinimo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>