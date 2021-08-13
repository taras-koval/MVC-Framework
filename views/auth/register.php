<h1>Register</h1>

<?php /*dump($model)*/ ?>

<form action="" method="post">
    <div class="form-group">
        <label for="username" class="form-label"><?= $model->labels()['username'] ?></label>
        <input
            type="text"
            name="username"
            value="<?= $model->username ?>"
            class="form-control <?= $model->hasError("username") ? 'is-invalid' : '' ?>"
            id="username">
        
        <div class="invalid-feedback"><?= $model->getFirstError("username") ?></div>
    </div>
    
    <div class="form-group">
        <label for="email" class="form-label"><?= $model->labels()['email'] ?></label>
        <input
            type="text"
            name="email"
            value="<?= $model->email ?>"
            class="form-control <?= $model->hasError("email") ? 'is-invalid' : '' ?>"
            id="email"
            aria-describedby="emailHelp">
        
        <div class="invalid-feedback"><?= $model->getFirstError("email") ?></div>
    </div>
    
    <div class="form-group">
        <label for="password" class="form-label"><?= $model->labels()['password'] ?></label>
        <input
            type="password"
            name="password"
            value="<?= $model->password ?>"
            class="form-control <?= $model->hasError("password") ? 'is-invalid' : '' ?>"
            id="password">
    
        <div class="invalid-feedback"><?= $model->getFirstError("password") ?></div>
    </div>
    
    <div class="form-group">
        <label for="confirmPassword" class="form-label"><?= $model->labels()['confirmPassword'] ?></label>
        <input
            type="password"
            name="confirmPassword"
            value="<?= $model->confirmPassword ?>"
            class="form-control <?= $model->hasError("confirmPassword") ? 'is-invalid' : '' ?>"
            id="confirmPassword">
    
        <div class="invalid-feedback"><?= $model->getFirstError("confirmPassword") ?></div>
    </div>
    
    <br>
    <button type="submit" class="btn btn-primary">Register</button>
</form>