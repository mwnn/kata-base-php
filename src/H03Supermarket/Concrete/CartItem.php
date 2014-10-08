<?php

namespace Kata\H03Supermarket\Concrete;

use Kata\H03Supermarket\Item;

class CartItem
implements Item
{
    /**
     * @var CartProduct
     */
    private $product;
    private $quantity;

    /**
     * @param CartProduct $product
     * @param $quantity
    */
    public function __construct(CartProduct $product, $quantity)
    {
        $this->product  = $product;
        $this->setQuantity($quantity);
    }

    public function getPrice()
    {
        return $this->quantity * $this->product->getPrice();
    }

    public function getName()
    {
        return $this->product->getName();
    }

    public function getUnit()
    {
        return $this->product->getUnit();
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}