<?php

use Kata\H03Supermarket\Cashier;
use Kata\H03Supermarket\Concrete\CartItem;
use Kata\H03Supermarket\Product\ProductFactory;

class CashierTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Cashier
     */
    private $cashier;

    /**
     * @var ProductFactory
     */
    private $factory;

    public function setUp()
    {
        $this->cashier = new Cashier();
        $this->factory = new ProductFactory();
    }

    public function testGetItemsCalledOnCartBeforeGetTotalPrice()
    {
        $cartMock = $this->getMock('Kata\H03Supermarket\Cart', array('getItems'));

        $apple = $this->factory->getProduct('Apple');
        $light = $this->factory->getProduct('Light');
        $ship  = $this->factory->getProduct('Starship');

        $cartItemsArray = array(
            new CartItem($apple, 3),
            new CartItem($light, 2),
            new CartItem($ship,  1),
        );

        $cartMock->expects($this->once())
            ->method('getItems')
            ->willReturn($cartItemsArray);

        $this->cashier->processNextCart($cartMock);

        $expectedPrice =
              3 * $apple->getPrice()
            + 2 * $light->getPrice()
            + 1 * $ship->getPrice();

        $this->assertEquals($expectedPrice, $this->cashier->getTotalPrice());
    }
}