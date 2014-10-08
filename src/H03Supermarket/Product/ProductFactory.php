<?php

namespace Kata\H03Supermarket\Product;

use Kata\H03Supermarket\Concrete\CartProduct;

class ProductFactory
{
    const PRODUCT_APPLE    = 'Apple';
    const PRODUCT_LIGHT    = 'Light';
    const PRODUCT_STARSHIP = 'Starship';

    private $list = array(
        self::PRODUCT_APPLE    => array('price' => 32,     'unit' => 'kg'),
        self::PRODUCT_LIGHT    => array('price' => 15,     'unit' => 'year'),
        self::PRODUCT_STARSHIP => array('price' => 999.99, 'unit' => 'piece'),
    );

    /**
     * @name string $name
     *
     * @return CartProduct
     * @throws \InvalidArgumentException
     */
    public function getProduct($name)
    {
        if (false === array_key_exists($name, $this->list))
        {
            throw new \InvalidArgumentException('Unknown product name.');
        }

        $price   = $this->list[$name]['price'];
        $unit    = $this->list[$name]['unit'];

        $product = new CartProduct($name, $price, $unit);

        return $product;
    }
}