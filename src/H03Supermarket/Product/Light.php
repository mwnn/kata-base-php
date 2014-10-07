<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.29.
 * Time: 21:38
 */
namespace Kata\H03Supermarket\Product;

class Light
extends Product
{
    public function getName()
    {
        return 'Light';
    }

    public function getUnit()
    {
        return 'year';
    }
}