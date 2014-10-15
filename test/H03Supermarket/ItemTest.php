<?php

use Kata\H03Supermarket\ProductFactory;
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

    /**
     * @dataProvider dataForCreate
     */
    public function testCreateItem($productName, $quantity)
    {
        $product = $this->factory->getProduct($productName);
        $item    = new CartItem($product, $quantity);

        $this->assertEquals($productName, $item->getName());
        $this->assertEquals($quantity, $item->getQuantity());
    }

    /**
     * @dataProvider dataForCreate
     */
    public function testSetPrice($productName, $quantity)
    {
        $product = $this->factory->getProduct($productName);

        $item = new CartItem($product, $quantity);
        $this->assertEquals($quantity * $product->getPrice(), $item->getPrice());

        $item->setPrice(7);
        $this->assertEquals(7 * $quantity, $item->getPrice());
    }

    /**
     * @dataProvider dataForCreate
     */
    public function testSetQuantity($productName, $quantity)
    {
        $product = $this->factory->getProduct($productName);

        $item = new CartItem($product, $quantity);
        $this->assertEquals($quantity, $item->getQuantity());

        $item->setQuantity(12+$quantity);
        $this->assertEquals(12+$quantity, $item->getQuantity());
    }

    /**
     * @dataProvider dataForCreate
     */
    public function testGetUnit($productName, $quantity, $unit)
    {
        $product = $this->factory->getProduct($productName);

        $item = new CartItem($product, $quantity);

        $this->assertEquals($unit, $item->getUnit());
    }

    public function dataForCreate()
    {
        return array(
            array('Apple', 3, 'kg'),
            array('Light', 2, 'year'),
            array('Starship', 12, 'piece'),
        );
    }
}
