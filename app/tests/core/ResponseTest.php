<?php
namespace app\tests\core;

use app\core\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testResponseSimple()
    {
        $body = 'Test';
        ob_start();
        new Response($body);
        $response = ob_get_clean();
        $this->assertEquals($body, $response);
    }
}