<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.29.
 * Time: 23:12
 */

use Kata\H03Supermarket\Product\Starship;

class StarshipTest extends PHPUnit_Framework_TestCase
{
    public function testCreateStarship()
    {
        $product = new Starship(999.99, 1);
        $this->assertEquals('Starship', $product->getName());
        $this->assertEquals('999.99',   $product->getPrice());
        $this->assertEquals('piece',    $product->getUnit());
    }
}
