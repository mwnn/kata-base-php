<?php

use Kata\H03Supermarket\Concrete\DiscountItem;
use Kata\H03Supermarket\Concrete\DiscountList;
use Kata\H03Supermarket\DiscountFactory;
use Kata\H03Supermarket\Concrete\CartItem;

use Kata\H03Supermarket\ProductFactory;

class DiscountListTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var DiscountList;
     */
    private $list;

    /**
     * @var DiscountFactory
     */
    private $discountFactory;

    /**
     * @var ProductFactory
     */
    private $productFactory;

    /**
     * @var DiscountItem
     */
    private $discount;

    public function setUp() 
    {
        $this->list = new DiscountList();
        $this->discountFactory = new DiscountFactory();
        $this->productFactory  = new ProductFactory();
        $this->discount        = $this->discountFactory->createQuantityDiscountAboveQuantity('Apple', 5, 7);
    }

    public function testListEmpty()
    {
        $discounts = $this->list->getDiscounts();
        $this->assertTrue(is_array($discounts));
        $this->assertEmpty($discounts);
    }

    /**
     * @depends testListEmpty
     */
    public function testAddAndGet()
    {
        $this->list->addDiscount($this->discount);

        $expected = array(
            'Apple' => array($this->discount),
        );

        $this->assertEquals($expected, $this->list->getDiscounts());
    }

    public function testGetDiscountedItemPrice()
    {
        $productName = 'Apple';
        
        $item = new CartItem($this->productFactory->getProduct($productName), 10);
        $itemDefaultPrice = $item->getPrice();

        $priceDiscount = $this->discountFactory->createPriceDiscountAboveQuantity($productName, 5, 7);
        $this->list->addDiscount($priceDiscount);

        /**
         * @var CartItem
         */
        $discountedItem = $this->list->createDiscountedItem($item);

        $this->assertNotEquals($itemDefaultPrice, $discountedItem->getPrice());
    }
}

