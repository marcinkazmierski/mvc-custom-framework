<?php
session_start();

require_once dirname(__FILE__) . '/app/core/Globals.php';
require_once dirname(__FILE__) . '/app/core/Core.php';

global $baseDir;
$baseDir = dirname(__FILE__);

\app\core\Core::init(); // init function
