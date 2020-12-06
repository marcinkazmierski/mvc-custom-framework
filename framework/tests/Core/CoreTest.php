<?php

namespace Framework\Tests\Core;

use Framework\Core\Controller;
use Framework\Core\Core;
use Framework\Core\DependencyInjection\ContainerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CoreTest extends TestCase
{
    /**
     * @runInSeparateProcess
     * @throws \Exception
     */
    public function testInit()
    {
        $htmlContent = "Test site content";
        /** @var Controller | MockObject $controller */
        $controller = $this->getMockBuilder(Controller::class)->getMock();
        $controller->expects($this->once())
            ->method('__call')
            ->willReturn($htmlContent);

        /** @var ContainerInterface| MockObject $container */
        $container = $this->getMockBuilder(ContainerInterface::class)->getMock();
        $container->expects($this->once())
            ->method('get')
            ->willReturn($controller);

        $core = new Core('prod', $container);

        ob_start();
        $core->init();
        $return = ob_get_clean();

        $this->assertEquals($htmlContent, $return);
    }

    public function testDirNameFilter()
    {
        $dir = 'test';
        $this->assertEquals($dir, Core::dirNameFilter($dir));

        $dir = 'test/test';
        $this->assertEquals('testtest', Core::dirNameFilter($dir));
    }
}