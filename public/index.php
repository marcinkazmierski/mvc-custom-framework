<?php
declare(strict_types=1);

define('APP_ROOT', getcwd() . '/..');
require_once APP_ROOT . '/framework/bootstrap.php';

\Core\Core::init(); // init function