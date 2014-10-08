<?php

use Kata\H03Supermarket\Product\ProductFactory;
use Kata\H03Supermarket\Concrete\CartItem;

class ItemTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ProductFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ProductFactory();
    }

    public function testCreateItem()
    {
        $apple = $this->factory->getProduct('Apple');
        $light = $this->factory->getProduct('Light');
        $ship  = $this->factory->getProduct('Starship');

        $appleItem = new CartItem($apple, 3);
        $lightItem = new CartItem($light, 2);
        $shipItem  = new CartItem($ship, 13);

        $this->assertEquals('Apple', $appleItem->getName());
        $this->assertEquals('Light', $lightItem->getName());
        $this->assertEquals('Starship', $shipItem->getName());

        $this->assertEquals(3, $appleItem->getQuantity());
        $this->assertEquals(2, $lightItem->getQuantity());
        $this->assertEquals(13, $shipItem->getQuantity());
    }
}