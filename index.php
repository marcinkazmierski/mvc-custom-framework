<?php
declare(strict_types=1);

use Framework\Core\Core;
use Framework\Core\DependencyInjection\Container;

define('APP_ROOT', getcwd());
require_once APP_ROOT . '/framework/bootstrap.php';

$container = new Container();
$core = new Core($container);
$core->init(); // init function
