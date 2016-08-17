<?php
namespace model;

use app\core\Orm;

class UserModel extends Orm
{
    private $tableName = "users";

    function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function getUserByLoginPassword($login, $password)
    {
        $login = htmlspecialchars($login);
        $password = md5($password);
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE login=:login AND password=:password;';
        $params = array(
            ':login' => $login,
            ':password' => $password
        );
        $results = $this->execute($sql, $params);
        if (!empty($results) && is_array($results)) {
            return array_pop($results);
        }
        return null;
    }

    function addUser($login, $password)
    {
        $login = htmlspecialchars($login);
        $password = md5($password);
        $params = array(
            ':login' => $login,
            ':password' => $password,
        );
        $sql = 'INSERT INTO ' . $this->tableName . ' (login, password) VALUES (:login, :password);';
        $this->execute($sql, $params);
        return $this->lastInsertId();
    }
}


