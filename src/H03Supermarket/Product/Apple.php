<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.29.
 * Time: 21:38
 */
namespace Kata\H03Supermarket\Product;

class Apple
extends Product
{
    public function getName()
    {
        return 'Apple';
    }

    public function getUnit()
    {
        return 'kg';
    }
}
