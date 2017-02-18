<?php
declare(strict_types = 1);

namespace Cqrs\Query\ViewObject;

use Cqrs\ValueObject\Email;
use Cqrs\ValueObject\UserName;

class UserView
{
    /** @var int */
    private $id;

    /** @var Email */
    private $email;

    /** @var UserName */
    private $username;

    /**
     * UserView constructor.
     * @param int $id
     * @param Email $email
     * @param UserName $username
     */
    public function __construct(int $id, Email $email, UserName $username)
    {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return UserName
     */
    public function getUsername(): UserName
    {
        return $this->username;
    }
}