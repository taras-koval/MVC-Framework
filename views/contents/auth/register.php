<?php

/**
 * @var UserRegister $model
 */

use App\Model\User\UserRegister;

?>

<div class="auth-form-wrapper">
    <form action="" method="post" class="auth-form block">
        <h1 class="form-heading text-center">Sign up for your account</h1>
        
        <?php if (session()->getSuccessFlash()): ?>
            <div class="form-item">
                <div class="alert-success"><?= session()->getSuccessFlash() ?></div>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getDangerFlash()): ?>
            <div class="form-item">
                <div class="alert-danger"><?= session()->getDangerFlash() ?></div>
            </div>
        <?php endif; ?>
    
        <div class="form-item">
            <label for="email" class="form-label hidden">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" autofocus
                   value="<?= $model->email ?>"
                   class="form-control <?= $model->hasError('email')? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= $model->getFirstError('email') ?></div>
        </div>
    
        <div class="form-item">
            <label for="username" class="form-label hidden">Username</label>
            <input type="text" name="username" id="username" placeholder="Username"
                   value="<?= $model->username ?>"
                   class="form-control <?= $model->hasError('username')? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= $model->getFirstError('username') ?></div>
        </div>
        
        <div class="form-item">
            <label for="password" class="form-label hidden">Password</label>
            <input type="password" name="password" id="password" placeholder="Password"
                   value="<?= $model->password ?>"
                   class="form-control <?= $model->hasError('password')? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= $model->getFirstError('password') ?></div>
        </div>
    
        <div class="form-item">
            <label for="confirmPassword" class="form-label hidden">Confirm Password</label>
            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password"
                   value="<?= $model->confirmPassword ?>"
                   class="form-control <?= $model->hasError('confirmPassword')? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= $model->getFirstError('confirmPassword') ?></div>
        </div>
    
        <div class="form-item">
            <div class="form-extra text-center">
                <span>By signing up, you agree to our <a href="">privacy policy</a>.</span>
            </div>
        </div>
        
        <div class="form-item">
            <input type="submit" class="btn" value="Create Account">
            
            <div class="auth-option text-center">
                <span>Have an account? <a href="/login">Log in</a></span>
            </div>
        </div>
    
    </form>
</div>
