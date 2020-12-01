<?php
namespace Framework\Tests\Core;

use Framework\Core\Controller;
use Framework\Exception\NotFoundException;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{

    /**
     * @test
     * @throws \ReflectionException
     */
    public function testPageNotFound()
    {
        $this->expectException(NotFoundException::class);

        /** @var $controller Controller */
        $controller = $this->getMockForAbstractClass('Framework\Core\Controller');
        $controller->notFoundTest();
    }
}