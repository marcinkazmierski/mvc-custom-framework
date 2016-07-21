<?php
namespace app\core;

class Cache
{
    private $database_name = "caches";

    public function getCache($cache_key)
    {
        $result = Database::getInstance()->prepare('SELECT * FROM ' . $this->database_name . ' WHERE cache_key=:cache_key;');
        $result->execute(array(':cache_key' => $cache_key));

        $cache = $result->fetchObject();
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
        $now = strtotime('now');
        if ($expire > 0) {
            $expire = $now + $expire;
        } else {
            $expire = 0;
        }
        $this->dropByKey($cache_key);
        $result = Database::getInstance()->prepare('INSERT INTO ' . $this->database_name . ' (cache_key, `value`, expire) VALUES (:cache_key, :cache_value, :expire);');
        $result->execute(
            array(
                ':cache_key' => $cache_key,
                ':cache_value' => serialize($value),
                ':expire' => $expire,
            )
        );
        return $result->rowCount();
    }

    public function dropAllCache()
    {
        return Database::getInstance()->query('DELETE FROM ' . $this->database_name . ' WHERE 1;');
    }

    protected function dropByKey($cache_key)
    {
        $result = Database::getInstance()->prepare('DELETE FROM ' . $this->database_name . ' WHERE cache_key = :cache_key;');
        $result->execute(
            array(
                ':cache_key' => $cache_key,
            )
        );
    }
}


