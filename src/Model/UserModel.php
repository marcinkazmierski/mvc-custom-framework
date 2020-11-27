<?php
declare(strict_types=1);

namespace App\Model;


use Framework\Database\Orm\Orm;

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
        $password = hash('sha256', $password); // TODO: password hash provider
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

        var_dump(hash('sha256', $password));

        var_dump(password_hash($password, PASSWORD_BCRYPT));
die('test');
        $password = hash('sha256', $password); // TODO: password hash provider

        $params = array(
            ':login' => $login,
            ':password' => $password,
        );
        $sql = 'INSERT INTO ' . $this->tableName . ' (login, password) VALUES (:login, :password);';
        $this->execute($sql, $params);
        return $this->lastInsertId();
    }

    function findLikeLogin($text)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE login LIKE :text LIMIT 30;';
        $params = array(
            ':text' => '%' . $text . '%',
        );
        $results = $this->execute($sql, $params);
        return $results;
    }
}


