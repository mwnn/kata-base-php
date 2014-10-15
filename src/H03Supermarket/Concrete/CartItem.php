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
    private $oneItemPrice;
    private $quantity;

    /**
     * @param CartProduct $product
     * @param $quantity
    */
    public function __construct(CartProduct $product, $quantity)
    {
        $this->product  = $product;
        $this->setQuantity($quantity);
        $this->setPrice($product->getPrice());
    }

    public function setPrice($price)
    {
        $this->oneItemPrice = $price;
    }

    public function getPrice()
    {
        return $this->oneItemPrice * $this->quantity;
    }

    public function getProductPrice()
    {
        return $this->oneItemPrice;
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
