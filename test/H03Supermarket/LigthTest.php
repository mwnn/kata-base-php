<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.29.
 * Time: 23:08
 */
use Kata\H03Supermarket\Product\Light;

class LightTest extends PHPUnit_Framework_TestCase
{
    public function testCreateLight()
    {
        $product = new Light(15, 1);
        $this->assertEquals('Light', $product->getName());
        $this->assertEquals('15',    $product->getPrice());
        $this->assertEquals('year',  $product->getUnit());
    }
}
