<?php
declare(strict_types = 1);

namespace Cqrs\Domain;

use Cqrs\ValueObject\Email;
use Cqrs\ValueObject\UserName;

class User
{
    /** @var int */
    private $id;

    /** @var Email */
    private $email;

    /** @var UserName */
    private $username;

    public function __construct(Email $email, UserName $username)
    {
        $this->id = rand(); // TODO: ID generator
        $this->email = $email;
        $this->username = $username;
    }
}