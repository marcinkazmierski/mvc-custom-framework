<?php
namespace Framework\Tests\Service\Cache;

use Framework\Service\Cache\Cache;
use PHPUnit\Framework\TestCase;

class CacheTest extends TestCase
{
    /** @var $cache Cache */
    protected $cache;

    public function setUp()
    {
        $this->cache = new Cache();
        $this->cache->dropAllCache();
    }

    public function testGetCacheEmpty()
    {
        $cache = $this->cache->getCache('CacheTest');
        $this->assertEmpty($cache);
    }

    public function testGetCacheGet()
    {
        $this->cache->setCache('CacheTest', 123);
        $cache = $this->cache->getCache('CacheTest');
        $this->assertEquals(123, $cache);
    }

    public function testGetCacheGetExpire()
    {
        $this->cache->setCache('CacheTest', 'text', 60);
        $cache = $this->cache->getCache('CacheTest');
        $this->assertEquals('text', $cache);
    }


    public function testGetCacheGetExpired()
    {
        $this->cache->setCache('CacheTest', 'text', 1);
        sleep(2);
        $cache = $this->cache->getCache('CacheTest');
        $this->assertEmpty($cache);
    }

    public function tearDown()
    {
        $this->cache->dropAllCache();
    }
}