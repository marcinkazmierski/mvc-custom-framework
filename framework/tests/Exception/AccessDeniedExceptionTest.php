<?php
namespace Framework\Tests\Exception;

use Framework\Exception\AccessDeniedException;
use PHPUnit\Framework\TestCase;

class AccessDeniedExceptionTest extends TestCase
{
    /**
     * @test
     * @throws AccessDeniedException
     */
    public function testAccessDenied()
    {
        $this->expectException(AccessDeniedException::class);
        throw new AccessDeniedException();
    }
}