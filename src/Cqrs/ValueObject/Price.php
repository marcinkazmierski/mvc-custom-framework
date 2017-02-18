<?php
declare(strict_types = 1);

namespace Cqrs\ValueObject;

use Cqrs\Exception\InvalidValueObjectException;

class Price
{
    /** @var int */
    private $price;

    /**
     * Price constructor.
     * @param int $price
     * @throws InvalidValueObjectException
     */
    public function __construct(int $price)
    {
        if ($price < 0) {
            throw new InvalidValueObjectException(sprintf('"%s" is not a valid price', $price));
        }
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return (string)$this->price;
    }
}