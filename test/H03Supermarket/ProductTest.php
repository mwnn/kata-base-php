<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.29.
 * Time: 23:16
 */

use Kata\H03Supermarket\Product;
use Kata\H03Supermarket\Product\Apple;
use Kata\H03Supermarket\Product\Light;
use Kata\H03Supermarket\Product\Starship;

class ProductTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param $name
     * @param $price
     * @param $unit
     * @param $product
     *
     * @dataProvider dataForTestCreateProduct
     */
    public function testCreateProduct($name, $price, $unit, $product)
    {
        $this->assertEquals($name,  $product->getName());
        $this->assertEquals($price, $product->getPrice());
        $this->assertEquals($unit,  $product->getUnit());
    }

    public function dataForTestCreateProduct()
    {
        return array(
            array('Apple',    '32',   'kg',    new Apple(32, 1)),
            array('Light',    '15',   'year',  new Light(15, 1)),
            array('Starship', 999.99, 'piece', new Starship(999.99, 1)),
        );
    }

    /**
     *
     */
    public function testAddQuantity()
    {
        $apple = new Apple(12, 2);

        $this->assertEquals(2, $apple->getQuantity());

        $apple->addQuantity(5);

        $this->assertEquals(7, $apple->getQuantity());

    }

}