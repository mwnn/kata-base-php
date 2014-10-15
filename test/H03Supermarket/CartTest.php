<?php

use Kata\H03Supermarket\ProductFactory;
use Kata\H03Supermarket\Concrete\CartItem;
use Kata\H03Supermarket\Cart;

class CartTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var ProductFactory
     */
    private $productFactory;

    public function setUp()
    {
        $this->productFactory = new ProductFactory();
        $this->cart = new Cart();
    }

    /**
     * @return Cart
     */
    public function testEmpty()
    {
        $cart = $this->cart;
        $this->assertEquals(array(), $cart->getItems());
        return $cart;
    }

    /**
     * @param $cart
     *
     * @depends testEmpty
     */
    public function testAddProduct(Cart $cart)
    {
        $cart->addCartItem(new CartItem($this->productFactory->getProduct('Apple'), 3));

        $appleItems = $cart->getItems();
        $this->assertInstanceOf('Kata\H03Supermarket\Concrete\CartItem', $appleItems[0]);

        return $appleItems;
    }

    /**
     * @param CartItem[] $appleItems
     *
     * @depends testAddProduct
     */
    public function testGetItemNormalPrice($appleItems)
    {
        $apple = $this->productFactory->getProduct('Apple');
        $oneApplePrice = $apple->getPrice();

        $totalPrice = $oneApplePrice * $appleItems[0]->getQuantity();

        $this->assertEquals($totalPrice, $appleItems[0]->getPrice());
    }
}
