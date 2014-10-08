<?php

namespace Kata\H03Supermarket;

use Kata\H03Supermarket\Concrete\CartItem;

class Cart
{
    /**
     * @var CartItem[]
     */
    private $items = array();

    public function addCartItem(CartItem $item)
    {
        $this->items[] = $item;
    }

    /**
     * @return CartItem[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
