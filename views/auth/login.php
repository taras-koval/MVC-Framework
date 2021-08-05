<h1>Login</h1>
<h2> <?= $method ?> </h2>

<form action="" method="post" autocomplete="off">
    
    <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
    </div>
    
    <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password">
    </div>
    
    <input type="submit" class="btn btn-primary" value="Login">
</form>