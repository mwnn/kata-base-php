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
     * Cleanup.
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
     * @expectedExceptionMessage Invalid data type has been given.
     */
    public function testAddThrowsExceptionIfParameterIsNotString($wrongValue)
    {
        $this->calculator->add($wrongValue);
    }

    /**
     * @dataProvider dataForTestAddThrowsExceptionIfParameterIsStringButInValidFormat
     * @expectedException Kata\E00StringCalc\CalculatorException
     * @expectedExceptionMessage Invalid data value has been given.
     */
    public function testAddThrowsExceptionIfParameterIsStringButInValidFormat($wrongValue)
    {
        $this->calculator->add($wrongValue);
    }

    /**
     *
     */
    public function testAddReturnsNotNull()
    {
        $sum = $this->calculator->add("");
        $this->assertNotNull($sum);
    }

    /**
     *
     */
    public function testIfParameterIsEmptyStringThenAddReturnsZero()
    {
        $sum = $this->calculator->add("");

        $this->assertEquals(0, $sum);
    }

    /**
     * @dataProvider dataForTestIfOnlyOneNumberGivenThenReturnsTheSameValue
     */
    public function testIfOnlyOneNumberGivenThenReturnsTheSameValue($singleValue)
    {
        $sum = $this->calculator->add($singleValue);

        $this->assertEquals($singleValue, $sum);
    }

    /**
     * @dataProvider dataForTestAddOfMultipleNumbers
     */
    public function testAddOfMultipleNumbers($expectedSum, $multipleNumber)
    {
        $sum = $this->calculator->add($multipleNumber);

        $this->assertEquals($expectedSum, $sum);
    }

    /**
     * @dataProvider dataForTestAddAcceptNewlinesBetweenNumbers
     */
    public function testAddAcceptNewlinesBetweenNumbers($expectedSum, $multipleNumber)
    {
        // Note: I know, I know It's duplication... but I've created a
        // separate test and data provider this time for easier checking.

        $sum = $this->calculator->add($multipleNumber);
        $this->assertEquals($expectedSum, $sum);
    }


//   ****************************************
//                    DATA PROVIDERS
//   ****************************************

    /**
     * Provides data for the testAddThrowsExceptionIfParameterIsNotString method.
     *
     * @return array
     */
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

    /**
     * Provides data for the testAddThrowsExceptionIfParameterIsStringButInValidFormat method.
     *
     * @return array
     */
    public function dataForTestAddThrowsExceptionIfParameterIsStringButInValidFormat()
    {
        return array(
            array("a"),
            array("."),
            array("1.2"),
            array("a1,2"),
            array("1a,2"),
            array("-/*"),
        );
    }

    /**
     * Provides data for the testIfOnlyOneNumberGivenThenReturnsTheSameValue method.
     *
     * @return array
     */
    public function dataForTestIfOnlyOneNumberGivenThenReturnsTheSameValue()
    {
        return array(
            array('1'),
            array('12'),
            array('123'),
        );
    }

    /**
     * Provides data for the testAddOfMultipleNumbers method.
     *
     * @return array
     */
    public function dataForTestAddOfMultipleNumbers()
    {
        return array(
            array(0, ','),
            array(0, '0,0'),
            array(7, '3,4'),
            array(7, '3,,4'),
            array(6, '1,2,3'),
        );
    }

    /**
     * Provides data for the testAddOfMultipleNumbers method.
     *
     * @return array
     */
    public function dataForTestAddAcceptNewlinesBetweenNumbers()
    {
        return array(
            array(3, "1\n2"),
            array(6, "1\n2\n3"),
            array(6, "1,2\n3"),
        );
    }

}
