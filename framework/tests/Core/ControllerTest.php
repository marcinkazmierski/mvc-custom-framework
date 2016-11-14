<?php
namespace Tests\Core;

use Core\Controller;
use Exception\NotFoundException;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{

    public function testPageNotFound()
    {
        $this->expectException(NotFoundException::class);

        /** @var $controller Controller */
        $controller = $this->getMockForAbstractClass('Core\Controller');
        $controller->notFoundTest();
    }
}