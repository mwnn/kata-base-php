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
        $sum = 0;

        if (false === is_string($numbers)) {
            throw new CalculatorException("Invalid data type has been given.");
        }

        $numbers = trim($numbers);

        if ('' !== $numbers)
        {
            if (1 === preg_match("/[^0-9\,]+/", $numbers, $m))
            {
                throw new CalculatorException("Invalid data value has been given.");
            }

            $numArray = $this->getNumbersFromString($numbers);

            if (1 === count($numArray))
            {
                $sum = $numArray[0];
            }
            else
            {
                foreach ($numArray as $num)
                {
                    $sum += $num;
                }
            }
        }

        return $sum;
    }

    /**
     * Convert the comma separated list of numbers to an integer array.
     *
     * @param String $commaSeparatedNumbersAsString   The comma separated list of numbers as string.
     *
     * @return int[]
     */
    private function getNumbersFromString($commaSeparatedNumbersAsString)
    {
        $intNumArray = array();
        $strNumParts = explode(',', $commaSeparatedNumbersAsString);

        foreach ($strNumParts as $strNum)
        {
            $intNumArray[] = ('' === $strNum) ? 0 : (int)$strNum;
        }

        return $intNumArray;
    }
}
