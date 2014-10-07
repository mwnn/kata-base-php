<?php

use Kata\H03Supermarket\Product\ProductFactory;
use Kata\H03Supermarket\Product\Apple;
use Kata\H03Supermarket\Product\Light;
use Kata\H03Supermarket\Product\Starship;

class ProductFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataForFactoryTest
     */
    public function testFactory($productClass)
    {
        $factory = new ProductFactory();

        $product = $factory->getProduct($productClass, 1, 1);

        $this->assertInstanceOf("Kata\\H03Supermarket\\Product\\$productClass", $product);
    }

    public function dataForFactoryTest()
    {
        return array(
            array('Apple'),
            array('Light'),
            array('Starship'),
        );
    }

}