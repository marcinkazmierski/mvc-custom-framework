<?php
namespace app\tests\core;

use app\core\Core;
use PHPUnit\Framework\TestCase;

class CoreTest extends TestCase
{
    public function testInit()
    {
        ob_start();
        Core::init();
        $return = ob_get_clean();
        $this->assertNotEmpty($return);
    }
}