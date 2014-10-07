<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.29.
 * Time: 21:43
 */
namespace Kata\H03Supermarket\Product;

interface ProductInterface
{
    public function getName();
    public function getPrice();
    public function getUnit();
    public function getQuantity();
}