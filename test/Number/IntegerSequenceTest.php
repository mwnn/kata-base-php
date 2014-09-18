<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.09.17.
 * Time: 21:13
 */
namespace Kata\Test\Number;

use Kata\Number\IntegerSequence;
use SebastianBergmann\Exporter\Exception;

class IntegersSequenceTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $this->assertTrue(class_exists('\\Kata\\Number\\IntegerSequence'));

        $intSeq = new IntegerSequence(array(1));
        $this->assertInstanceOf('\\Kata\\Number\\IntegerSequence', $intSeq);
    }

    /**
     * @dataProvider dataForTestStoreNumbers
     */
    public function testStoreValidNumbers($data)
    {
        $this->assertTrue(method_exists('\\Kata\\Number\\IntegerSequence', 'getNumbers'));

        $intSeq = new IntegerSequence($data);
        $retVal = $intSeq->getNumbers();

        $this->assertTrue(is_array($retVal));
        $this->assertEquals($data, $retVal);
    }

    public function dataForTestStoreNumbers()
    {
        return array(
            array(array(1)),
            array(array(1,2,3)),
        );
    }

    /**
     * @expectedException \OutOfBoundsException
     */
    public function testEmptyArrayRaiseRuntimeException()
    {
        $intSeq = new IntegerSequence(array());
    }

    /**
     * @dataProvider dataForTestNotIntValRaiseInvalidArgumentException
     * @expectedException \InvalidArgumentException
     */
    public function testNotIntValRaiseInvalidArgumentException($data)
    {
        $intSeq = new IntegerSequence($data);
    }

    public function dataForTestNotIntValRaiseInvalidArgumentException()
    {
        return array(
            array(
                array(array(null)),
                array(array('')),
                array(array('foo')),
                array(array(12.5)),
                array(array("12.5")),
                array(array(new \StdClass)),
                array(array(1, 2, true, false)),
            ),
        );
    }


    /**
     * @dataProvider dataForValueTests
     */
    public function testGetCountValue($data, $min, $max, $cnt, $avg)
    {
        $this->assertTrue(method_exists('\\Kata\\Number\\IntegerSequence', 'getCount'));

        $intSeq = new IntegerSequence($data);
        $retVal = $intSeq->getCount();

        $this->assertTrue(is_int($retVal));
        $this->assertEquals($cnt, $retVal);
    }

    /**
     * @dataProvider dataForValueTests
     */
    public function testGetMinValue($data, $min, $max, $cnt, $avg)
    {
        $this->assertClassHasAttribute('min', '\\Kata\\Number\\IntegerSequence');
        $this->assertTrue(method_exists('\\Kata\\Number\\IntegerSequence', 'getMinValue'));

        $intSeq = new IntegerSequence($data);
        $retVal = $intSeq->getMinValue();

        $this->assertTrue(is_int($retVal));
        $this->assertEquals($min, $retVal);
    }

    /**
     * @dataProvider dataForValueTests
     */
    public function testGetMaxValue($data, $min, $max, $cnt, $avg)
    {
        $this->assertClassHasAttribute('max', '\\Kata\\Number\\IntegerSequence');
        $this->assertTrue(method_exists('\\Kata\\Number\\IntegerSequence', 'getMaxValue'));

        $intSeq = new IntegerSequence($data);
        $retVal = $intSeq->getMaxValue();

        $this->assertTrue(is_int($retVal));
        $this->assertEquals($max, $retVal);
    }

    /**
     * @dataProvider dataForValueTests
     */
    public function testGetAvgValue($data, $min, $max, $cnt, $avg)
    {
        $this->assertClassHasAttribute('avg', '\\Kata\\Number\\IntegerSequence');
        $this->assertTrue(method_exists('\\Kata\\Number\\IntegerSequence', 'getAverageValue'));

        $intSeq = new IntegerSequence($data);
        $retVal = $intSeq->getAverageValue();

        $this->assertNotNull($retVal);
        $this->assertTrue(is_numeric($retVal));

        $this->assertEquals($avg, $retVal);
    }

    public function dataForValueTests() {
        return array(
            array(array(0,0,0), 0, 0, 3, 0),
            array(array(0,0,1,1), 0, 1, 4, 0.5),
            array(array(1,2,3,4,5), 1, 5, 5, 3),
            array(array(-10, 0, 10), -10, 10, 3, 0),
            array(array(-10, 0, 10, 100), -10, 100, 4, 25),
            array(array(-10,-20,-30), -30, -10, 3, -20),
         );
    }
}
