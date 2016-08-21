<?php
namespace app\tests\core;

use app\core\Controller;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    public function testPageNotFound()
    {
        /** @var $controller Controller */
        $controller = $this->getMockForAbstractClass('app\core\Controller');
        ob_start();
        $controller->notFoundTest();
        $content = ob_get_clean();
        $this->assertEquals("Page not found", $content);
    }
}