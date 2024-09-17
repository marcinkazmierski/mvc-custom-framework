<?php

namespace Framework\Tests\Exception;

use Framework\Exception\ExceptionController;
use PHPUnit\Framework\TestCase;

class ExceptionControllerTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testRender()
    {
        $controller = new ExceptionController();

        ob_start();
        $response = $controller->render(new \Exception("Error test"));
        print $response;
        $return = ob_get_clean();
        $this->assertNotEmpty($return);
    }
}