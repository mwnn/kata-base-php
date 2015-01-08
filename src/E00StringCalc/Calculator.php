<?php
/**
 * User: zoltan.budai
 * Date: 2015.01.08.
 * Time: 16:53
 */

namespace Kata\E00StringCalc;

/**
 * Class Calculator
 * @package Kata\E00StringCalc
 */
class Calculator
{
    /**
     * Add numbers which are populated in the \$numbers parameter.
     *
     * Empty string returns zero.
     *
     * @param String $numbers
     */
    public function add($numbers)
    {
        if (false === is_string($numbers))
        {
            throw new CalculatorException("Invalid data type has been given.");
        }

    }
}
