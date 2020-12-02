<?php
declare(strict_types=1);

namespace App\Model;


use Framework\Database\Orm\Orm;
use Framework\Exception\RuntimeException;
use Framework\Security\PasswordManager;

class UserModel extends Orm
{
    private $tableName = "users";

    /** @var PasswordManager */
    private $passwordManager;

    function __construct(PasswordManager $passwordManager)
    {
        parent::__construct($this->tableName);
        $this->passwordManager = $passwordManager;
    }

    /**
     * @param $login
     * @param $password
     * @return mixed|null
     * @throws RuntimeException
     */
    public function getUserByLoginPassword($login, $password)
    {
        $login = htmlspecialchars($login);
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE login=:login;';
        $params = array(
            ':login' => $login,
        );
        $results = $this->execute($sql, $params);
        if (!empty($results) && is_array($results)) {
            $user = array_pop($results);
            if ($this->passwordManager->isPasswordValid($password, $user->password)) {
                return $user;
            }
        }
        return null;
    }

    /**
     * @param $login
     * @param $password
     * @return int
     * @throws RuntimeException
     */
    function addUser($login, $password)
    {
        $login = htmlspecialchars($login);
        $params = array(
            ':login' => $login,
            ':password' => $this->passwordManager->generatePasswordHash($password),
        );
        $sql = 'INSERT INTO ' . $this->tableName . ' (login, password) VALUES (:login, :password);';
        $this->execute($sql, $params);
        return $this->lastInsertId();
    }

    function findByLogin($text)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE login LIKE :text LIMIT 30;';
        $params = array(
            ':text' => '%' . $text . '%',
        );
        $results = $this->execute($sql, $params);
        return $results;
    }
}


