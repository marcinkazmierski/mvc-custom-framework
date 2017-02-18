<?php
declare(strict_types = 1);

namespace Cqrs\Query\ViewObject;

use Cqrs\Domain\Product;
use Cqrs\Domain\User;

class CartView
{
    /** @var int */
    private $id;

    /** @var User */
    private $user;

    /** @var Product[] */
    private $products = [];

    /**
     * CartView constructor.
     * @param int $id
     * @param User $user
     * @param array $products
     */
    public function __construct(int $id, User $user, array $products)
    {
        $this->id = $id;
        $this->user = $user;
        $this->products = $products;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return \Cqrs\Domain\Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}