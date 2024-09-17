<?php

namespace Framework\Tests\Service\Auth;

use Framework\Service\Auth\Auth;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase {

    /** @var  $auth Auth */
    protected $auth;

    public function setUp(): void {
        $this->auth = new Auth();
        $this->auth->destroyAuth();
    }

    public function testSetAuth() {
        $login = 'login';
        $this->auth->setAuth($login);
        $this->assertEquals(TRUE, $this->auth->isAuth());
    }

    public function testSetEmptyAuth() {
        $this->assertEquals(FALSE, $this->auth->isAuth());
    }

    public function tearDown(): void {
        $this->auth->destroyAuth();
    }

}