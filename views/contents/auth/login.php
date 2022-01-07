<div class="auth-form-wrapper">
    <form action="" method="post" class="auth-form block">
        <h1 class="form-heading text-center">Authorization</h1>
    
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
            <input type="text" name="email" id="email" placeholder="Email" autofocus
                   value="<?= old('email') ?>"
                   class="form-control <?= error('email') ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= error('email') ?></div>
        </div>
    
        <div class="form-item">
            <label for="password" class="form-label hidden">Password</label>
            <input type="password" name="password" id="password" placeholder="Password"
                   value="<?= old('password') ?>"
                   class="form-control <?= error('password') ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= error('password') ?></div>
        </div>
    
        <div class="form-item">
            <div class="form-extra">
                <a href="/login">Forgot password?</a>
            </div>
        </div>
    
        <div class="form-item">
            <input type="submit" class="btn" value="Log In">
    
            <div class="auth-option text-center">
                <span>No Account? Sign Up <a href="/signup">Here</a>.</span>
            </div>
        </div>
        
    </form>
</div>
