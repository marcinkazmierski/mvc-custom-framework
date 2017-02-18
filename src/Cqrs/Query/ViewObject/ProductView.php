<?php
declare(strict_types = 1);

namespace Cqrs\Query\ViewObject;


use Cqrs\ValueObject\Price;
use Cqrs\ValueObject\ProductName;

class ProductView
{
    /** @var int */
    private $id;

    /** @var ProductName */
    private $name;

    /** @var Price */
    private $price;

    /**
     * ProductView constructor.
     * @param int $id
     * @param ProductName $name
     * @param Price $price
     */
    public function __construct(int $id, ProductName $name, Price $price)
    {
        $this->id = $id;
        $this->price = $price;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return ProductName
     */
    public function getName(): ProductName
    {
        return $this->name;
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }
}