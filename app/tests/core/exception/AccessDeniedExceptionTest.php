<?php
namespace app\tests\core;

use app\core\exception\AccessDeniedException;
use PHPUnit\Framework\TestCase;

class AccessDeniedExceptionTest extends TestCase
{
    public function testAccessDenied()
    {
        $this->expectException(AccessDeniedException::class);
        throw new AccessDeniedException();
    }
}