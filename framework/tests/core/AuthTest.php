<?php
namespace app\tests\core;

use app\core\Auth;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    /** @var  $auth Auth */
    protected $auth;

    public function setUp()
    {
        $this->auth = Auth::getInstance();
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