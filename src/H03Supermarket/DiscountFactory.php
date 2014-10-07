<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.10.02.
 * Time: 19:21
 */


namespace Kata\H03Supermarket;

use Kata\H03Supermarket\Discounts\NoDiscount;
use Kata\H03Supermarket\Discounts\Apple as AppleDiscount;
use Kata\H03Supermarket\Discounts\Starship as StarshipDiscount;

use Kata\H03Supermarket\Product\Product;
use Kata\H03Supermarket\Product\ProductFactory;
use Kata\H03Supermarket\Product\ProductInterface;

class DiscountFactory
{
    public function getDiscount(ProductInterface $product)
    {

        switch ($product->getName())
        {
            default:

            case ProductFactory::PRODUCT_LIGHT:
                $discount = new NoDiscount();
                break;

            case ProductFactory::PRODUCT_APPLE:
                $discount = new AppleDiscount();
                break;

            case ProductFactory::PRODUCT_STARSHIP:
                $discount = new StarshipDiscount();
                break;
        }

        return $discount;
    }
}
