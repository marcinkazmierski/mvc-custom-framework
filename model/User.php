<?php
namespace model;

use app\core\Database;

class User
{
    private $database_name = "users";

    function __construct()
    {

    }

    function getUsers()
    {
        return Database::getInstance()->query('SELECT * FROM ' . $this->database_name);
    }

    function getUser($id)
    {
        return Database::getInstance()->query('SELECT * FROM ' . $this->database_name . ' WHERE id=' . (int)$id);
    }

    function authUser($login, $password)
    {
        $login = htmlspecialchars($login);
        $password = md5($password);
        $result = Database::getInstance()->prepare('SELECT * FROM ' . $this->database_name . ' WHERE login=:login AND password="' . $password . '";');
        $result->execute(array(':login' => $login));
        return $result->fetchColumn(0); // return ID
    }

    function addUser($login, $password)
    {
        $login = htmlspecialchars($login);
        $password = md5($password);
        $result = Database::getInstance()->prepare('INSERT INTO ' . $this->database_name . ' (login, password) VALUES (:login, "' . $password . '");');
        $result->execute(array(':login' => $login));
        return $result->rowCount();
    }
}


