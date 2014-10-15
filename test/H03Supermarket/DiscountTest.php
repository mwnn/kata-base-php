<?php

use Kata\H03Supermarket\Concrete\DiscountItem;
use Kata\H03Supermarket\Concrete\CartItem;
use Kata\H03Supermarket\Concrete\CartProduct;

class DiscountTest extends PHPUnit_Framework_TestCase
{
    public function testGetProductName()
    {
        $discount = new DiscountItem(DiscountItem::DISCOUNT_TYPE_PRICE_ABOVE_QUANTITY,'Apple', 5, 7); // 7 = 32 -25

        $this->assertEquals('Apple', $discount->getDiscountProductName());
    }

    /**
     * @dataProvider dataForAppleOfferTest
     */
    public function testApplePriceDiscount($expectedPrice, $quantity)
    {
        $discount = new DiscountItem(DiscountItem::DISCOUNT_TYPE_PRICE_ABOVE_QUANTITY, 'Apple', 5, 7); // 7 = 32 -25

        $this->assertEquals(DiscountItem::DISCOUNT_TYPE_PRICE_ABOVE_QUANTITY, $discount->getType());

        $apples = new CartItem(new CartProduct('Apple', 32, 'kg'), $quantity);
        
        $discountedPrice = $discount->getPrice($apples);

        $this->assertEquals($expectedPrice, $discountedPrice);
    }

    /**
     * @dataProvider dataForTestProduct3for2
     */
    public function testShipQuantityDiscount($productsInCart, $quantityNeedToPay, $discount)
    {
        $item = new CartItem(new CartProduct('Starship', 999.99, 'piece'), $productsInCart);
        $discountedQuantity = $discount->getQuantity($item);

        $this->assertEquals($quantityNeedToPay, $discountedQuantity);
    }

    public function dataForAppleOfferTest()
    {
        return array(
            array(32, 1),
            array(32, 2),
            array(32, 3),
            array(32, 4),
            array(32, 5),
            array(25, 6),
            array(25, 100),
//            array(32,  1),
//            array(64,  2),
//            array(96,  3),
//            array(128, 4),
//            array(160, 5),
//            array(25*6, 6),
//            array(25*100, 100),
        );
    }

    public function dataForTestProduct3for2()
    {
        $discount = new DiscountItem(DiscountItem::DISCOUNT_TYPE_QUANTITY_ABOVE_QUANTITY, 'Starship', 2, 1);
//        TODO: improve 3for2 -> NforM
//        $discount2 = new Discount(Discount::QUANTITY_ABOVE_QUANTITY, 'Starship', 3, 2);

        return array(
            array(1, 1, $discount),
            array(2, 2, $discount),
            array(3, 2, $discount),
            array(4, 3, $discount),
            array(6, 4, $discount),
            array(7, 5, $discount),
            array(8, 6, $discount),
            array(9, 6, $discount),

//            array(1, 1, $discount2),
//            array(2, 2, $discount2),
//            array(3, 3, $discount2),
//            array(4, 3, $discount2),
//            array(5, 3, $discount2),
//            array(6, 4, $discount2),
//            array(7, 5, $discount2),
//            array(8, 6, $discount2),
//            array(9, 6, $discount2),
//            array(10, 6, $discount2),
//            array(11, 7, $discount2),
        );
    }
}

