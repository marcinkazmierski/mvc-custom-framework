<?php
declare(strict_types = 1);

namespace Model;

use Cqrs\Query\Query\UserQuery;
use Cqrs\Query\ViewObject\UserView;
use Cqrs\ValueObject\Email;
use Cqrs\ValueObject\UserName;
use Database\Orm\Orm;

class UserModel extends Orm implements UserQuery
{
    private $tableName = "users";

    function __construct()
    {
        parent::__construct($this->tableName);
    }

    /*
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

        function findLikeLogin($text)
        {
            $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE login LIKE :text LIMIT 30;';
            $params = array(
                ':text' => '%' . $text . '%',
            );
            $results = $this->execute($sql, $params);
            return $results;
        }
        */

    public function getUserById(int $userId) : UserView
    {
        // TODO: Implement getUserById() method.
    }

    public function getAllUsers() : array
    {
        $data = $this->getAll();
        return array_map(function (\stdClass $userData) {
            return new UserView((int)$userData->id, new Email($userData->mail), new UserName($userData->name));
        }, $data);
    }
}


