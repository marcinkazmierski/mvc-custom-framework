<?php
namespace app\core;

class Cache extends Orm
{
    private $tableName = "caches";

    function __construct()
    {
        parent::__construct($this->tableName);
    }

    protected function isDevEnvironment()
    {
        if ($this->environment !== 'prod') {
            return true;
        }
        return false;
    }

    public function getCache($cache_key)
    {
        if ($this->isDevEnvironment()) {
            return false; // dev environment
        }
        
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE cache_key=:cache_key;';
        $params = array(':cache_key' => $cache_key);
        $results = $this->execute($sql, $params);
        $cache = false;
        if (!empty($results) && is_array($results)) {
            $cache = array_pop($results);
        }

        if ($cache && isset($cache->value)) {
            $now = strtotime('now');
            if ($cache->expire > 0) {
                if ($now > $cache->expire) {
                    $this->dropByKey($cache_key);
                    return false;
                }
            }
            return unserialize($cache->value);
        }
        return false;
    }

    public function setCache($cache_key, $value, $expire = 0)
    {
        if ($this->isDevEnvironment()) {
            return false; // dev environment
        }

        $now = strtotime('now');
        if ($expire > 0) {
            $expire = $now + $expire;
        } else {
            $expire = 0;
        }
        $this->dropByKey($cache_key);

        $sql = 'INSERT INTO ' . $this->tableName . ' (cache_key, `value`, expire) VALUES (:cache_key, :cache_value, :expire);';
        $params = array(
            ':cache_key' => $cache_key,
            ':cache_value' => serialize($value),
            ':expire' => $expire,
        );
        return $this->execute($sql, $params);
    }

    public function dropAllCache()
    {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE 1;';
        return $this->execute($sql);
    }

    public function dropByKey($cache_key)
    {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE cache_key = :cache_key;';
        $params = array(':cache_key' => $cache_key);
        return $this->execute($sql, $params);
    }
}


