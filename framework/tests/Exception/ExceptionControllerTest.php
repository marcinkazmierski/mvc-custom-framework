<?php

namespace Tests\Exception;

use Exception\ExceptionController;
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
        $controller->render(new \Exception("Error test"));
        $return = ob_get_clean();
        $this->assertNotEmpty($return);
    }
}