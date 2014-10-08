<?php

namespace Kata\H03Supermarket\Concrete;

use Kata\H03Supermarket\Price;
use Kata\H03Supermarket\Product;

class CartProduct
implements Product, Price
{
    private $name  = 0;
    private $price = 0;
    private $unit  = 0;

    public function __construct($name, $price, $unit)
    {
        $this->name  = $name;
        $this->price = $price;
        $this->unit  = $unit;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
