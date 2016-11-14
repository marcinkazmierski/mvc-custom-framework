<?php
/**
 * Bootstrap engine.
 */

if (!session_id()) {
    @session_start();
}

if (!defined('APP_ROOT')) {
    define('APP_ROOT', getcwd());
}

if (!defined('FRAMEWORK_SRC_PATH')) {
    define('FRAMEWORK_SRC_PATH', APP_ROOT . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR);
}

if (!defined('FRAMEWORK_CONFIG_PATH')) {
    define('FRAMEWORK_CONFIG_PATH', APP_ROOT . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR);
}

if (!defined('APP_SRC_PATH')) {
    define('APP_SRC_PATH', APP_ROOT . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR);
}

require_once FRAMEWORK_SRC_PATH . 'Core/Globals.php';
require_once FRAMEWORK_SRC_PATH . 'Core/Core.php';

