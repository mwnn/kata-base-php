<?php

use Kata\H03Supermarket\ProductFactory;

class ProductFactoryTest extends PHPUnit_Framework_TestCase
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
     * @dataProvider dataForFactoryTest
     */
    public function testFactory($productName)
    {
        /**
         * @var CartProduct
         */
        $product = $this->factory->getProduct($productName);

        $this->assertInstanceOf("Kata\\H03Supermarket\\Concrete\\CartProduct", $product);
        $this->assertEquals($productName, $product->getName());
    }

    public function dataForFactoryTest()
    {
        return array(
            array('Apple'),
            array('Light'),
            array('Starship'),
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowException()
    {
        $this->factory->getProduct('NonExistentProduct');
    }
}
