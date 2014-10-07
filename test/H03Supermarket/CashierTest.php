<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.30.
 * Time: 1:18
 */
use Kata\H03Supermarket\Cashier;
use Kata\H03Supermarket\Basket;
use Kata\H03Supermarket\Product\ProductFactory;
use Kata\H03Supermarket\Product\Apple;
use Kata\H03Supermarket\Product\Light;
use Kata\H03Supermarket\Product\Starship;
use Kata\H03Supermarket\Offer;
use Kata\H03Supermarket\DiscountFactory;

class CashierTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Cashier
     */
    private $cashier;

    public function setUp()
    {
        $this->cashier = new Cashier(new DiscountFactory());
    }

    public function testGetProductsCalledOnBasket()
    {
        $basketMock = $this->getMock('Kata\H03Supermarket\Basket', array('getProducts', 'getQuantity'));

        $productsArray = array(
            new Apple(11, 3),
            new Light(19, 1),
            new Starship(13, 2),
        );

        $basketMock->expects($this->once())
            ->method('getProducts')
            ->willReturn($productsArray)
        ;

        $this->cashier->processNextBasket($basketMock);
    }

    /**
     * @dataProvider dataForTotalCounts
     */
    public function testGetTotalOfSameProducts($expectedPrice, $product)
    {
        $basket = new Basket();
        $basket->addProduct($product);

        $this->cashier->processNextBasket($basket);
        $total = $this->cashier->getTotalPrice();

        $this->assertEquals($expectedPrice, $total);
    }




    public function dataForTotalCounts()
    {
        return array(
            array(33, new Apple(11, 3)),
            array(32, new Apple(32, 1)),
            array(18, new Light(9, 2)),
            array(19, new Light(19, 1)),
            array(26, new Starship(13, 2)),
            array(2999.97, new Starship(999.99, 3)),
        );
    }

//    public function dataForTotalCountsWithOffer()
//    {
//        return array(
//            array(33, new Apple(11, 5)),
//            array(32, new Apple(32, 1)),
//            array(18, new Light(9, 2)),
//            array(19, new Light(19, 1)),
//            array(26, new Starship(13, 2)),
//            array(2999.97, new Starship(999.99, 3)),
//        );
//    }
}