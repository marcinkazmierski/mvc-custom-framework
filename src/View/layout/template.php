<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link href="/public/assets/style/style.css" rel="stylesheet"/>
    <title><?php print t('MVC custom'); ?></title>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">MVC Framework 2.0</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarCollapse" aria-controls="navbarCollapse"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php/index/index">
                        Index
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php/index/user/1">
                        User 1
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php/index/insert">
                        New user
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php/index/login">
                        Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php/index/logout">
                        Logout
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php/index/json">
                        json
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php/index/404">
                        Error 404
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main role="main" style="margin-top: 80px;">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <?php print get_all_flash_messages(); ?>
            </div>
            <section class="col-md-12">
                <?php
                echo $contentAll;
                ?>
            </section>
        </div>
    </section>
</main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="/public/assets/js/main.js"></script>
</body>
</html>