<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.29.
 * Time: 21:40
 */

namespace Kata\H03Supermarket\Product;

use Kata\H03Supermarket\Product\Product;

class ProductFactory
{
    const PRODUCT_APPLE    = 'Apple';
    const PRODUCT_LIGHT    = 'Light';
    const PRODUCT_STARSHIP = 'Starship';

    private $list = array(
        self::PRODUCT_APPLE    => 32,
        self::PRODUCT_LIGHT    => 15,
        self::PRODUCT_STARSHIP => 999.99,
    );

    /**
     * @param $name
     * @param $quantity
     * @param int $price
     *
     * @return ProductInterface
     */
    public function getProduct($name, $quantity, $discountPrice=0)
    {
        if (false === array_key_exists($name, $this->list))
        {
            // TODO: implement
            throw new Exception('');

        }

        if ((int)$quantity <= 0)
        {
            // TODO: implement
            throw new Exception('');
        }

        $price = $this->list[$name];

        if ((int)$discountPrice > 0)
        {
            $price = $discountPrice;
        }

        switch($name)
        {
            case self::PRODUCT_APPLE:
                $product = new Apple($price, $quantity);
                break;

            case self::PRODUCT_LIGHT:
                $product = new Light($price, $quantity);
                break;

            case self::PRODUCT_STARSHIP:
                $product = new Starship($price, $quantity);
                break;
        }

        return $product;
    }
}