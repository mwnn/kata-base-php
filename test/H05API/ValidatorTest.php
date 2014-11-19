<?php

namespace Kata\Test\H05API;

use Kata\H05API\Validator;

/**
 * Class ValidatorTest
 * @package Kata\H05API
 */
class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Validator
     */
    private $validator;

    /**
     * @var string
     */
    private $randomUsernameWithMaxLength;

    /**
     * Constructor.
     *
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name=null, $data=array(), $dataName = "")
    {
        $this->randomUsernameWithMaxLength = hash('sha512', 'Valami Akarmi Barmi'); // 128  char

        parent::__construct($name, $data, $dataName);
    }

    /**
     * test setup
     */
    public function setUp()
    {
        $this->validator = new Validator();
    }

    /**
     * @dataProvider dataForValidateWrongUsername
     */
    public function testValidateWrongUsername($username)
    {
        $this->assertFalse($this->validator->validateUsername($username));
    }

    /**
     * @dataProvider dataForValidateCorrectUsername
     */
    public function testValidateCorrectUsername($username)
    {
        $this->assertTrue($this->validator->validateUsername($username));
    }

    /**
     * @dataProvider dataForValidateWrongPassword
     */
    public function testValidateWrongPassword($password, $password_confirm)
    {
        $this->assertFalse($this->validator->validatePassword($password, $password_confirm));
    }

    /**
     * @dataProvider dataForValidateCorrectPassword
     */
    public function testValidateCorrectPassword($password, $password_confirm)
    {
        $this->assertTrue($this->validator->validatePassword($password, $password_confirm));
    }

    public function dataForValidateWrongUsername()
    {
        return array(
            // wrong length
            array('a'),
            array('as'),
            array('asd'),
            array('a' . $this->randomUsernameWithMaxLength), // max length + 1

            // good length, wrong char map
            array('sdf '),
            array('asdA'),
            array('asdZ'),
            array('asd@'),
            array('asd#'),
            array('asd+'),
        );
    }

    public function dataForValidateCorrectUsername()
    {
        return array(
            array('aaaa'),
            array('a12b'),
            array($this->randomUsernameWithMaxLength),
        );
    }


    public function dataForValidateWrongPassword()
    {
        return array(
            // lengh
            array('a', 'a'),
            array('ab', 'ab'),
            array('abc', 'abc'),
            array('abcde', 'abcde'),

            // mismatch
            array('abcdef', 'ab def'),
            array('AC/DC-1', 'ac/dc-1'),
        );
    }

    public function dataForValidateCorrectPassword()
    {
        return array(
            array('Word56', 'Word56'),
            array('Word56/Dijumdisung!aaa[U2]', 'Word56/Dijumdisung!aaa[U2]'),
        );
    }
}
 