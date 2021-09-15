<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    
    <title>Test</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../../public/css/common.css">
    <link rel="stylesheet" href="../../public/css/main.css">
</head>
<body>

<header class="page-header">
    <div class="container">
    
        <a href="/" class="site-logo">Example<span>Logo</span></a>
        
        <nav class="page-nav">
            <a href="/contact" class="nav-item">Contact</a>
            
            <?php if (session()->isGuest()): ?>
            <a href="/login" class="nav-item">Login</a>
            <a href="/signup" class="nav-item btn">Sign up</a>
            <?php else: ?>
            <a href="/account" class="nav-item">
                <strong><?= session()->user->username ?></strong>
            </a>
            <a href="/logout" class="nav-item">Logout</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<main class="page-main">
    <div class="container">
        
        {{content}}
        
    </div>
</main>

<script src="/public/js/main.js"></script>

</body>
</html>