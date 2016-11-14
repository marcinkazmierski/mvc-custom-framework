<?php
namespace Tests\Exception;

use Exception\AccessDeniedException;
use PHPUnit\Framework\TestCase;

class AccessDeniedExceptionTest extends TestCase
{
    public function testAccessDenied()
    {
        $this->expectException(AccessDeniedException::class);
        throw new AccessDeniedException();
    }
}