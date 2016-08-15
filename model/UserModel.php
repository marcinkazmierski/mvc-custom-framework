<?php
namespace model;

use app\core\Database;
use app\core\Orm;

class UserModel extends Orm
{
    private $tableName = "users";

    function __construct()
    {
        parent::__construct($this->tableName);
    }

    function authUser($login, $password)
    {
        $login = htmlspecialchars($login);
        $password = md5($password);
        $result = Database::getInstance()->prepare('SELECT * FROM ' . $this->tableName . ' WHERE login=:login AND password="' . $password . '";');
        $result->execute(array(':login' => $login));
        return $result->fetchColumn(0); // return ID
    }

    public function getUserByLogin($login)
    {
        $login = htmlspecialchars($login);
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE login=:login;';
        $params = array(
            ':login' => $login,
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


