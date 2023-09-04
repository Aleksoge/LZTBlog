<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Новости</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
        <link rel="manifest" href="/assets/favicon/site.webmanifest">
        <link rel="mask-icon" href="/assets/favicon/safari-pinned-tab.svg" color="#7d7d7d">
        <link rel="shortcut icon" href="/assets/favicon/favicon.ico">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-config" content="/assets/favicon/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
    </head>
<body>
<header>
    <nav class="navbar">
        <div class="container">
            <div class="navbar__wrap">
            <a href="/" class="logo" id="logo"><img src="/assets/img/logo.svg" height="24" alt="">Новости</a>
            <div class="hamb">
                <div class="hamb__field" id="hamb">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
                </div>
            </div>
            <ul class="menu" id="menu">
                <li><a href="/">Главная</a></li>
                <li><a href="https://zelenka.guru/threads/1076587/" target="_blank">Форум</a></li>
                <?php if(isset($_SESSION['user'])): ?>  
                <li class="dropdown"><a href="#" title="<?= $_SESSION['user']['email'] ?>"><?= $_SESSION['user']['username'] ?></a>
                    <ul class="sub-menu">
                        <?php if($authorizedUser->role == "admin") { ?>
                        <li><a href="/admin">Панель</a></li>
                        <?php } ?>
                        <li><a href="/logout">Выход</a></li>
                    </ul>
                </li>
                <?php else: ?>
                    <li><a href="/login">Войти</a></li>
                <li><a href="/register">Регистрация</a></li>
                <?php endif; ?>
            </ul>
            </div>
        </div>
    </nav>
    <div class="popup" id="popup"></div>  
</header>

    
