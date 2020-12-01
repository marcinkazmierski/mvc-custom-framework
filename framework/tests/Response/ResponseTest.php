<?php

namespace Framework\Tests\Response;

use Framework\Response\Response;
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
        $response = new Response($body);
        print $response;
        $response = ob_get_clean();
        $this->assertEquals($body, $response);
    }
}