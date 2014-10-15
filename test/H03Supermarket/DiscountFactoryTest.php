<?php

use Kata\H03Supermarket\DiscountFactory;
use Kata\H03Supermarket\Concrete\DiscountItem;

class DiscountFactoryTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new DiscountFactory();
    }

    /**
     * @dataProvider dataForPriceDiscounts
     */
    public function testCreatePriceDiscount($productName, $minCriteria, $benefit)
    {
        $discount = new DiscountItem(DiscountItem::DISCOUNT_TYPE_PRICE_ABOVE_QUANTITY, $productName, $minCriteria, $benefit);
        $this->assertEquals($discount, $this->factory->createPriceDiscountAboveQuantity($productName, $minCriteria, $benefit));
    }

    /**
     * @dataProvider dataForQuantityDiscounts
     */
    public function testCreateQuantityDiscount($productName, $minCriteria, $benefit)
    {
        $discount = new DiscountItem(DiscountItem::DISCOUNT_TYPE_QUANTITY_ABOVE_QUANTITY, $productName, $minCriteria, $benefit);
        $this->assertEquals($discount, $this->factory->createQuantityDiscountAboveQuantity($productName, $minCriteria, $benefit));
    }

    public function dataForPriceDiscounts()
    {
        return array(
            array('Apple', 5, 7),
        );
    }

    public function dataForQuantityDiscounts()
    {
        return array(
            array('Starship', 2, 1),
        );
    }
}
