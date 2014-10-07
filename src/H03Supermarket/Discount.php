<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.10.02.
 * Time: 19:11
 */

namespace Kata\H03Supermarket;

use Kata\H03Supermarket\Product\ProductInterface;

interface Discount
{
    public function getDiscountQuantity(ProductInterface $product);
    public function getDiscountPrice(ProductInterface $product);
}