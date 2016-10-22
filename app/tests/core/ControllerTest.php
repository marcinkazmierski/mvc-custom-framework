<?php
namespace app\tests\core;

use app\core\Controller;
use app\core\exception\NotFoundException;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{

    public function testPageNotFound()
    {
        $this->expectException(NotFoundException::class);

        /** @var $controller Controller */
        $controller = $this->getMockForAbstractClass('app\core\Controller');
        $controller->notFoundTest();
    }
}