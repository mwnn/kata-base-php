<?php

namespace Kata\H03Supermarket\Concrete;

use Kata\H03Supermarket\Discount;

class DiscountItem
implements Discount
{
    const SUBJECT_TYPE_PRICE    = 1;
    const SUBJECT_TYPE_QUANTITY = 2;

    const DISCOUNT_TYPE_PRICE_ABOVE_QUANTITY    = 1;
    const DISCOUNT_TYPE_QUANTITY_ABOVE_QUANTITY = 2;
//    const DISCOUNT_TYPE_PRICE_ABOVE_PRICE       = 3;

    private $type;
    private $productName;
    private $minPriceOrQuantity;
    private $benefit;

    public function __construct($type, $productName, $minPriceOrQuantity, $benefit)
    {
        $this->type = $type;
        $this->productName = $productName;
        $this->minPriceOrQuantity = $minPriceOrQuantity;
        $this->benefit = $benefit;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getDiscountProductName()
    {
        return $this->productName;
    }

    public function getPrice(CartItem $item)
    {
        return $this->calculateDiscount(self::SUBJECT_TYPE_PRICE, $item);
    }

    public function getQuantity(CartItem $item)
    {
        return $this->calculateDiscount(self::SUBJECT_TYPE_QUANTITY, $item);
    }

    private function calculateDiscount($subject, CartItem $item)
    {
        $quantity = $item->getQuantity();
        $price    = $item->getProductPrice();

        switch ($this->getType())
        {
            case self::DISCOUNT_TYPE_PRICE_ABOVE_QUANTITY:
                $price = $this->getPriceDiscountAboveQuantity($item);
                break;

            case self::DISCOUNT_TYPE_QUANTITY_ABOVE_QUANTITY:
                $quantity = $this->getQuantityDiscountAboveQuantity($item);
                break;

//            TODO: add other sdiscounts, eg.: for the whole cart's price
//            case self::DISCOUNT_TYPE_PRICE_ABOVE_PRICE:
//                $price = $this->getPriceDiscountAbovePrice($item);
//                break;
        }

        $retVal = (self::SUBJECT_TYPE_PRICE === $subject) ? $price : $quantity;

        return $retVal;
    }

    private function getPriceDiscountAboveQuantity(CartItem $item)
    {
        $price    = $item->getProductPrice();
        $quantity = $item->getQuantity();

        if ($this->minPriceOrQuantity < $quantity)
        {
            $price = $price - $this->benefit;
        }

        return $price;
    }

    private function getQuantityDiscountAboveQuantity(CartItem $item)
    {
        $quantity = $item->getQuantity();
        $discountQuantity = $this->benefit * (int)($quantity / ($this->minPriceOrQuantity + $this->benefit));

        $quantityToPay = ($this->minPriceOrQuantity < $quantity)
            ? $quantity - $discountQuantity
            : $quantity;

        return $quantityToPay;
    }
}