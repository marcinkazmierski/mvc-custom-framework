<?php

namespace Tests\Service\Auth;

use PHPUnit\Framework\TestCase;
use Service\Auth\Auth;

class AuthTest extends TestCase
{
    /** @var  $auth Auth */
    protected $auth;

    public function setUp()
    {
        $this->auth = new Auth();
        $this->auth->destroyAuth();
    }

    public function testSetAuth()
    {
        $login = 'login';
        $this->auth->setAuth($login);
        $this->assertEquals(true, $this->auth->isAuth());
    }

    public function testSetEmptyAuth()
    {
        $this->assertEquals(false, $this->auth->isAuth());
    }

    public function tearDown()
    {
        $this->auth->destroyAuth();
    }
}