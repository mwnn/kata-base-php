<?php

namespace Kata\H03Supermarket;

use Kata\H03Supermarket\Concrete\CartItem;

interface Discount
{
    public function getPrice(CartItem $item);
    public function getQuantity(CartItem $item);
}
