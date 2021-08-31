<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Taras Koval">
    
    <title>Test</title>
    
    <!--<link rel="stylesheet" href="../../public/css/fonts.css">-->
    <link rel="stylesheet" href="../../public/css/common.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700;800;900&display=swap" rel="stylesheet">

</head>
<body>

<header class="page-header">
    <div class="container">
        
        <nav class="left-page-nav">
            
            <a href="/" class="logo-link">Home</a>
            
            <div class="nav-group">
                <a href="/about">About</a>
                <a href="/contact">Contact</a>
            </div>
            
        </nav>
        
        <nav class="right-page-nav">
            <?php if (session()->isGuest()): ?>
            <div class="nav-group">
                <a href="/login/">Login</a>
                <a href="/register/">Register</a>
            </div>
            <?php else: ?>
            <div class="nav-group">
                <a href="/profile"><strong><?= session()->user->username ?></strong></a>
                <a href="/logout">Logout</a>
            </div>
            <?php endif; ?>
        </nav>
    
    </div>
</header>

<main class="page-main">
    <div class="container">
        {{content}}
    </div>
</main>

<!--<footer class="page-footer">
    <div class="container">
    
    </div>
</footer>-->

<script src="/public/js/main.js"></script>

</body>
</html>