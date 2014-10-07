<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.29.
 * Time: 23:32
 */

use Kata\H03Supermarket\Product\Product;
use Kata\H03Supermarket\Product\Apple;
use Kata\H03Supermarket\Product\Light;
use Kata\H03Supermarket\Product\Starship;
use Kata\H03Supermarket\Basket;
use Kata\H03Supermarket\Product\ProductFactory;

class BasketTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Basket
     */
    private $basket;

    /**
     * @var ProductFactory
     */
    private $productFactoy;

    public function setUp()
    {
        $this->productFactoy = new ProductFactory();
        $this->basket = new Basket();
    }

    public function testEmpty()
    {
        $basket = new Basket();
        $this->assertEquals(array(), $basket->getProducts());
        return $basket;
    }

    /**
     * @depends testEmpty
     */
    public function testAddProduct($basket)
    {
        $product = new Apple(32,1);
        $basket->addProduct($product);

        $storedProducts = $basket->getProducts();
        $this->assertInstanceOf('Kata\H03Supermarket\Product\Product', array_shift($storedProducts));
    }

    public function testAggregateProduct()
    {
        $oneApple = $this->productFactoy->getProduct(ProductFactory::PRODUCT_APPLE, 1);
        $twoApple = $this->productFactoy->getProduct(ProductFactory::PRODUCT_APPLE, 2);

        $this->basket->addProduct($oneApple);
        $this->basket->addProduct($twoApple);

        $aggregated = $this->basket->getAggregatedProduct(ProductFactory::PRODUCT_APPLE);

        $this->assertEquals(3, $aggregated->getQuantity());
    }
}