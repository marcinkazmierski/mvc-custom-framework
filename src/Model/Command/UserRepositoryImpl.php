<?php
declare(strict_types = 1);

namespace Model\Command;

use Cqrs\Command\Repository\UserRepository;
use Cqrs\Domain\User;
use Database\Orm\Orm;

class UserRepositoryImpl extends Orm implements UserRepository
{
    private $tableName = "users";

    function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function add(User $user)
    {
        $params = array(
            ':login' => (string)$user->getUsername(),
            ':password' => md5((string)$user->getUsername()),
            ':name' => (string)$user->getUsername(),
            ':mail' => (string)$user->getEmail(),
        );
        $sql = 'INSERT INTO ' . $this->tableName . ' (`login`, `password`, `name`, `mail`) VALUES (:login, :password, :name, :mail);';
        $this->execute($sql, $params);
    }
}