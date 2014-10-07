<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.29.
 * Time: 22:53
 */

use Kata\H03Supermarket\Product\Apple;

class AppleTest extends PHPUnit_Framework_TestCase
{
    public function testCreateApple()
    {
        $product = new Apple(32, 1);
        $this->assertEquals('Apple', $product->getName());
        $this->assertEquals('32',    $product->getPrice());
        $this->assertEquals('kg',    $product->getUnit());
    }
}