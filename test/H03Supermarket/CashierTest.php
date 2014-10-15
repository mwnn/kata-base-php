<?php

use Kata\H03Supermarket\Cashier;
use Kata\H03Supermarket\Concrete\CartItem;
use Kata\H03Supermarket\ProductFactory;
use Kata\H03Supermarket\DiscountFactory;
use Kata\H03Supermarket\Concrete\DiscountList;
use Kata\H03Supermarket\Cart;

class CashierTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Cart
     */
    private $cart;

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
        $discountFactory = new DiscountFactory();

        $discountList = new DiscountList();
        $discountList->addDiscount($discountFactory->createPriceDiscountAboveQuantity('Apple', 5, 7));
        $discountList->addDiscount($discountFactory->createQuantityDiscountAboveQuantity('Starship', 2, 1));

        $this->cart    = new Cart();
        $this->cashier = new Cashier($discountList);
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

        $this->assertEquals(number_format($expectedPrice,2), $this->cashier->getTotalPrice());
    }

    /**
     * @dataProvider dataForCreate
     */
    public function testPriceDiscount($productName, $quantity, $expectedPrice)
    {
        $item    = new CartItem($this->factory->getProduct($productName), $quantity);
        $this->cart->addCartItem($item);

        $this->cashier->processNextCart($this->cart);

        $this->assertEquals(number_format($expectedPrice,2), $this->cashier->getTotalPrice());
    }

    public function dataForCreate()
    {
        return array(
            array('Apple'   , 3,  3*32),
            array('Apple'   , 6,  6*25),
            array('Light'   , 1,  1*15),
            array('Light'   , 10, 10*15),
            array('Starship', 1,  1*999.99),
            array('Starship', 3,  2*999.99),
            array('Starship', 7,  5*999.99),
        );
    }
}