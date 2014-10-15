<?php

namespace Kata\H03Supermarket;

use Kata\H03Supermarket\Concrete\DiscountItem;

class DiscountFactory
{
    public function createPriceDiscountAboveQuantity($productName, $minQuantity, $discountPrice)
    {
        return new DiscountItem(DiscountItem::DISCOUNT_TYPE_PRICE_ABOVE_QUANTITY, $productName, $minQuantity, $discountPrice);
    }

    public function createQuantityDiscountAboveQuantity($productName, $minQuantity, $discountQuantity)
    {
        return new DiscountItem(DiscountItem::DISCOUNT_TYPE_QUANTITY_ABOVE_QUANTITY, $productName, $minQuantity, $discountQuantity);
    }
}
