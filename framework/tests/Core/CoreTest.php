<?php
namespace Tests\Core;

use Core\Core;
use PHPUnit\Framework\TestCase;

class CoreTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testInit()
    {
        ob_start();
        Core::init();
        $return = ob_get_clean();
        $this->assertNotEmpty($return);
    }

    public function testDirNameFilter()
    {
        $dir = 'test';
        $this->assertEquals($dir, Core::dirNameFilter($dir));

        $dir = 'test/test';
        $this->assertEquals('testtest', Core::dirNameFilter($dir));
    }
}