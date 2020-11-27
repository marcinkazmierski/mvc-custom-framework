<?php
declare(strict_types = 1);

namespace Framework\Database;


use Framework\Core\Config;

class Database implements IDatabase
{
    private static $dataBase = null;

    public static function getInstance()
    {
        if (self::$dataBase == null) {
            try {
                self::$dataBase = new \PDO(
                    "mysql:host=" . Config::getOption('db_host') . ";dbname=" . Config::getOption('db_name') . ";charset=utf8",
                    Config::getOption('db_user'), Config::getOption('db_password')
                );
                self::$dataBase->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                print "Database error: " . $e->getMessage() . "<br/>";
            }
        }
        return self::$dataBase;
    }
}