<?php

use Kata\H03Supermarket\Concrete\CartProduct;

class ProductTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataForTestCreateProduct
     */
    public function testCreateProduct($name, $price, $unit, CartProduct $product)
    {
        $this->assertEquals($name,  $product->getName());
        $this->assertEquals($price, $product->getPrice());
        $this->assertEquals($unit,  $product->getUnit());
    }

    public function dataForTestCreateProduct()
    {
        return array(
            array('Apple',    '10',   't',     new CartProduct('Apple', 10, 't')),
            array('Light',    '15',   'year',  new CartProduct('Light', 15, 'year')),
            array('Light',    '30',   'year',  new CartProduct('Light', 30, 'year')),
            array('Starship', 999.99, 'piece', new CartProduct('Starship', 999.99, 'piece')),
            array('Starship', 102.99, 'piece', new CartProduct('Starship', 102.99, 'piece')),
        );
    }
}