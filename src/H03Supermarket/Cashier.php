<?php
/**
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

//use Kata\H03Supermarket\DiscountFactory;

use Kata\H03Supermarket\Concrete\DiscountList;

class Cashier
{
    private $totalPrice = 0;

    /**
     * @var DiscountList
     */
    private $discountList;

    public function __construct(DiscountList $discountList)
    {
        $this->discountList = $discountList;
    }

    public function processNextCart(Cart $cart)
    {
        $this->totalPrice = 0;
        $items = $cart->getItems();

        foreach ($items as $oneItem)
        {
            $discountedItem = $this->discountList->createDiscountedItem($oneItem);
            $this->totalPrice += $discountedItem->getPrice();
        }
    }

    public function getTotalPrice()
    {
        return number_format($this->totalPrice, 2);
    }
}
