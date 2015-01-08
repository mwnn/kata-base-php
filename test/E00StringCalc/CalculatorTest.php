<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2015.01.08.
 * Time: 16:53
 */

namespace Kata\Test\E00StringCalc;

use Kata\E00StringCalc\Calculator;
use Kata\E00StringCalc\CalculatorException;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{

//   ****************************************
//                    INIT
//   ****************************************

    /**
     * @var Calculator
     */
    private $calculator;

    /**
     * Setup
     */
    public function setUp()
    {
        $this->calculator = new Calculator();
    }

    /**
     * Cleanup
     */
    public function tearDown()
    {
    }

//   ****************************************
//                    TESTS
//   ****************************************

    /**
     * @dataProvider dataForTestAddThrowsExceptionIfParameterIsNotString
     * @expectedException Kata\E00StringCalc\CalculatorException
     */
    public function testAddThrowsExceptionIfParameterIsNotString($wrongValue)
    {
        $this->calculator->add($wrongValue);
    }

//   ****************************************
//                    DATA PROVIDERS
//   ****************************************

    public function dataForTestAddThrowsExceptionIfParameterIsNotString()
    {
        return array(
            array(1),
            array(2),
            array(true),
            array(array()),
            array(new \StdClass()),
            array(null),
        );
    }
}
