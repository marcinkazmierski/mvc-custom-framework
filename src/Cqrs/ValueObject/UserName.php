<?php
declare(strict_types = 1);

namespace Cqrs\ValueObject;

use Cqrs\Exception\InvalidValueObjectException;

class UserName
{
    /** @var string */
    private $userName;

    /**
     * UserName constructor.
     * @param string $userName
     * @throws InvalidValueObjectException
     */
    public function __construct(string $userName)
    {
        if (strlen($userName) < 3 || strlen($userName) > 16) {
            throw new InvalidValueObjectException(sprintf('"%s" is not a valid user name', $userName));
        }
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return $this->userName;
    }
}