<?php

namespace Kata\H03Supermarket\Concrete;

use Kata\H03Supermarket\Item;

class DiscountList
{
    /**
     * @var DiscountItem[]
     */
    private $discounts = array();

    public function addDiscount(DiscountItem $discount)
    {
        $productName = $discount->getDiscountProductName();

        if (false === isset($this->discounts[$productName])) {
            $this->discounts[$productName] = array();
        }

        $this->discounts[$productName][] = $discount;
    }

    /**
     * @return DiscountItem[]
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }

    public function createDiscountedItem(Item $item)
    {
        $discountItem = $item;
        $productName  = $item->getName();
        $discounts    = $this->getDiscounts();

        if (true === array_key_exists($productName, $discounts))
        {
            foreach ($discounts[$productName] as $discount)
            {
                $price    = $discount->getPrice($discountItem);
                $quantity = $discount->getQuantity($discountItem);

                $discountItem->setPrice($price);
                $discountItem->setQuantity($quantity);
            }
        }

        return $discountItem;
    }
}
