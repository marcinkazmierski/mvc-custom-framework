<?php
declare(strict_types = 1);

namespace Cqrs\Command\Command;


use Cqrs\ValueObject\Email;
use Cqrs\ValueObject\UserName;

class CreateUserCommand implements Command
{
    /** @var Email */
    private $email;

    /** @var UserName */
    private $username;

    /**
     * UserView constructor.
     * @param Email $email
     * @param UserName $username
     */
    public function __construct(Email $email, UserName $username)
    {
        $this->email = $email;
        $this->username = $username;
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