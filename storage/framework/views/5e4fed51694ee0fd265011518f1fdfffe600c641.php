<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo e(asset('img/img/Group 3454.svg.png')); ?>" type="image/x-icon">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"
        />
        <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
        <title></title>
    </head>

    <body>
        <div class="container">
            <div class="left">
                <img src="<?php echo e(asset('img/Group 3454.svg.png')); ?>">
                <div class="form">
                    <div class="brand"><img src="<?php echo e(asset('img/Group 3454.svg.png')); ?>"></div>
                    <label>Please enter your login details to continue</label>
                    <form method="POST" action="<?php echo e(route('login.custom')); ?>">
                        <?php echo csrf_field(); ?>


                        <input id="email" type="email" class="inputs" name="email" required autocomplete="email" autofocus placeholder="Email"> 
                        <?php if($errors->has('email')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span> 
                        <?php endif; ?>


                        <input id="password" type="password" class="inputs" name="password" required autocomplete="current-password" placeholder="Password">
                        <?php if($errors->has('password')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('password')); ?></strong>
                            </span> 
                        <?php endif; ?> 

                        <div class="btnContainer">
                            <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Login')); ?>

                                </button>
                        </div>
                        <div id="rst">
                            <?php if(Route::has('password.request')): ?>
                            <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo e(__('Forgot Your Password?')); ?>

                                </a> <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </body>

</html><?php /**PATH C:\Users\MOSES\projects\parkingBay\resources\views/auth/login.blade.php ENDPATH**/ ?>