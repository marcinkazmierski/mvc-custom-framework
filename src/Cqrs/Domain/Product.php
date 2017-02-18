<?php
declare(strict_types = 1);

namespace Cqrs\Domain;

use Cqrs\ValueObject\Price;
use Cqrs\ValueObject\ProductName;

class Product
{
    /** @var int */
    private $id;

    /** @var ProductName */
    private $name;

    /** @var Price */
    private $price;

    public function __construct(ProductName $name, Price $price)
    {
        $this->id = rand(); // TODO: ID generator
        $this->price = $price;
        $this->name = $name;
    }
}