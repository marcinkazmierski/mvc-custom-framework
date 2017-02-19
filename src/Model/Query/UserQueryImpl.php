<?php
declare(strict_types = 1);

namespace Model\Query;

use Cqrs\Query\Query\UserQuery;
use Cqrs\Query\ViewObject\UserView;
use Cqrs\ValueObject\Email;
use Cqrs\ValueObject\UserName;
use Database\Orm\Orm;

class UserQueryImpl extends Orm implements UserQuery
{
    private $tableName = "users";

    function __construct()
    {
        parent::__construct($this->tableName);
    }

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


