<?php
namespace model;

use app\core\Database;

class Cache
{
    private $database_name = "caches";

    function getCache($cache_key)
    {
        $result = Database::getInstance()->prepare('SELECT * FROM ' . $this->database_name . ' WHERE cache_key=:cache_key;');
        $result->execute(array(':cache_key' => $cache_key));
        return $result->fetchObject();
    }

    function setCache($cache_key, $value, $expire = 0)
    {
        $result = Database::getInstance()->prepare('INSERT INTO ' . $this->database_name . ' (cache_key, `value`, expire) VALUES (:cache_key, :cache_value, :expire);');
        $result->execute(
            array(
                ':cache_key' => $cache_key,
                ':cache_value' => $value,
                ':expire' => $expire,
            )
        );
        return $result->rowCount();
    }

    function dropAllCache()
    {
        return Database::getInstance()->query('DELETE FROM ' . $this->database_name . ' WHERE 1;');
    }
}


