<?php
declare(strict_types=1);

use Framework\Core\Config;
use Framework\Core\Core;
use Framework\Core\DependencyInjection\Container;

define('APP_ROOT', getcwd());
require_once APP_ROOT . '/framework/bootstrap.php';

$environment = (string)Config::getOption('environment');
if (empty($environment)) {
    $environment = 'prod';
}
$container = new Container();
$core = new Core($environment, $container);
$core->init(); // init function
