<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.29.
 * Time: 21:52
 */
namespace Kata\H03Supermarket\Product;

abstract
class Product
implements ProductInterface
{
    protected $price    = 0;
    protected $quantity = 0;

    public function __construct($price, $quantity)
    {
        // todo: check inputs
        $this->price    = $price;
        $this->quantity = $quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function addQuantity($quantity)
    {
        $this->quantity += (int)$quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}
