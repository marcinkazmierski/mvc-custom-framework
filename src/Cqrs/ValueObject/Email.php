<?php
declare(strict_types = 1);

namespace Cqrs\ValueObject;

use Cqrs\Exception\InvalidValueObjectException;

class Email
{
    /** @var string */
    private $email;

    /**
     * Email constructor.
     * @param string $email
     * @throws InvalidValueObjectException
     */
    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidValueObjectException(sprintf('"%s" is not a valid email', $email));
        }
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return $this->email;
    }
}