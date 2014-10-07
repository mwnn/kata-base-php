<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.10.02.
 * Time: 19:15
 */

namespace Kata\H03Supermarket\Discounts;

use Kata\H03Supermarket\Discount;
use Kata\H03Supermarket\Product\ProductInterface;

class Apple
implements Discount
{

    public function getDiscountQuantity(ProductInterface $product)
    {
        return $product->getQuantity();
    }

    public function getDiscountPrice(ProductInterface $product)
    {
        return $product->getPrice();
    }
}