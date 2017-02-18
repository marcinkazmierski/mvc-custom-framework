<?php
declare(strict_types = 1);

namespace Cqrs\ValueObject;

use Cqrs\Exception\InvalidValueObjectException;

class ProductName
{
    /** @var string */
    private $productName;

    /**
     * ProductName constructor.
     * @param string $productName
     * @throws InvalidValueObjectException
     */
    public function __construct(string $productName)
    {
        if (strlen($productName) == 0 || strlen($productName) > 32) {
            throw new InvalidValueObjectException(sprintf('"%s" is not a valid product name', $productName));
        }
        $this->productName = $productName;
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return $this->productName;
    }
}