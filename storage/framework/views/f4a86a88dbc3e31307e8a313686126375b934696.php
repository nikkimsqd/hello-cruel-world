<?php $__env->startSection('titletext'); ?>
Hinimo | Login
<?php $__env->stopSection(); ?>

<?php $__env->startSection('auth'); ?>
<div class="classynav">
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
                        <div class="card-page-heading mb-30">Login</div>

                    <form method="POST" action="<?php echo e(route('login')); ?>" aria-label="<?php echo e(__('Login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right"><?php echo e(__('Username')); ?></label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control<?php echo e($errors->has('username') ? ' is-invalid' : ''); ?>" name="username" value="<?php echo e(old('username')); ?>" required autofocus>

                                <?php if($errors->has('username')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
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
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> <?php echo e(__('Remember Me')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Login')); ?>

                                </button>

                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo e(__('Forgot Your Password?')); ?>

                                </a>
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



<!-- <?php $__env->startSection('content'); ?> -->
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo e(route('login')); ?>" aria-label="<?php echo e(__('Login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-md-right"><?php echo e(__('Username')); ?></label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control<?php echo e($errors->has('username') ? ' is-invalid' : ''); ?>" name="username" value="<?php echo e(old('username')); ?>" required autofocus>

                                <?php if($errors->has('username')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
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
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> <?php echo e(__('Remember Me')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Login')); ?>

                                </button>

                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo e(__('Forgot Your Password?')); ?>

                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- <?php $__env->stopSection(); ?> -->

<?php echo $__env->make('layouts.hinimo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>