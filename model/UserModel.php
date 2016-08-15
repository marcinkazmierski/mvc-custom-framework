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

    function getUsers()
    {
        $sth =  Database::getInstance()->query('SELECT * FROM ' . $this->tableName);
        $sth->execute();
        $results = $sth->fetchAll();
        $sth->closeCursor();
        return $results;
    }

    function getUser($id)
    {
        return Database::getInstance()->query('SELECT * FROM ' . $this->tableName . ' WHERE id=' . (int)$id);
    }

    function authUser($login, $password)
    {
        $login = htmlspecialchars($login);
        $password = md5($password);
        $result = Database::getInstance()->prepare('SELECT * FROM ' . $this->tableName . ' WHERE login=:login AND password="' . $password . '";');
        $result->execute(array(':login' => $login));
        return $result->fetchColumn(0); // return ID
    }

    function addUser($login, $password)
    {
        $login = htmlspecialchars($login);
        $password = md5($password);
        $result = Database::getInstance()->prepare('INSERT INTO ' . $this->tableName . ' (login, password) VALUES (:login, "' . $password . '");');
        $result->execute(array(':login' => $login));
        return $result->rowCount();
    }
}


