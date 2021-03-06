<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/public/assets/style/bootstrap.min.css" rel="stylesheet"/>
    <link href="/public/assets/style/bootstrap-theme.min.css" rel="stylesheet"/>
    <link href="/public/assets/style/style.css" rel="stylesheet"/>
    <title><?php print t('MVC custom'); ?></title>
</head>
<body>
<section class="container">
    <section class="row">
        <section class="col-md-12">
            <nav>
                <section class="navigation">
                    <section class="row">
                        <div class="col-md-12">
                            <div class="navbar navbar-default">
                                <div class="container">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                                data-target=".navbar-collapse">
                                            <span class="sr-only">Navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        <a class="navbar-brand" href="/index.php/index/index">MVC</a>
                                    </div>
                                    <div class="navbar-collapse collapse">
                                        <ul class="nav navbar-nav">
                                            <li class=""><a href="/index.php/index/index">Index</a></li>
                                            <li><a href="/index.php/index/user/1">User 1</a></li>
                                            <li><a href="/index.php/index/insert">New user</a></li>
                                            <li><a href="/index.php/index/login">Login</a></li>
                                            <li><a href="/index.php/index/logout">Logout</a></li>
                                            <li><a href="/index.php/index/json">json</a></li>
                                            <li><a href="/index.php/index/404">Error 404</a></li>
                                        </ul>
                                    </div>
                                    <!--/.nav-collapse -->
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </nav>
            <section class="container">
                <div class="row">
                    <section>
                        <?php print get_all_flash_messages(); ?>
                    </section>
                </div>
                <section class="row">
                    <?php
                    echo $contentAll;
                    ?>
                </section>
            </section>
        </section>
    </section>
</section>
<script src="/src/View/assets/js/jquery.min.js"></script>
<script src="/src/View/assets/js/bootstrap.min.js"></script>
<script src="/src/View/assets/js/main.js"></script>
</body>
</html>