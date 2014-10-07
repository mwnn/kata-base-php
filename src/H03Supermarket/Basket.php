<?php

namespace Kata\H03Supermarket;

use Kata\H03Supermarket\Product\Product;

class Basket
{
    private $products = array();

    public function addProduct(Product $product)
    {
        if (empty($this->products[$product->getName()]))
        {
            $this->products[$product->getName()] = $product;
        }
        else
        {
            $this->products[$product->getName()]->addQuantity($product->getQuantity());
        }
    }

    /**
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param $name
     * @return Product
     */
    public function getAggregatedProduct($name)
    {
        /**
         * @var Product $product
         */
        return $this->products[$name];
    }

}