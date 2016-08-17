<?php
/**
 * Bootstrap.
 */

if (!session_id()) {
    @session_start();
}

if (!defined('APP_ROOT')) {
    define('APP_ROOT', getcwd());
}

require_once APP_ROOT . '/app/core/Globals.php';
require_once APP_ROOT . '/app/core/Core.php';

