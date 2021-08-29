<?php

/**
 * @var App\Model\User\UserLogin $model
 */

?>

<h1 class="my-4">Login</h1>

<form action="" method="post">
    
    <div class="form-group mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username"
               value="<?= $model->username ?>"
               class="form-control <?= $model->hasError('username') ? 'is-invalid' : '' ?>">
        <div class="invalid-feedback"><?= $model->getFirstError('username') ?></div>
    </div>
    
    <div class="form-group mb-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password"
               value="<?= $model->password ?>"
               class="form-control <?= $model->hasError('password') ? 'is-invalid' : '' ?>">
        <div class="invalid-feedback"><?= $model->getFirstError('password') ?></div>
    </div>
    
    <div class="form-group mb-4">
        <input type="submit" class="btn btn-primary" value="Login">
    </div>
    
</form>