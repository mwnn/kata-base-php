<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.10.02.
 * Time: 19:26
 */

namespace Kata\H03Supermarket\Discounts;

use Kata\H03Supermarket\Discount;
use Kata\H03Supermarket\Product\ProductInterface;

class NoDiscount implements Discount
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