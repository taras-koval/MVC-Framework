<?php

/**
 * @var App\Model\User\UserRegister $model
 */

?>

<h1 class="my-4">Register</h1>

<form action="" method="post">
    
    <div class="form-group mb-3">
        <label for="username" class="form-label"><?= $model->getLabel('username') ?></label>
        <input type="text" name="username" id="username"
               value="<?= $model->username ?>"
               class="form-control <?= $model->hasError('username') ? 'is-invalid' : '' ?>">
        <div class="invalid-feedback"><?= $model->getFirstError('username') ?></div>
    </div>
    
    <div class="form-group mb-3">
        <label for="email" class="form-label"><?= $model->getLabel('email') ?></label>
        <input type="text" name="email" id="email"
               value="<?= $model->email ?>"
               class="form-control <?= $model->hasError('email') ? 'is-invalid' : '' ?>">
        <div class="invalid-feedback"><?= $model->getFirstError('email') ?></div>
    </div>
    
    <div class="form-group mb-3">
        <label for="password" class="form-label"><?= $model->getLabel('password') ?></label>
        <input type="password" name="password" id="password"
               value="<?= $model->password ?>"
               class="form-control <?= $model->hasError('password') ? 'is-invalid' : '' ?>">
        <div class="invalid-feedback"><?= $model->getFirstError('password') ?></div>
    </div>
    
    <div class="form-group mb-4">
        <label for="confirmPassword" class="form-label"><?= $model->getLabel('confirmPassword') ?></label>
        <input type="password" name="confirmPassword" id="confirmPassword"
               value="<?= $model->confirmPassword ?>"
               class="form-control <?= $model->hasError('confirmPassword') ? 'is-invalid' : '' ?>">
        <div class="invalid-feedback"><?= $model->getFirstError('confirmPassword') ?></div>
    </div>
    
    <div class="form-group mb-4">
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
    
</form>