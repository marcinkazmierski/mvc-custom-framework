<?php
namespace app\core;

interface ICache
{
    public function cacheSet($key, $value, $expire = 0);

    public function cacheGet($key);

    public function cacheClearAll();
}