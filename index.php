<?php
if (!session_id()) {
    @session_start();
}
define('APP_ROOT', getcwd());
require_once APP_ROOT . '/app/core/Globals.php';
require_once APP_ROOT . '/app/core/Core.php';

\app\core\Core::init(); // init function
