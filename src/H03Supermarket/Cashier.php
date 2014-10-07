<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.29.
 * Time: 19:49

    We are supermarket sellers and we don't have a smart cashier to use, so we have to create one. (smile)
    We have 3 products to sell with the prices shown below:

    Product  | Price  | Unit
    --------------------------
    Apple    |  32    | kg
    Light    |  15    | year
    Starship | 999.99 | piece

    Our precious clients can buy any amount of any product.
    They have an infinite shopping basket.
    When the client finishes shopping, he/she puts his/her basket to the cashier,
    which calculates the total price of the products in the basket.

    Bonus feature:

    Implement an offer engine:

    if you buy more then 5 kg apple, the price is 25
    if you buy 2 starship, you get 1 for free (pay 2 get 3)

    Instructions:

    Do not use hidden dependencies.
    Create at least one test with Mock.

 */

namespace Kata\H03Supermarket;

use Kata\H03Supermarket\Basket;
use Kata\H03Supermarket\Product\ProductInterface;

class Cashier
{
    private $totalPrice = 0;

    /**
     * @var ProductInterface
     */
    private $products = array();

    /**
     * @var DiscountFactory
     */
    private $discountFactory;

    public function __construct(DiscountFactory $discountFactory)
    {
        $this->discountFactory = $discountFactory;
    }

    public function processNextBasket(Basket $basket)
    {
        $this->totalPrice = 0;
        $products = $basket->getProducts();

        foreach ($products as $product)
        {
            $discount = $this->discountFactory->getDiscount($product);

            $discountPrice    = $discount->getDiscountPrice($product);
            $discountQuantity = $discount->getDiscountQuantity($product);

            $currentPrice = $discountPrice * $discountQuantity;
            $this->totalPrice += $currentPrice;
        }
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
}
