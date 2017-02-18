<?php
declare(strict_types = 1);

namespace Cqrs\Domain;

class Cart
{
    /** @var int */
    private $id;

    /** @var User */
    private $user;

    /** @var Product[] */
    private $products = [];

    /**
     * Cart constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->id = rand(); // TODO: ID generator
        $this->user = $user;
    }

    /**
     * Add product to Cart.
     * @param Product $product
     */
    public function addProduct(Product $product):void
    {
        $this->products[] = $product;
    }
}