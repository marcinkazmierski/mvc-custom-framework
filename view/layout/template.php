<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/view/style/bootstrap.min.css" rel="stylesheet"/>
    <link href="/view/style/bootstrap-theme.min.css" rel="stylesheet"/>
    <link href="/view/style/style.css" rel="stylesheet"/>
    <title>MVC</title>
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
                <section class="row">
                    <?php
                    echo $contentAll;
                    ?>
                </section>
            </section>
        </section>
    </section>
</section>
<script src="/view/js/jquery.min.js"></script>
<script src="/view/js/bootstrap.min.js"></script>
<script src="/view/js/main.js"></script>
</body>
</html>