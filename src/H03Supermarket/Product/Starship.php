<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.29.
 * Time: 21:39
 */
namespace Kata\H03Supermarket\Product;

class Starship
extends Product
{
    public function getName()
    {
        return 'Starship';
    }

    public function getUnit()
    {
        return 'piece';
    }
}