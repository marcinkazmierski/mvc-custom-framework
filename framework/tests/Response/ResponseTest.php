<?php
namespace Tests\Response;

use PHPUnit\Framework\TestCase;
use Response\Response;

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