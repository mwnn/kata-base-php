<?php
/**
* Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.17.
 * Time: 21:09
 */
namespace Kata\Number;

use Kata\Test\Number\IntegerSequenceTest;

class IntegerSequence
{
    private $integers = array();

    private $min = null;
    private $max = null;
    private $avg = null;
    private $cnt = 0;

    public function __construct(array $integers)
    {
        $this->cnt = count($integers);

        // avoid division by zero on avg count
        if (0 === $this->cnt)
        {
            throw new \OutOfBoundsException('Empty arrays are prohibited.');
        }

        foreach ($integers as $val)
        {
            if (false == is_int($val))
            {
                throw new \InvalidArgumentException('Only integer values are allowed..');
            }
        }

        $this->integers = $integers;
    }

    public function getNumbers()
    {
        return $this->integers;
    }

    public function getMinValue()
    {
        $this->process();
        return $this->min;
    }

    public  function getMaxValue()
    {
        $this->process();
        return $this->max;
    }

    public function getCount()
    {
        return $this->cnt;
    }

    public function getAverageValue()
    {
        $this->process();
        return $this->avg;
    }

    private function process()
    {
        $sum = 0;

        foreach($this->integers as $val)
        {
            $sum += $val;

            if (null === $this->min && null === $this->max)
            {
                $this->min = $this->max = $val;
            }
            elseif ($val < $this->min)
            {
                $this->min = $val;
            }
            elseif ($val > $this->max)
            {
                $this->max = $val;
            }
        }

        $this->avg = $sum/$this->getCount();
    }
}
