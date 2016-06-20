<?php
session_start();

require_once dirname(__FILE__) . '/app/config/Config.php';
require_once dirname(__FILE__) . '/app/core/Globals.php';

require_once dirname(__FILE__) . '/app/core/IDatabase.php';
require_once dirname(__FILE__) . '/app/core/Database.php';
require_once dirname(__FILE__) . '/app/core/Core.php';

require_once dirname(__FILE__) . '/app/core/IController.php';
require_once dirname(__FILE__) . '/app/core/Controller.php';

global $baseDir;
$baseDir = dirname(__FILE__);

Core::init(); // init function
