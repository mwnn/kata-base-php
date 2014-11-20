<?php

namespace Kata\Test\H05API;

use Kata\H05API\Generator;
use Kata\H05API\GeneratorException;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Generator
     */
    private $generator;

    /**
     * test setup
     */
    public function setUp()
    {
        $this->generator = new Generator();
    }

    /**
     * @dataProvider dataForTestGenerateRandomPasswordThrowsExceptionIfMinLengthLessThenOne
     * @expectedException Kata\H05API\GeneratorException
     */
    public function testGenerateRandomPasswordThrowsExceptionIfMinLengthLessThenOne($minLength)
    {
        $this->generator->generateRandomPassword($minLength, 10, MCRYPT_RAND);
    }

    /**
     * @param $requiredLength
     * @dataProvider dataForTestGeneratePasswordWithConstantLength
     */
    public function testGeneratePasswordWithConstantLength($requiredLength)
    {
        $password = $this->generator->generateRandomPassword($requiredLength, $requiredLength);

        $this->assertEquals($requiredLength, strlen($password));
    }

    /**
     * @throws GeneratorException
     */
    public function testGenerateRandomPassword()
    {
        $minLength = 8;
        $maxLength = 16;

        $stack = array();

        for ($i = 0; $i < 10; $i++)
        {
            $current = $this->generator->generateRandomPassword($minLength, $maxLength, MCRYPT_DEV_URANDOM);

            // test is random
            $this->assertNotContains($current, $stack);

            // test length ranges  - iknow.. i know... a separate test would be nice :)
            $this->assertGreaterThanOrEqual($minLength, strlen($current));
            $this->assertLessThanOrEqual($maxLength, strlen($current));

            $stack[] = $current;
        }
    }

    public function dataForTestGenerateRandomPasswordThrowsExceptionIfMinLengthLessThenOne()
    {
        return array(
            array(0),
            array(0.999),
            array(-1),
            array(-2),
            array(-1000),
        );
    }

    public function dataForTestGeneratePasswordWithConstantLength()
    {
        return array(
            array(1),
            array(3),
            array(2),
            array(10),
            array(4),
            array(77),
            array(256),
            array(123),
            array(8),
            array(11),
        );
    }
}
 